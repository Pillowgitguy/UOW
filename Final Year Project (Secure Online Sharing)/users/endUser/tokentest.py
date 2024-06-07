import db_connection
import random
import string

def get_file_details(file_id):
    """
    Fetch file details from the database based on the file ID.
    """
    conn = db_connection.connect_to_db()
    cursor = conn.cursor(dictionary=True)

    try:
        # SQL query to fetch details from the 'files' and 'sharedfiles' tables
        query = """
        SELECT f.FileID, f.FileName, f.TotalSize, f.minShares, f.totalShares, 
               GROUP_CONCAT(sf.Token) as Tokens
        FROM files f
        LEFT JOIN sharedfiles sf ON f.FileID = sf.FileID
        WHERE f.FileID = %s
        GROUP BY f.FileID;
        """
        cursor.execute(query, (file_id,))
        file_details = cursor.fetchone()
        return file_details
    except Exception as e:
        print(f"Error fetching file details: {e}")
        return None
    finally:
        cursor.close()
        conn.close()

def generate_token_for_file(file_id):
    """
    Generate a new, random token for the given file ID and update the database.
    """
    conn = db_connection.connect_to_db()
    cursor = conn.cursor()

    try:
        # Generate a new, random token
        new_token = ''.join(random.choices(string.ascii_letters + string.digits, k=16))

        # SQL query to insert a new token into the 'sharedfiles' table
        query = "INSERT INTO sharedfiles (FileID, Token) VALUES (%s, %s)"
        cursor.execute(query, (file_id, new_token))
        conn.commit()
        return True
    except Exception as e:
        print(f"Error generating token for file: {e}")
        conn.rollback()
        return False
    finally:
        cursor.close()
        conn.close()