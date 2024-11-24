import numpy as np
import pandas as pd
from sklearn.preprocessing import MultiLabelBinarizer
from . import rbm

def recommend_to_user(recData):
    # Use .csv data do consume and recommend
    filmes = pd.read_csv('./utils/imdb-movies-dataset.csv')
    filmes['nota_normalizada'] = filmes['Rating'] / 10

    catalogo_amostra = filmes.sample(n=5000, random_state=54)[['Title', 'Genre', 'nota_normalizada']]

    # Clear empty values
    catalogo_amostra.dropna(subset=['Genre', 'nota_normalizada'], inplace=True)

    # Divide genres in lists, excluding NaN
    catalogo_amostra['Genre'] = catalogo_amostra['Genre'].apply(lambda x: x.split(', ') if isinstance(x, str) else [])

    mlb = MultiLabelBinarizer()
    generos_binarios = mlb.fit_transform(catalogo_amostra['Genre'])

    generos = mlb.classes_
    # colunas_dados_rbm = list(generos) + ['nota_normalizada']

    dados_rbm = pd.DataFrame(generos_binarios, columns=generos)
    dados_rbm = pd.concat([dados_rbm, catalogo_amostra[['nota_normalizada']].reset_index(drop=True)], axis=1)

    num_visible = dados_rbm.shape[1]
    num_hidden = 256

    modelo_rbm = rbm.RBM(num_visible=num_visible, num_hidden=num_hidden)

    modelo_rbm.train(
        data=dados_rbm.values,  
        max_epochs=100,         
        learning_rate=0.01      
    )

    mensagens = []

    for usuario_data in recData:
        usuario_alugados = []

        for item in usuario_data:
            if isinstance(item, dict) and 'Title' in item:
                indice_filme = catalogo_amostra[catalogo_amostra['Title'] == item['Title']].index
                if len(indice_filme) > 0:
                    filme_data = dados_rbm.iloc[indice_filme[0]].values
                    usuario_alugados.append(filme_data)
        
        if len(usuario_alugados) == 0:
            usuario_alugados = np.zeros((3, dados_rbm.shape[1])) 
        else:
            usuario_alugados = np.array(usuario_alugados)

            while len(usuario_alugados) < 3:
                usuario_alugados = np.vstack([usuario_alugados, np.zeros(usuario_alugados[0].shape)])

        # Fixed weights fixos (recently has more weight)
        weights = np.array([0.5, 0.3, 0.2])

        perfil_usuario = np.average(usuario_alugados, axis=0, weights=weights).reshape(1, -1)

        # Profile fit multipling for genre preferences
        generos_usuario = usuario_alugados[:, :-1] 
        preferencias_genero = np.average(generos_usuario, axis=0, weights=weights)

        perfil_usuario_ajustado = perfil_usuario.copy()
        perfil_usuario_ajustado[0, :-1] *= preferencias_genero 

        generos = dados_rbm.columns[:-1]  

        perfil_genero_ajustado = perfil_usuario_ajustado[0, :-1] 

        generos_e_pesos = pd.DataFrame({
            'Gênero': generos,
            'Peso ajustado': perfil_genero_ajustado
        })

        generos_e_pesos_sorted = generos_e_pesos.sort_values(by='Peso ajustado', ascending=False)

        generos_importantes = generos_e_pesos_sorted.head(3)['Gênero'].values

        perfil_usuario_ajustado = perfil_usuario.copy()
        perfil_usuario_ajustado[0, :-1] *= (1 + preferencias_genero)

        recomendacao = modelo_rbm.run_visible(perfil_usuario_ajustado)

        limite_ativacao = 0.5

        filmes_recomendados = []

        for i in range(len(recomendacao[0])):
            if (
                i not in usuario_alugados and            
                recomendacao[0, i] >= limite_ativacao and  
                i < len(catalogo_amostra)              
            ):
                generos_filme = catalogo_amostra.iloc[i]['Genre']
                genero_comum = any(genero in generos_importantes for genero in generos_filme)
                
                if genero_comum:
                    filme_recomendado = {
                        'titulo': catalogo_amostra.iloc[i]['Title'],
                        'generos': catalogo_amostra.iloc[i]['Genre'][0], 
                        'nota': catalogo_amostra.iloc[i]['nota_normalizada']
                    }
                    filmes_recomendados.append(filme_recomendado)

        filmes_recomendados_sorted = sorted(filmes_recomendados, key=lambda x: x['nota'], reverse=True)[:15]

        mensagens.append(filmes_recomendados_sorted)

    return mensagens
