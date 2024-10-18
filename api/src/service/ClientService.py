from src.database.Mysql import MySQLConnector as database

db = database()

def list():
    result = db.get('clients')
    return result