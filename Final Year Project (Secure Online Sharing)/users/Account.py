import bcrypt
from .db_connection import create_connection, close_connection
from datetime import datetime
from mysql.connector import Error
import time
import pyotp
import qrcode
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from flask import jsonify
import re
import random
import string
from datetime import datetime, timedelta


def retrieve_last_login(email):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_file_details = """
                select LastLogin from users where Email = %s;
            """
            cursor.execute(select_file_details, (email,))

            # Retrieve the data
            last_login = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return last_login[0]


def retrieve_username(email):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_file_details = """
                select Username from users where Email = %s;
            """
            cursor.execute(select_file_details, (email,))

            # Retrieve the data
            u_name = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return u_name[0]


def save_OTP_key_to_table(email, key):
    connection = create_connection()
    if connection is not None:
        try:
            cursor = connection.cursor()

            # Update the keys column for the specified FragmentID
            update_query_files = """
                UPDATE users 
                SET otpKey = %s 
                WHERE Email = %s;
            """
            cursor.execute(update_query_files, (key, email))

            connection.commit()
        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)


def retrieve_OTP_key(email):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_total_fragment = """
                select otpKey from users where Email = %s;
            """
            cursor.execute(select_total_fragment, (email,))
            # Retrieve the data
            min_fragments = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return min_fragments[0]


def validate_login(email, password):
    connection = create_connection()
    try:
        if connection.is_connected():
            cursor = connection.cursor(dictionary=True)
            query = "SELECT * FROM users WHERE email = %s"
            cursor.execute(query, (email,))
            user_data = cursor.fetchone()

            if user_data:
                stored_hashed_password = user_data['PasswordHash']
                stored_salt = user_data['PasswordSalt']

                # Verify the entered password against the stored hashed password and salt
                # Ensure a valid bytes object
                combined_salt = stored_salt.encode() if stored_salt else b''
                entered_password_hash = hash_password(password, combined_salt)

                # print(f"password: {stored_hashed_password}")
                # print(f"Stored hashed password: {stored_hashed_password}")
                # print(f"Entered password hash: {entered_password_hash}")

                if entered_password_hash == stored_hashed_password:
                    # Password is correct, update LastLogin and return user data
                    update_last_login(email)
                    print("DEBUG: Login successful")
                    return user_data
                else:
                    print("DEBUG: Incorrect password")
                    return None  # Invalid password
    except Exception as e:
        print(f"Error during login validation: {str(e)}")
    finally:
        close_connection(connection)

    return None  # User not found


def update_last_login(email):
    connection = create_connection()
    try:
        if connection.is_connected():
            cursor = connection.cursor()

            # Update LastLogin for the user
            query = "UPDATE users SET LastLogin = %s WHERE email = %s"
            cursor.execute(query, (datetime.now(), email))
            connection.commit()
    except Exception as e:
        print(f"Error updating LastLogin: {str(e)}")
    finally:
        close_connection(connection)


def register_user(email, username, password):
    salt = generate_salt()
    hashed_password = hash_password(password, salt)

    connection = create_connection()
    try:
        if connection.is_connected():
            cursor = connection.cursor()

            # Check for existing email or username
            query = "SELECT * FROM users WHERE email = %s OR username = %s"
            cursor.execute(query, (email, username))
            if cursor.fetchone():
                return False, "Email or Username already exists"
            print(f"password: {password}")
            print(f"hashed_password: {hashed_password}")
            print(f"salt: {salt}")
            # Insert new user
            date_joined = datetime.now().date()
            query = "INSERT INTO users (email, username, PasswordHash, PasswordSalt, DateJoined) VALUES (%s, %s, %s, %s, %s)"
            cursor.execute(
                query, (email, username, hashed_password, salt, date_joined))
            connection.commit()
            return True, "User registered successfully"
    except Exception as e:
        return False, f"Error: {str(e)}"
    finally:
        close_connection(connection)


def hash_password(password, salt):
    # Convert salt to bytes if it's currently a string
    salt_bytes = salt.encode() if isinstance(salt, str) else salt

    # Hash a password with bcrypt using the provided salt
    hashed = bcrypt.hashpw(password.encode(), salt_bytes)
    # Convert bytes to string for storage in the database
    return hashed.decode('utf-8')


def generate_salt():
    # Generate a unique salt for each user
    return bcrypt.gensalt().decode('utf-8')


def create_2FA(user_name, email):
    key = pyotp.random_base32()
    save_OTP_key_to_table(email, key)
    uri = pyotp.totp.TOTP(key).provisioning_uri(name=user_name,
                                                issuer_name="TrustSharing")
    qrcode.make(uri).save("users/static/img/totp.png")


def verify_otp(otp_input, email):
    key = retrieve_OTP_key(email)
    # Generate TOTP object using the provided key
    totp = pyotp.TOTP(key)
    # Verify the OTP
    return totp.verify(otp_input)


def is_valid_email(email):
    """Validate the email address using a regular expression."""
    pattern = r'^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$'
    return re.match(pattern, email, re.I)


def send_reset_email(recipient_email):
    if not is_valid_email(recipient_email):
        print("Invalid email address.")
        return False

    conn = create_connection()
    cursor = conn.cursor()

    try:
        # Fetch the OwnerUserID for the given FileID from the 'files' table
        cursor.execute(
            "SELECT Email FROM users WHERE Email = %s", (recipient_email,))
        owner_result = cursor.fetchone()
        # If owner_result is None, then no matching record was found
        if owner_result is None:
            print("No email matching new found.")
            return False

        new_token = ''.join(random.choices(
            string.ascii_letters + string.digits, k=16))
        token_expiry = datetime.now() + timedelta(minutes=15)  # Token expires in 15 minutes
        cursor.execute("""
                       UPDATE users SET resetOTP = %s, resetOTPExpiry = %s WHERE Email = %s """, (new_token, token_expiry, recipient_email))
        conn.commit()
        send_email(recipient_email, new_token)  # Pass recipient_email here
        return True
    except Exception as e:
        print(f"Error sending email: {e}")
        conn.rollback()
        return False
    finally:
        cursor.close()
        conn.close()


def send_email(recipient_email, token_code):
    # Email configuration
    EMAIL_ADDRESS = "trustsharingtoken@gmail.com"
    EMAIL_PASSWORD = "xrav cplk mkus btck"

    # Set up the MIME
    message = MIMEMultipart()
    message['From'] = EMAIL_ADDRESS
    message['To'] = recipient_email
    message['Subject'] = 'Trust Sharing: Reset password'

    # Construct the email body
    email_body = f'Your reset code is: {
        token_code}\n\nYou can reset the password at: http://127.0.0.1:5000/reset_password_page\n\nThe token will expire in 15 minutes.'

    # The body and the attachments for the mail
    message.attach(MIMEText(email_body, 'plain'))
    # Create SMTP session for sending the mail
    try:
        server = smtplib.SMTP('smtp.gmail.com', 587)  # Use 465 for SSL
        server.set_debuglevel(1)
        server.starttls()  # Enable security
        server.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
        text = message.as_string()
        server.sendmail(EMAIL_ADDRESS, recipient_email, text)
        server.quit()
    except Exception as e:
        print(f"Error sending email: {e}")


def update_password(email, password):
    salt = generate_salt()
    hashed_password = hash_password(password, salt)

    connection = create_connection()
    try:
        if connection.is_connected():
            cursor = connection.cursor()

            # Check if user exists
            query = "SELECT * FROM users WHERE email = %s"
            cursor.execute(query, (email,))
            user = cursor.fetchone()
            if not user:
                return False, "User not found"

            # Update password
            query = "UPDATE users SET PasswordHash = %s, PasswordSalt = %s WHERE email = %s"
            cursor.execute(query, (hashed_password, salt, email))
            connection.commit()
            query = "UPDATE users SET resetOTP = %s WHERE email = %s"
            cursor.execute(query, (None, email))
            connection.commit()
            return True, "Password updated successfully"
    except Exception as e:
        return False, f"Error: {str(e)}"
    finally:
        close_connection(connection)


def check_token_existence(token):
    connection = create_connection()
    try:
        if connection.is_connected():
            cursor = connection.cursor()

            # Check if token exists
            query = "SELECT resetOTPExpiry FROM users WHERE resetOTP = %s"
            cursor.execute(query, (token,))
            row = cursor.fetchone()
            if row:
                resetOTPExpiry = row[0]
                current_time = datetime.now()

                if resetOTPExpiry >= current_time:
                    return True  # Token exists in the table and is not expired
                else:
                    return False  # Token exists in the table but is expired
            else:
                return False  # Token does not exist in the table
    except Exception as e:
        print(f"Error: {str(e)}")
        return False  # Error occurred
    finally:
        close_connection(connection)


def get_email_from_token(token):
    connection = create_connection()
    try:
        if connection.is_connected():
            cursor = connection.cursor()

            # Retrieve email based on token
            query = "SELECT Email FROM users WHERE resetOTP = %s"
            cursor.execute(query, (token,))
            row = cursor.fetchone()
            if row:
                email = row[0]
                return email  # Return the email associated with the token
            else:
                return None  # Token does not exist in the table
    except Exception as e:
        print(f"Error: {str(e)}")
        return None  # Error occurred
    finally:
        close_connection(connection)
