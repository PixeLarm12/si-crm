import os
import mysql.connector

from dotenv import load_dotenv
from mysql.connector import Error

load_dotenv(os.path.join('/crm', '.env'))

db_user = os.getenv('MYSQL_USER')
db_password = os.getenv('MYSQL_PASSWORD')
db_name = os.getenv('MYSQL_DB')

class MySQLConnector:
    def __init__(self):
        # """Inicializa a conexão com o banco de dados MySQL"""
        try:
            self.connection = mysql.connector.connect(
                host='crm-database',
                user=db_user,
                password=db_password,
                database=db_name
            )
            if self.connection.is_connected():
                print("MySQL connection estabilished")
        except Error as e:
            print(f"Error connecting MySQL: {e}")
            self.connection = None

    def insert(self, table, data):
        if self.connection is None:
            print("Connection not available")
            return

        try:
            cursor = self.connection.cursor()
            # Gera a query dinamicamente
            placeholders = ', '.join(['%s'] * len(data))
            columns = ', '.join(data.keys())
            query = f"INSERT INTO {table} ({columns}) VALUES ({placeholders})"

            # Executa o insert
            cursor.execute(query, tuple(data.values()))
            self.connection.commit()

            print(f"Added register to {table} table")
        except Error as e:
            print(f"Error when inserting data: {e}")
        finally:
            cursor.close()

    def get(self, table, conditions=None):
        if self.connection is None:
            print("Connection not available")
            return

        try:
            cursor = self.connection.cursor(dictionary=True)

            query = f"SELECT * FROM {table}"

            if conditions:
                condition_str = ' AND '.join([f"{col} = %s" for col in conditions.keys()])
                query += f" WHERE {condition_str}"

                cursor.execute(query, tuple(conditions.values()))
            else:
                cursor.execute(query)

            result = cursor.fetchall()
            return result
        except Error as e:
            print(f"Error searching data: {e}")
        finally:
            cursor.close()

    def close(self):
        if self.connection.is_connected():
            self.connection.close()
            print("MySQL connection stopped.")
