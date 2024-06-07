import mysql.connector
from typing import List, Dict
from .db_connection import create_connection, close_connection

def fetch_users() -> List[Dict]:
    conn = create_connection()
    cursor = conn.cursor(dictionary=True)
    query = "SELECT UserID, Username, Email, DateJoined, LastLogin, role FROM users"
    cursor.execute(query)
    users = cursor.fetchall()
    cursor.close()
    conn.close()
    return users

def update_user_role(user_id: int, new_role: str):
    conn = create_connection()
    cursor = conn.cursor()
    query = "UPDATE users SET role = %s WHERE UserID = %s"
    cursor.execute(query, (new_role, user_id))
    conn.commit()
    cursor.close()
    conn.close()
