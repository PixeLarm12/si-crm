import numpy as np
import pandas as pd
from sklearn.preprocessing import MultiLabelBinarizer
from . import rbm

def recommend_to_user(recData):
    # Use .csv data do consume and recommend
    movies = pd.read_csv('./utils/imdb-movies-dataset.csv')
    movies['normalized_rating'] = movies['Rating'] / 10

    catalog_sample = movies.sample(n=5000, random_state=54)[['Title', 'Genre', 'normalized_rating']]

    # Clear empty values
    catalog_sample.dropna(subset=['Genre', 'normalized_rating'], inplace=True)

    # Divide genres in lists, excluding NaN
    catalog_sample['Genre'] = catalog_sample['Genre'].apply(lambda x: x.split(', ') if isinstance(x, str) else [])

    mlb = MultiLabelBinarizer()
    genres_binary = mlb.fit_transform(catalog_sample['Genre'])

    genres = mlb.classes_

    rbm_data = pd.DataFrame(genres_binary, columns=genres)
    rbm_data = pd.concat([rbm_data, catalog_sample[['normalized_rating']].reset_index(drop=True)], axis=1)

    num_visible = rbm_data.shape[1]
    num_hidden = 256

    rbm_model = rbm.RBM(num_visible=num_visible, num_hidden=num_hidden)

    rbm_model.train(
        data=rbm_data.values,  
        max_epochs=100,         
        learning_rate=0.01      
    )

    messages = []

    # Formatting for response by preferable genres
    for user_data in recData:
        rented_users = []

        for item in user_data:
            if isinstance(item, dict) and 'Title' in item:
                movie_index = catalog_sample[catalog_sample['Title'] == item['Title']].index
                if len(movie_index) > 0:
                    movie_data = rbm_data.iloc[movie_index[0]].values
                    rented_users.append(movie_data)
        
        if len(rented_users) == 0:
            rented_users = np.zeros((3, rbm_data.shape[1])) 
        else:
            rented_users = np.array(rented_users)

            while len(rented_users) < 3:
                rented_users = np.vstack([rented_users, np.zeros(rented_users[0].shape)])

        # Fixed weights fixos (recently has more weight)
        weights = np.array([0.5, 0.3, 0.2])

        user_profile = np.average(rented_users, axis=0, weights=weights).reshape(1, -1)

        # Profile fit multipling for genre preferences
        user_genres = rented_users[:, :-1] 
        genres_preferences = np.average(user_genres, axis=0, weights=weights)

        user_profile_ajusted = user_profile.copy()
        user_profile_ajusted[0, :-1] *= genres_preferences 

        genres = rbm_data.columns[:-1]  

        genre_profile_ajusted = user_profile_ajusted[0, :-1] 

        genres_and_weights = pd.DataFrame({
            'GENDER': genres,
            'AJUSTED_WEIGHT': genre_profile_ajusted
        })

        genres_and_weights_sorted = genres_and_weights.sort_values(by='AJUSTED_WEIGHT', ascending=False)

        important_genres = genres_and_weights_sorted.head(3)['GENDER'].values

        user_profile_ajusted = user_profile.copy()
        user_profile_ajusted[0, :-1] *= (1 + genres_preferences)

        recommendation = rbm_model.run_visible(user_profile_ajusted)

        limit = 0.5

        recommended_movies = []

        for i in range(len(recommendation[0])):
            if (
                i not in rented_users and            
                recommendation[0, i] >= limit and  
                i < len(catalog_sample)              
            ):
                movie_genres = catalog_sample.iloc[i]['Genre']
                common_genre = any(genero in important_genres for genero in movie_genres)
                
                if common_genre:
                    recommended_movie = {
                        'movie': catalog_sample.iloc[i]['Title'],
                        'genre': catalog_sample.iloc[i]['Genre'][0], 
                        'rate': catalog_sample.iloc[i]['normalized_rating']
                    }
                    recommended_movies.append(recommended_movie)

        recommended_movies_sorted = sorted(recommended_movies, key=lambda x: x['rate'], reverse=True)[:15]

        messages.append(recommended_movies_sorted)

    return messages
