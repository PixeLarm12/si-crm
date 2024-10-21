from src.database.Mysql import MySQLConnector as database
from flask_jwt_extended import (
    create_access_token
)

db = database()

def login(data):
    user = db.get('users', {
        "username": data['username'],
        "password": data['password']
    })

    if not user:
        return {
            'error': True,
            'message': 'User not found. Check your credentials'
        }

    return create_access_token(identity=data['username'])

def getRequestData(data):
    messages = ''

    username = data.get('username')
    password = data.get('password')

    if not username or len(username) < 3:
        messages += 'The "Username" field are required and need at least 3 characters\n'

    if not password or len(password) < 6:
        messages += 'The "Password" field are required and need at least 6 characters\n'

    if len(messages) > 0:
        return {
            'error': True,
            'message': messages
        }
    
    return {
        'error': False,
        'data': {
            'username': username,
            'password': password
        }
    }