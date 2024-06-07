import mysql.connector
from mysql.connector import Error


def create_connection():
    try:
        connection = mysql.connector.connect(
            host='127.0.0.1',       # or your host, e.g., '127.0.0.1'
            database='mydatabase',  # your database name
            user='root',    # your database username
            password=''  # your database password
        )
        if connection.is_connected():
            return connection
    except Error as e:
        print("Error while connecting to MySQL", e)
        return None


def close_connection(connection):
    if connection and connection.is_connected():
        connection.close()
