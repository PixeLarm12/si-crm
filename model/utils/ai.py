import numpy as np
import pandas as pd
from sklearn.preprocessing import MultiLabelBinarizer
from . import rbm

def recommend_to_user():
    # Carregar os dados do arquivo CSV
    filmes = pd.read_csv('./utils/imdb-movies-dataset.csv')
    filmes['nota_normalizada'] = filmes['Rating'] / 10

    # Selecionar amostra do catálogo
    catalogo_amostra = filmes.sample(n=5000, random_state=54)[['Title', 'Genre', 'nota_normalizada']]

    # Remover registros com valores vazios em 'Genre' ou 'nota_normalizada'
    catalogo_amostra.dropna(subset=['Genre', 'nota_normalizada'], inplace=True)

    # Dividir os gêneros em listas, lidando com valores NaN
    catalogo_amostra['Genre'] = catalogo_amostra['Genre'].apply(lambda x: x.split(', ') if isinstance(x, str) else [])

    # Aplicar o MultiLabelBinarizer
    mlb = MultiLabelBinarizer()
    generos_binarios = mlb.fit_transform(catalogo_amostra['Genre'])

    # Obter os nomes dos gêneros e preparar os dados para o RBM
    generos = mlb.classes_
    colunas_dados_rbm = list(generos) + ['nota_normalizada']

    dados_rbm = pd.DataFrame(generos_binarios, columns=generos)

    # Concatenar as colunas binárias de gênero com a coluna 'nota_normalizada'
    dados_rbm = pd.concat([dados_rbm, catalogo_amostra[['nota_normalizada']].reset_index(drop=True)], axis=1)

    # Configurações do modelo RBM
    num_visible = dados_rbm.shape[1]  # Inclui gêneros binários + nota_normalizada
    num_hidden = 256  # Número de neurônios ocultos

    # Criar e configurar o modelo RBM
    modelo_rbm = rbm.RBM(num_visible=num_visible, num_hidden=num_hidden)

    # Treinar o modelo
    modelo_rbm.train(
        data=dados_rbm.values,  
        max_epochs=100,         
        learning_rate=0.01      
    )

    # Dados fictícios para o exemplo
    # Filmes assistidos (usando índices do catálogo)
    usuario_alugados = dados_rbm.iloc[[0, 6, 9]].values

    # Pesos para os filmes assistidos (mais recente tem maior peso)
    pesos = np.array([0.5, 0.3, 0.2])

    # Calcular a média ponderada dos filmes assistidos como perfil do usuário
    perfil_usuario = np.average(usuario_alugados, axis=0, weights=pesos).reshape(1, -1)

    # Ajuste do perfil do usuário multiplicando pelas preferências de gênero
    # Separar gêneros binários e nota
    generos_usuario = usuario_alugados[:, :-1]  # Excluir a coluna de rating para os gêneros
    preferencias_genero = np.average(generos_usuario, axis=0, weights=pesos)

    # Aplicar a média ponderada ao perfil do usuário
    perfil_usuario_ajustado = perfil_usuario.copy()
    perfil_usuario_ajustado[0, :-1] *= preferencias_genero  # Aplica pesos aos gêneros

    # Identificar colunas de gênero para ajuste
    generos = dados_rbm.columns[:-1]  # Todas as colunas, exceto 'Rating'

    # Ajuste final do perfil do usuário para análise
    perfil_genero_ajustado = perfil_usuario_ajustado[0, :-1]  # Excluindo a coluna de rating

    # Verificar correspondência do comprimento
    if len(generos) == len(perfil_genero_ajustado):
        # Exibindo o perfil ajustado do usuário e associando aos gêneros
        generos_e_pesos = pd.DataFrame({
            'Gênero': generos,
            'Peso ajustado': perfil_genero_ajustado
        })

        # Ordenar os gêneros pelo peso ajustado para ver as preferências mais fortes
        generos_e_pesos_sorted = generos_e_pesos.sort_values(by='Peso ajustado', ascending=False)

        # Exibir os gêneros mais significativos para o perfil do usuário
        print("Gêneros preferidos do usuário (ordenados):")
        print(generos_e_pesos_sorted)
    else:
        print("Erro: O número de gêneros não corresponde ao número de valores ajustados.")

    # Ajustar o perfil do usuário com pesos focados nos gêneros mais assistidos
    perfil_usuario_ajustado = perfil_usuario.copy()
    perfil_usuario_ajustado[0, :-1] *= (1 + preferencias_genero)  # Aumenta pesos de gêneros assistidos

    # Executar o perfil ajustado do usuário no modelo RBM
    recomendacao = modelo_rbm.run_visible(perfil_usuario_ajustado)

    # Filtrar e ajustar recomendações
    limite_ativacao = 0.5

    # Ajuste no processo de recomendação, para armazenar objetos completos de filmes
    filmes_recomendados = []

    # Extrair os 3 gêneros mais importantes
    generos_importantes = generos_e_pesos_sorted.head(3)['Gênero'].values

    for i in range(len(recomendacao[0])):
        if (
            i not in usuario_alugados and            # Filme não foi alugado
            recomendacao[0, i] >= limite_ativacao and  # Recomendação forte
            i < len(catalogo_amostra)                # Índice válido
        ):
            # Confere se o filme recomendado tem ao menos um gênero preferido
            generos_filme = catalogo_amostra.iloc[i]['Genre']
            genero_comum = any(genero in generos_importantes for genero in generos_filme)
            
            if genero_comum:  # Recomendação com gênero preferido
                filme_recomendado = {
                    'indice': i,
                    'titulo': catalogo_amostra.iloc[i]['Title'],
                    'nota': catalogo_amostra.iloc[i]['nota_normalizada'],
                    'generos': catalogo_amostra.iloc[i]['Genre']
                }
                filmes_recomendados.append(filme_recomendado)

    # Ordenar as recomendações por nota e pegar as 15 melhores
    filmes_recomendados_sorted = sorted(filmes_recomendados, key=lambda x: x['nota'], reverse=True)[:15]

    message = '';
    # Exibir recomendações refinadas
    print("\nTop 15 Filmes recomendados (refinados com base em gêneros preferidos):")
    for filme in filmes_recomendados_sorted:
        message = message + f"Título: {filme['titulo']}, Gêneros: {', '.join(filme['generos'])}, Nota: {filme['nota']}"

    return message

def obter_imagens_filmes_recomendados(filmes_recomendados, filmes_df):
    filmes_com_imagens = []
    
    # Iterar sobre os filmes recomendados
    for filme in filmes_recomendados:
        titulo_filme = filme['titulo']
        
        # Procurar o filme pelo título na base de dados
        filme_base = filmes_df[filmes_df['Title'] == titulo_filme]
        
        if not filme_base.empty:
            imagem_url = filme_base.iloc[0]['Poster']
            filmes_com_imagens.append({
                'titulo': titulo_filme,
                'imagem': imagem_url
            })
        else:
            filmes_com_imagens.append({
                'titulo': titulo_filme,
                'imagem': None
            })
    
    return filmes_com_imagens