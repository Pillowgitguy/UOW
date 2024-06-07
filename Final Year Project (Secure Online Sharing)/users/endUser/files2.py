from __future__ import division
from __future__ import print_function
from Crypto.Util import number
import random
import functools
import os
import string
from mysql.connector import Error
from .db_connection import create_connection, close_connection
from flask import jsonify, session
from flask import current_app
from .files_upload import *
import secrets
from .encryption import *
from docx import Document
import fitz  # PyMuPDF library
import time
import numpy as np
import argparse
import png
import sys
import os
from PIL import Image
from Crypto.Util.number import *
import math
import re
from datetime import datetime, timedelta
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText


def upload_files(f, m_share, t_share, u_id, u_type, k_size, e_type, b_mode, m_mode, n_size):
    for file in f:
        # Check if file doesn't have a name
        if file.filename == '':
            return jsonify({'error': 'One of the selected files has no name'})

        # Save the file to the specified upload folder
        file_path = os.path.join(
            current_app.config['UPLOAD_FOLDER'], file.filename)
        file.save(file_path)

        # Save minshare, totalshare, file names, and user_id to files table in database
        save_values_to_files_table(file.filename, u_id)

        # Retrieve the file ID from MySQL database
        file_ID = retrieve_file_ID()

        # Save userType, kSize, encryptionType, blockMode, macMode in database
        save_values_to_file_details_table(
            file_ID, m_share, t_share, u_type, k_size, e_type, b_mode, m_mode, n_size)

        # Calculate the dynamic threshold and total shares based on file size
        file_size = os.path.getsize("users/uploads/" + file.filename)
        updated_min_share = calculate_dynamic_min_threshold(
            file_size, int(m_share))
        updated_total_shares = calculate_dynamic_total_shares_threshold(
            file_size, int(t_share))
        update_shares_in_database(
            file_ID, updated_min_share, updated_total_shares)
        # Save the fileId in the filefragments database
        save_values_to_file_fragments_table(file_ID, updated_total_shares)

        fragments_IDs = retrieve_fragement_ID(file_ID)
        # Secret sharing
        print("SSS NOW")
        SSS("users/uploads/" + file.filename,
            updated_min_share, updated_total_shares, file_ID, fragments_IDs, u_type, k_size, e_type, b_mode, m_mode, n_size)
        print("SSS Done")
        # Delete the uploaded files after secret sharing is done
        file_path = os.path.join(
            current_app.config['UPLOAD_FOLDER'], file.filename)
        try:
            os.remove(file_path)
        except Exception as e:
            print(f"Error deleting file {file.filename}: {e}")


# Retrieve prime number for that file ID
def retrieve_prime_number(input_file_id):
    blob_name = "primeNumber_" + str(input_file_id) + ".txt"
    prime_number_path = "users/endUser/primeNumber_" + \
        str(input_file_id) + ".txt"

    local_file_name = "users/endUser/" + blob_name

    # Download the blob to a local file
    azure_download(blob_name, local_file_name)
    google_download(blob_name, local_file_name)
    aws_download(blob_name, local_file_name)

    os.chmod(prime_number_path, 0o600)

    with open(prime_number_path, 'r') as file:
        # Read the entire content of the file into a string
        content = file.read()
    os.remove(local_file_name)
    return content


# Retrieve the files names from the database
def retrieve_files_to_Display():
    # Using .get() to avoid KeyError if 'user_id' is not in session
    user_id = session.get('user_id')
    connection = create_connection()
    file_to_display = []

    try:
        if connection is not None:
            with connection.cursor() as cursor:
                select_files_query = "SELECT FileID, FileName FROM files WHERE OwnerUserID = %s;"
                cursor.execute(select_files_query, (user_id,))
                file_to_display = cursor.fetchall()
    except Error as e:
        print("Error while working with MySQL:", e)
        file_to_display = [(0000, e)]
    finally:
        if connection is not None:
            cursor.close()
            close_connection(connection)

    return file_to_display


# Retrieve the file ID from the database
def retrieve_file_ID():
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            # Retrieve the last FileID from the table
            select_last_file_id_query = """
                SELECT FileID FROM Files ORDER BY FileID DESC LIMIT 1;
            """
            cursor.execute(select_last_file_id_query)
            # Retrieve the data
            last_file_id = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return last_file_id[0]


# Retrieve the fragmentID
def retrieve_fragement_ID(file_id):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_fragment_ID = """
                select FragmentID from filefragments where FileID = %s;
            """
            cursor.execute(select_fragment_ID, (file_id,))
            # Retrieve the data
            fragment_ids = cursor.fetchall()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return fragment_ids


# Retrieve the min fragment for that fileID
def retrieve_min_fragements(file_d):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_min_fragment = """
                select minShares from filedetails where FileID = %s;
            """
            cursor.execute(select_min_fragment, (file_d,))
            # Retrieve the data
            min_fragments = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return min_fragments[0]


# Retrieve the total fragment for that fileID
def retrieve_total_fragements(file_d):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_total_fragment = """
                select totalShares from filedetails where FileID = %s;
            """
            cursor.execute(select_total_fragment, (file_d,))
            # Retrieve the data
            min_fragments = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return min_fragments[0]


def retrieve_file_details(file_d):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_file_details = """
                select minShares, totalShares, userType, encryptionType, blockMode, macMode from filedetails where FileID = %s;
            """
            cursor.execute(select_file_details, (file_d,))

            # Retrieve the data
            file_details = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return file_details  # Return the list of file details


# Retrieve the starting number for that fileID
def retrieve_starting_number(file_d):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_fragment_ID = """
                select FragmentID from filefragments where FileID = %s limit 1;
            """
            cursor.execute(select_fragment_ID, (file_d,))
            # Retrieve the data
            min_fragments = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return min_fragments[0]


# Retrieve the encryption key
def retrieve_eKeys(frag_d):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_e_key = """
                select encryptionKey from filefragments where FragmentID = %s;
            """
            cursor.execute(select_e_key, (frag_d,))
            # Retrieve the data
            encryption_Key = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return encryption_Key[0]


# Retrieve the fileName
def retrieve_file_name(file_idd):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            select_e_key = """
                select FileName from files where FileID = %s;
            """
            cursor.execute(select_e_key, (file_idd,))
            # Retrieve the data
            encryption_Key = cursor.fetchone()

        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)
            return encryption_Key[0]


# Save the filenames to file table
def save_values_to_files_table(file_name, us_id):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            # Insert minshare, totalshare, and file names into the files table
            insert_query_files = """
                INSERT INTO files (FileName, OwnerUserID)
                VALUES (%s, %s);
            """
            cursor.execute(insert_query_files,
                           (file_name, us_id))

            connection.commit()
        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)


# Save the FileID to the filefragment table
def save_values_to_file_fragments_table(f_id, s_t):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            for i in range(int(s_t)):
                # Insert minshare, totalshare, and file names into the files table
                insert_query_file_fragments = """
                    INSERT INTO filefragments (FileID, FragmentOrder)
                    VALUES (%s, %s);
                """
                cursor.execute(insert_query_file_fragments,
                               (f_id, i+1))

                connection.commit()
        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)


# Save userType, kSize, encryptionType, blockMode, macMode in fileDetails table
def save_values_to_file_details_table(FileID, minShares, totalShares, userType, keySize, encryptionType, blockMode, macMode, n_size):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()

            # Insert minshare, totalshare, and file names into the files table
            insert_query_files = """
                INSERT INTO filedetails (FileID, minShares, totalShares, userType, keySize, encryptionType, blockMode, macMode, nonceSize)
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s);
            """
            cursor.execute(insert_query_files,
                           (FileID, minShares, totalShares, userType, keySize, encryptionType, blockMode, macMode, n_size))

            connection.commit()
        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)


def save_key_to_table(Frag_ID, key):
    connection = create_connection()
    if connection is not None:
        try:
            cursor = connection.cursor()

            # Update the keys column for the specified FragmentID
            update_query_files = """
                UPDATE filefragments 
                SET encryptionKey = %s 
                WHERE FragmentID = %s;
            """
            cursor.execute(update_query_files, (key, Frag_ID))

            connection.commit()
        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)


def _eval_at(poly, x, prime):
    """Evaluates polynomial (coefficient tuple) at x, used to generate a
    shamir pool in make_random_shares below.
    """
    accum = 0
    for coeff in reversed(poly):
        accum *= x
        accum += coeff
        accum %= prime
    return accum


def make_random_shares(secret, mini, input_shares, prime, rint, frag_id, u_type, k_size, e_type, b_mode, m_mode, n_size):
    """
    Generates a random shamir pool for a given secret, returns share points.
    Each share is written to a separate file.
    """
    if mini > input_shares:
        raise ValueError("Pool secret would be irrecoverable.")
    poly = [secret] + [rint(prime - 1) for i in range(mini - 1)]

    # Create a folder for the share files
    folder_path = "users\\endUser\\"
    os.makedirs(folder_path, exist_ok=True)
    print(frag_id)
    # Determine the cloud provider for each share in a round-robin fashion
    cloud_providers = ['azure', 'google', 'aws']
    cloud_index = 0

    # counter to retrieve the fragmentID
    count = 0
    points = []
    for i in range(1, input_shares + 1):
        eKey = 0
        if (k_size == "128"):
            eKey = secrets.token_bytes(16)
        elif (k_size == "192"):
            eKey = secrets.token_bytes(24)
        else:
            eKey = secrets.token_bytes(32)
        key_length = len(eKey)
        # Save the encryption key to table
        save_key_to_table(frag_id[count][0], eKey)
        associated_d = get_random_bytes(24)
        # Share created
        share = _eval_at(poly, i, prime)
        points.append((i, share))
        encryptedShare = None
        if u_type == "non-tech":
            encryptedShare = encrypt_AES_GCM(share, eKey)
        elif e_type == "AES":
            if b_mode == "GCM":
                encryptedShare = encrypt_AES_GCM(share, eKey)
            elif b_mode == "CTR":
                encryptedShare = encrypt_aes_ctr(share, eKey)
            elif b_mode == "OFB":
                encryptedShare = encrypt_aes_ofb(share, eKey)
            else:
                encryptedShare = encrypt_aes_cbc(share, eKey)
        elif e_type == "Camellia":
            if b_mode == "OFB":
                encryptedShare = camellia_encrypt_OFB(share, eKey)
            elif b_mode == "CFB":
                encryptedShare = camellia_encrypt_CFB(share, eKey)
            else:
                encryptedShare = camellia_encrypt_CBC(share, eKey)
        elif e_type == "CAST":
            if b_mode == "CBC":
                encryptedShare = cast128_encrypt_CBC(share, eKey)
            elif b_mode == "CTR":
                encryptedShare = cast128_encrypt_CTR(share, eKey)
            elif b_mode == "OFB":
                encryptedShare = cast128_encrypt_OFB(share, eKey)
            else:
                encryptedShare = cast128_encrypt_CFB(share, eKey)
        elif e_type == "IDEA":
            if b_mode == "CBC":
                encryptedShare = idea_encrypt_CBC(share, eKey)
            elif b_mode == "OFB":
                encryptedShare = idea_encrypt_OFB(share, eKey)
            else:
                encryptedShare = idea_encrypt_CFB(share, eKey)
        elif e_type == "SM4":
            encryptedShare = sm4_encrypt(share, b_mode, eKey)
        else:  # CHACHA
            if m_mode == "No-MAC":
                encryptedShare = chacha20_encrypt(share, n_size, eKey)
            else:  # chacha20_poly1305
                encryptedShare = chacha20_poly1305_encrypt(
                    eKey, n_size, share, associated_d)

        # Write each share to a separate file
        share_file_path = os.path.join(
            folder_path, f'share_{frag_id[count][0]}.encrypted')

        blob_file_name = f'share_{frag_id[count][0]}.encrypted'

        count += 1
        with open(share_file_path, 'w') as share_file:
            share_file.write(str(encryptedShare))

        # Upload a file based on the round-robin cloud provider assignment
        if cloud_providers[cloud_index] == 'azure':
            azure_upload(blob_file_name, str(encryptedShare))
            aws_upload(share_file_path, blob_file_name)
        elif cloud_providers[cloud_index] == 'google':
            azure_upload(blob_file_name, str(encryptedShare))
            google_upload(share_file_path, blob_file_name)
        elif cloud_providers[cloud_index] == 'aws':
            google_upload(share_file_path, blob_file_name)
            aws_upload(share_file_path, blob_file_name)

        os.remove(share_file_path)

        # Move to the next cloud provider in a round-robin fashion
        cloud_index = (cloud_index + 1) % len(cloud_providers)


def _extended_gcd(a, b):
    """
    Division in integers modulus p means finding the inverse of the
    denominator modulo p and then multiplying the numerator by this
    inverse (Note: inverse of A is B such that A*B % p == 1). This can
    be computed via the extended Euclidean algorithm
    http://en.wikipedia.org/wiki/Modular_multiplicative_inverse#Computation
    """
    x = 0
    last_x = 1
    y = 1
    last_y = 0
    while b != 0:
        quot = a // b
        a, b = b, a % b
        x, last_x = last_x - quot * x, x
        y, last_y = last_y - quot * y, y
    return last_x, last_y


def _divmod(num, den, p):
    """Compute num / den modulo prime p

    To explain this, the result will be such that:
    den * _divmod(num, den, p) % p == num
    """
    inv, _ = _extended_gcd(den, p)
    return num * inv


def _lagrange_interpolate(x, x_s, y_s, p):
    """
    Find the y-value for the given x, given n (x, y) points;
    k points will define a polynomial of up to kth order.
    """
    k = len(x_s)
    assert k == len(set(x_s)), "points must be distinct"

    def PI(vals):  # upper-case PI -- product of inputs
        accum = 1
        for v in vals:
            accum *= v
        return accum
    nums = []  # avoid inexact division
    dens = []
    for i in range(k):
        others = list(x_s)
        cur = others.pop(i)
        nums.append(PI(x - o for o in others))
        dens.append(PI(cur - o for o in others))
    den = PI(dens)
    num = sum([_divmod(nums[i] * den * y_s[i] % p, dens[i], p)
               for i in range(k)])
    return (_divmod(num, den, p) + p) % p


def recover_secret(shares, prime, min_s):
    """
    Recover the secret from share points
    (points (x,y) on the polynomial).
    """
    int_prime = int(prime)
    if len(shares) < min_s:
        raise ValueError(f"need at least {min_s} shares")
    x_s, y_s = zip(*shares)
    return _lagrange_interpolate(0, x_s, y_s, int_prime)


def update_list(starting_num, total_num, input_list):
    result = [(i - starting_num + 1, y) for i, y in input_list[:total_num]]
    return result


def read_shares_from_files(shares_folder, fi_ID, all_total_shares, start_num, user_type, encryption_type, block_mode, mac_mode):
    """
    Reads share values from files in the specified folder and returns a list of points.
    """
    # Create the list of fragment files, will contain the file name
    fragment_files = []
    for x in range(len(fi_ID)):
        fragment_files.append("share_" + str(fi_ID[x][0]) + ".encrypted")
    print(fragment_files)
    for y in range(len(fragment_files)):
        blob_name = fragment_files[y]
        local_file_name = "users/endUser/" + blob_name

        azure_download(blob_name, local_file_name)
        google_download(blob_name, local_file_name)
        aws_download(blob_name, local_file_name)
    points = []
    for x in range(len(fragment_files)):
        # Iterate through each file in the folder
        for filename in os.listdir(shares_folder):
            if filename == fragment_files[x]:
                share_file_path = os.path.join(shares_folder, filename)

                # Extract the share index from the filename
                share_index = int(filename.split('_')[1].split('.')[0])

                # Get the encryption key from the database based on the share ID
                encryptionK = retrieve_eKeys(share_index)

                # Read the share value from the file
                # with open(share_file_path, 'r') as share_file:
                #     share_value = int(share_file.read())
                if user_type == "non-tech":
                    decrypted_share = decrypt_AES_GCM(  # GCM OK
                        share_file_path, encryptionK)
                elif encryption_type == "AES":
                    if block_mode == "GCM":
                        decrypted_share = decrypt_AES_GCM(  # GCM OK
                            share_file_path, encryptionK)
                    elif block_mode == "CTR":
                        decrypted_share = decrypt_aes_ctr(  # CTR OK
                            share_file_path, encryptionK)
                    elif block_mode == "OFB":
                        decrypted_share = decrypt_aes_ofb(  # OFB OK
                            share_file_path, encryptionK)
                    else:
                        decrypted_share = decrypt_aes_cbc(  # CBC OK
                            share_file_path, encryptionK)
                elif encryption_type == "Camellia":
                    if block_mode == "OFB":
                        decrypted_share = camellia_decrypt_OFB(  # OFB OK
                            share_file_path, encryptionK)
                    elif block_mode == "CFB":
                        decrypted_share = camellia_decrypt_CFB(  # CFB OK
                            share_file_path, encryptionK)
                    else:
                        decrypted_share = camellia_decrypt_CBC(  # CBC OK
                            share_file_path, encryptionK)
                elif encryption_type == "CAST":
                    if block_mode == "CBC":
                        decrypted_share = cast128_decrypt_CBC(  # CBC OK
                            share_file_path, encryptionK)
                    elif block_mode == "CTR":
                        decrypted_share = cast128_decrypt_CTR(  # CTR OK
                            share_file_path, encryptionK)
                    elif block_mode == "OFB":
                        decrypted_share = cast128_decrypt_OFB(  # OFB OK
                            share_file_path, encryptionK)
                    else:
                        decrypted_share = cast128_decrypt_CFB(  # CFB OK
                            share_file_path, encryptionK)
                elif encryption_type == "IDEA":
                    if block_mode == "CBC":
                        decrypted_share = idea_decrypt_cbc(  # CBC OK
                            share_file_path, encryptionK)
                    elif block_mode == "OFB":
                        decrypted_share = idea_decrypt_OFB(  # OFB OK
                            share_file_path, encryptionK)
                    else:
                        decrypted_share = idea_decrypt_CFB(  # CFB OK
                            share_file_path, encryptionK)
                elif encryption_type == "SM4":
                    decrypted_share = sm4_decrypt(
                        share_file_path, block_mode, encryptionK)  # CBC OFB CFB CTR OK
                else:  # CHACHA
                    if mac_mode == "No-MAC":
                        decrypted_share = chacha20_decrypt(
                            share_file_path, encryptionK)  # OK
                    else:  # chacha20_poly1305
                        decrypted_share = chacha20_poly1305_decrypt(
                            encryptionK, share_file_path)

                points.append((share_index, decrypted_share))
    # Sort the points based on the share index
    points.sort(key=lambda x: x[0])
    updated_points = update_list(start_num, all_total_shares, points)
    fragment_files.clear()
    for x in range(len(fi_ID)):
        fragment_files.append("share_" + str(fi_ID[x][0]) + ".txt")
    print(fragment_files)
    for y in range(len(fragment_files)):
        blob_name = fragment_files[y]
        local_file_name = "users/endUser/" + blob_name
        os.remove(local_file_name)
    return updated_points


def output_prime_number(f_name, p_number):
    # Output the prime number
    output_file_path = "users\\endUser\\" + \
        "/primeNumber_" + str(f_name) + ".txt"

    with open(output_file_path, 'w') as file:
        file.write(str(p_number))

    # Upload a file
    blob = "primeNumber_" + str(f_name) + ".txt"
    azure_upload(blob, str(p_number))
    google_upload(output_file_path, blob)
    aws_upload(output_file_path, blob)
    os.remove(output_file_path)


# Example functions (you may need to adjust based on your requirements)
def calculate_dynamic_min_threshold(file_size, default_min_share):
    # Set a dynamic threshold based on file size
    if file_size > 1024 or default_min_share == 5:  # Adjust the condition as needed
        return 5
    else:
        return default_min_share


def calculate_dynamic_total_shares_threshold(file_size, default_total_shares):
    # Set a dynamic total shares based on file size
    if file_size > 1024:  # Adjust the condition as needed
        return default_total_shares + 5
    else:
        return default_total_shares


def update_shares_in_database(file_id, min_shares, total_shares):
    connection = create_connection()

    if connection is not None:
        try:
            cursor = connection.cursor()
            # Define the update query
            update_query = """
                UPDATE filedetails
                SET minShares = %s, totalShares = %s
                WHERE FileID = %s;
            """

            # Execute the update query
            cursor.execute(update_query, (min_shares, total_shares, file_id))

            # Commit the changes
            connection.commit()
        except Error as e:
            print("Error while working with MySQL:", e)
        finally:
            cursor.close()
            close_connection(connection)


def get_file_type(file_name):

    # Check file extension
    _, extension = os.path.splitext(file_name)
    extension = extension.lower()

    if extension == '.txt':
        return 'Text file'
    elif extension == '.docx':
        return 'Microsoft Word document'
    elif extension == '.pdf':
        return 'PDF document'
    elif extension == '.jpg':
        return 'Image file'
    else:
        return f'Unknown file type'


def read_docx(file_path):
    """
    Reads text content from a DOCX file and returns the text.
    """
    doc = Document(file_path)
    text = ""
    for paragraph in doc.paragraphs:
        text += paragraph.text + "\n"
    return text.strip()


def read_pdf(file_path):
    """
    Reads text content from a PDF file and returns the text.
    """
    doc = fitz.open(file_path)
    text = ""
    for page_num in range(doc.page_count):
        page = doc[page_num]
        text += page.get_text()
    doc.close()
    return text


def preprocessing(path):
    img = Image.open(path)
    data = np.asarray(img)
    return data.flatten(), data.shape


def insert_text_chunk(src_png, dst_png, text):
    '''在png中的第二个chunk插入自定义内容'''
    reader = png.Reader(filename=src_png)
    chunks = reader.chunks()  # 创建一个每次返回一个chunk的生成器
    chunk_list = list(chunks)
    chunk_item = tuple([b'tEXt', text])

    index = 1
    chunk_list.insert(index, chunk_item)

    with open(dst_png, 'wb') as dst_file:
        png.write_chunks(dst_file, chunk_list)

    return


def read_text_chunk(src_png, index=1):
    '''读取png的第index个chunk'''
    print("src_png: ", src_png)
    reader = png.Reader(filename=src_png)
    chunks = reader.chunks()
    chunk_list = list(chunks)
    img_extra = chunk_list[index][1].decode()
    img_extra = eval(img_extra)
    return img_extra


def polynomial(img, n, r):
    num_pixels = img.shape[0]
    # 生成多项式系数
    coefficients = np.random.randint(low=0, high=257, size=(num_pixels, r - 1))
    secret_imgs = []
    imgs_extra = []
    for i in range(1, n + 1):
        # 构造(r-1)次多项式
        base = np.array([i ** j for j in range(1, r)])
        base = np.matmul(coefficients, base)

        secret_img = (img + base) % 257

        indices = np.where(secret_img == 256)[0]
        img_extra = indices.tolist()
        secret_img[indices] = 0

        secret_imgs.append(secret_img)
        imgs_extra.append(img_extra)
    return np.array(secret_imgs), imgs_extra


def format_size(size_bytes):
    """ 根据字节大小自动调整单位 """
    if size_bytes == 0:
        return "0B"
    size_names = ("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB")
    i = int(math.floor(math.log(size_bytes, 1024)))
    p = math.pow(1024, i)
    s = round(size_bytes / p, 2)
    return f"{s} {size_names[i]}"


def get_file_size(file_path):
    """ 获取文件大小并格式化输出 """
    try:
        size = os.path.getsize(file_path)
        return format_size(size)
    except OSError as e:
        return f"Error: {e}"


def lagrange(x, y, num_points, x_test):
    l = np.zeros(shape=(num_points,))
    for k in range(num_points):

        l[k] = 1
        for k_ in range(num_points):

            if k != k_:
                d = int(x[k] - x[k_])
                inv_d = inverse(d, 257)
                l[k] = l[k] * (x_test - x[k_]) * inv_d % 257

            else:
                pass
    L = 0
    for i in range(num_points):
        L += y[i] * l[i]
    return L


def decode(imgs, imgs_extra, index, r):
    assert imgs.shape[0] >= r
    x = np.array(index)
    dim = imgs.shape[1]
    img = []

    print("decoding:")
    last_percent_reported = None
    imgs_add = np.zeros_like(imgs, dtype=np.int32)
    for i in range(r):
        for indices in imgs_extra[i]:
            imgs_add[i][indices] = 256

    for i in range(dim):
        y = imgs[:, i]
        ex_y = imgs_add[:, i]
        y = y + ex_y
        pixel = lagrange(x, y, r, 0) % 257
        img.append(pixel)

        # 计算当前进度
        percent_done = (i + 1) * 100 // dim
        if last_percent_reported != percent_done:
            if percent_done % 1 == 0:
                last_percent_reported = percent_done
                bar_length = 50
                block = int(bar_length * percent_done / 100)
                text = "\r[{}{}] {:.2f}%".format(
                    "█" * block, " " * (bar_length - block), percent_done)
                sys.stdout.write(text)
                sys.stdout.flush()

    print()

    return np.array(img)


def make_random_share_img(f_name, m_share, t_share, frag_id, u_type, k_size, e_type, b_mode, m_mode, n_size):
    if m_share > t_share:
        raise ValueError("Pool secret would be irrecoverable.")
    # Create a folder for the share files
    folder_path = "users\\endUser\\"
    os.makedirs(folder_path, exist_ok=True)
    print(frag_id)
    # Determine the cloud provider for each share in a round-robin fashion
    cloud_providers = ['azure', 'google', 'aws']
    cloud_index = 0
    # counter to retrieve the fragmentID
    count = 0

    img_flattened, shape = preprocessing(f_name)
    secret_imgs, imgs_extra = polynomial(
        img_flattened, n=t_share, r=m_share)
    to_save = secret_imgs.reshape(t_share, *shape)
    for i, img in enumerate(to_save):
        eKey = 0
        if (k_size == "128"):
            eKey = secrets.token_bytes(16)
        elif (k_size == "192"):
            eKey = secrets.token_bytes(24)
        else:
            eKey = secrets.token_bytes(32)
        save_key_to_table(frag_id[count][0], eKey)

        # Write each share to a separate file
        secret_img_path = os.path.join(
            folder_path, f'share_{frag_id[count][0]}.png')

        blob_file_name = f'share_{frag_id[count][0]}.png'

        Image.fromarray(img.astype(np.uint8)).save(secret_img_path)
        img_extra = str(list((imgs_extra[i]))).encode()
        insert_text_chunk(secret_img_path, secret_img_path, img_extra)

        size = get_file_size(secret_img_path)

        print(f"{secret_img_path} saved.", size)

        with open(secret_img_path, "rb") as file_img:
            file_img_byte = file_img.read()

        encryptedShare = encrypt_AES_GCM(file_img_byte, eKey)

        # Write each share to a separate file
        share_file_path = os.path.join(
            folder_path, f'share_{frag_id[count][0]}.encrypted')

        blob_file_name = f'share_{frag_id[count][0]}.encrypted'

        with open(share_file_path, 'w') as share_file:
            share_file.write(str(encryptedShare))

        count += 1
        # Upload a file based on the round-robin cloud provider assignment
        if cloud_providers[cloud_index] == 'azure':
            # azure_upload(blob_file_name, str(encryptedShare))
            aws_upload(share_file_path, blob_file_name)
        elif cloud_providers[cloud_index] == 'google':
            # azure_upload(blob_file_name, str(encryptedShare))
            google_upload(share_file_path, blob_file_name)
        elif cloud_providers[cloud_index] == 'aws':
            google_upload(share_file_path, blob_file_name)
            aws_upload(share_file_path, blob_file_name)

        os.remove(secret_img_path)
        os.remove(share_file_path)

        # Move to the next cloud provider in a round-robin fashion
        cloud_index = (cloud_index + 1) % len(cloud_providers)


# Main driver
def SSS(file_name, min_share, total_shares, filee_name, frag_ids, u_type, k_size, e_type, b_mode, m_mode, n_size):
    # Large prime numbers
    # Specify the number of bits for the prime number, need
    num_bits = 3072  # Use 1024, 2048-bit, 3072-bit, 4096-bit if got problem/ need more security
    # Generate a random prime number with the specified number of bits
    _PRIME = number.getPrime(num_bits)
    _RINT = functools.partial(random.SystemRandom().randint, 0)

    # Get the file type
    file_type = get_file_type(file_name)

    # Open and read the file
    if file_type == "Text file":
        with open(file_name, 'r') as file:
            file_string = file.read()
    elif file_type == "Microsoft Word document":
        file_string = read_docx(file_name)
    else:
        file_string = read_pdf(file_name)

    # Here process txt, docx, or pdf files
    if file_type == "Text file" or file_type == "Microsoft Word document" or file_type == "PDF document":
        # Instead of converting to binary, use the integer directly as the secret
        secret = int.from_bytes(file_string.encode(), byteorder='big')

        # Generate and save shares
        make_random_shares(secret, min_share, total_shares,
                           _PRIME, _RINT, frag_ids, u_type, k_size, e_type, b_mode, m_mode, n_size)
    # Here only process image files
    else:
        make_random_share_img(file_name, min_share, total_shares,
                              frag_ids, u_type, k_size, e_type, b_mode, m_mode, n_size)

    output_prime_number(filee_name, _PRIME)


def SSS_Reconstruct(user_file_id):
    share_folder = "users/endUser"
    print("SSSR NOW")
    # Retrieve the necessary details
    retireve_p_num = retrieve_prime_number(user_file_id)
    file_details = retrieve_file_details(user_file_id)
    frag_IDS = retrieve_fragement_ID(user_file_id)
    starting_number = retrieve_starting_number(user_file_id)
    min_frags = retrieve_min_fragements(user_file_id)
    # Read shares back from files
    points = read_shares_from_files(
        share_folder, frag_IDS, file_details[1], starting_number, file_details[2], file_details[3], file_details[4], file_details[5])
    # Perform secret recovery using the read shares
    x = recover_secret(points[-min_frags:], retireve_p_num, file_details[0])
    r_secret_string = x.to_bytes(
        (x.bit_length() + 7) // 8, byteorder='big').decode('utf-8', 'ignore')
    print("SSSR DONE")
    return r_secret_string


def SSS_Reconstruct_img(user_file_id, temp_f_path):
    share_folder = "users/endUser"
    print("SSSR NOW")

    # Retrieve the necessary details
    retireve_p_num = retrieve_prime_number(user_file_id)
    file_details = retrieve_file_details(user_file_id)
    frag_IDS = retrieve_fragement_ID(user_file_id)
    starting_number = retrieve_starting_number(user_file_id)
    min_frags = retrieve_min_fragements(user_file_id)

    fragment_files = []
    download_count = []
    decrypted_fragment_files = []
    for x in range(len(frag_IDS)):
        fragment_files.append("share_" + str(frag_IDS[x][0]) + ".encrypted")
    for x in range(len(frag_IDS)):
        decrypted_fragment_files.append(
            "share_" + str(frag_IDS[x][0]) + ".png")
    for y in range(len(fragment_files)):
        blob_name = fragment_files[y]
        local_file_name = "users/endUser/" + blob_name
        d1 = azure_download(blob_name, local_file_name)
        d2 = google_download(blob_name, local_file_name)
        d3 = aws_download(blob_name, local_file_name)
        if d1 or d2 or d3:
            share_index = int(fragment_files[y].split('_')[1].split('.')[0])
            download_count.append((share_index, share_index))
        else:
            print("Never activated")

    sorted_download_count = update_list(
        starting_number, file_details[1], download_count)

    updated_download_count = [item[0] for item in sorted_download_count]

    input_imgs = []
    input_imgs_extra = []

    # After reading the
    for i in updated_download_count:
        secret_img_path = "users/endUser/" + decrypted_fragment_files[i-1]
        to_decrypt_img_path = "users/endUser/" + fragment_files[i-1]

        encryptionK = retrieve_eKeys(share_index)

        decrypt_AES_GCM(to_decrypt_img_path, encryptionK)

        img_extra = read_text_chunk(secret_img_path)
        img, shape = preprocessing(secret_img_path)
        input_imgs.append(img)
        input_imgs_extra.append(img_extra)
    input_imgs = np.array(input_imgs)
    origin_img = decode(input_imgs, input_imgs_extra,
                        updated_download_count, r=min_frags)
    origin_img = origin_img.reshape(*shape)
    Image.fromarray(origin_img.astype(np.uint8)).save(temp_f_path)
    size = get_file_size(temp_f_path)
    print(f"{temp_f_path} saved.", size)

    # The final png should be saved in f_path

    fragment_files.clear()
    for x in range(len(frag_IDS)):
        fragment_files.append("share_" + str(frag_IDS[x][0]) + ".png")
    print(fragment_files)
    for y in range(len(fragment_files)):
        blob_name = fragment_files[y]
        local_file_name = "users/endUser/" + blob_name
        os.remove(local_file_name)
    print("SSSR DONE")


def get_file_details(file_id):
    print(file_id)
    conn = create_connection()
    cursor = conn.cursor(dictionary=True)

    try:
        # Fetch basic file details
        file_query = """
        SELECT f.FileID, f.FileName, f.TotalSize, fd.minShares, fd.totalShares, 
               fd.userType, fd.keySize, fd.encryptionType, fd.blockMode, fd.macMode
        FROM files f
        LEFT JOIN filedetails fd ON f.FileID = fd.FileID
        WHERE f.FileID = %s;
        """
        cursor.execute(file_query, (file_id,))
        file_details = cursor.fetchone()

        if file_details:
            # Fetch tokens and their details
            tokens_query = """
            SELECT Token, TokenID, Receipient, TokenExpiry
            FROM sharedfiles
            WHERE FileID = %s;
            """
            cursor.execute(tokens_query, (file_id,))
            tokens = cursor.fetchall()

            # If you want to format the TokenExpiry as a string or perform other transformations, do it here
            for token in tokens:
                token['TokenExpiry'] = token['TokenExpiry'].strftime(
                    '%Y-%m-%d') if token['TokenExpiry'] else 'Unknown'

            # Add the tokens to the file details
            file_details['Tokens'] = tokens

        return file_details
    except Exception as e:
        print(f"Error fetching file details: {e}")
        return None
    finally:
        cursor.close()
        conn.close()


def is_valid_email(email):
    """Validate the email address using a regular expression."""
    pattern = r'^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$'
    return re.match(pattern, email, re.I)


def generate_token_for_file(file_id, recipient_email):
    if not is_valid_email(recipient_email):
        print("Invalid email address.")
        return False

    conn = create_connection()
    cursor = conn.cursor()

    try:
        new_token = ''.join(random.choices(
            string.ascii_letters + string.digits, k=16))
        token_expiry = datetime.now() + timedelta(days=30)  # Token expires in 30 days

        # Fetch the OwnerUserID for the given FileID from the 'files' table
        cursor.execute(
            "SELECT OwnerUserID FROM files WHERE FileID = %s", (file_id,))
        owner_result = cursor.fetchone()

        # If owner_result is None, then no matching record was found
        if owner_result is None:
            print("No owner found for the given file ID.")
            return False

        # Assuming OwnerUserID is the first column in the result
        owner_user_id = owner_result[0]

        # Adjust the SQL query to include the recipient email and token expiry
        cursor.execute("INSERT INTO sharedfiles (FileID, OwnerUserID, Token, Receipient, TokenExpiry) VALUES (%s, %s, %s, %s, %s)",
                       (file_id, owner_user_id, new_token, recipient_email, token_expiry))
        conn.commit()
        send_email(recipient_email, new_token)
        return True
    except Exception as e:
        print(f"Error generating token for file: {e}")
        conn.rollback()
        return False
    finally:
        cursor.close()
        conn.close()


def revoke_token_for_file(token):
    conn = create_connection()
    cursor = conn.cursor()

    try:
        # Delete rows from the 'sharedfiles' table where the 'Token' column matches the provided token
        cursor.execute("DELETE FROM sharedfiles WHERE Token = %s", (token,))
        conn.commit()  # Commit the changes to the database
    except Exception as e:
        print(f"Error revoking token: {e}")
        conn.rollback()  # Rollback changes if there was an error
        return False
    finally:
        cursor.close()
        conn.close()

    return True


def get_file_id_by_token(token):
    try:
        conn = create_connection()
        cursor = conn.cursor()

        # Get the current time
        current_time = datetime.now()

        # Query to search for the token and check if it's expired
        query = "SELECT FileID FROM sharedfiles WHERE Token = %s AND TokenExpiry > %s"
        cursor.execute(query, (token, current_time))

        # Fetching the result
        result = cursor.fetchone()
        if result:
            return {"success": True, "file_id": result[0]}
        else:
            return {"success": False, "message": "Token not found or expired"}

    except Error as e:
        print("Error while connecting to MySQL", e)
        return {"success": False, "message": str(e)}

    finally:
        cursor.close()
        conn.close()


def get_file_fragments(file_id):
    connection = create_connection()  # Assuming this function sets up a DB connection
    # Use dictionary cursor to have column names
    cursor = connection.cursor(dictionary=True)
    query = "SELECT * FROM filefragments WHERE FileID = %s"
    cursor.execute(query, (file_id,))
    fragments = cursor.fetchall()  # Fetch all rows as a list of dicts
    cursor.close()
    connection.close()
    return fragments


def delete_file_data(file_id):
    fragments = get_file_fragments(file_id)
    for fragment in fragments:
        blob_name = f"share_{fragment['FragmentID']}.encrypted"
        prime_num = f"primeNumber_{file_id}.txt"
        # Azure
        azure_delete(blob_name)
        azure_delete(prime_num)
        # Google Cloud
        google_delete(blob_name)
        google_delete(prime_num)
        # AWS S3
        aws_delete(blob_name)
        aws_delete(prime_num)
    connection = create_connection()
    cursor = connection.cursor()
    # First, delete dependent rows from the `sharedfiles` table
    cursor.execute("DELETE FROM sharedfiles WHERE FileID = %s", (file_id,))

    # Then, delete file fragments
    cursor.execute("DELETE FROM filefragments WHERE FileID = %s", (file_id,))

    # Delete file details
    cursor.execute("DELETE FROM filedetails WHERE FileID = %s", (file_id,))

    # Finally, delete the file record from the `files` table
    cursor.execute("DELETE FROM files WHERE FileID = %s", (file_id,))

    connection.commit()  # Commit the transaction
    cursor.close()
    connection.close()


def get_user_profile(user_id):
    try:
        conn = create_connection()
        cursor = conn.cursor(dictionary=True)
        query = "SELECT UserID, Username, Email FROM users WHERE UserID = %s"
        cursor.execute(query, (user_id,))
        result = cursor.fetchone()
        return result
    except Error as e:
        print("Error while connecting to MySQL", e)
        return {"success": False, "message": str(e)}
    finally:
        if cursor:
            cursor.close()
        if conn:
            conn.close()


def update_user_profile(user_data):
    try:
        conn = create_connection()
        cursor = conn.cursor()
        query = "UPDATE users SET Username = %s, Email = %s WHERE UserID = %s"
        cursor.execute(
            query, (user_data['username'], user_data['email'], user_data['userID']))
        conn.commit()
        return {'success': True, 'message': 'Profile updated successfully'}
    except Error as e:
        print("Error while connecting to MySQL", e)
        return {"success": False, "message": str(e)}
    finally:
        if cursor:
            cursor.close()
        if conn:
            conn.close()


def send_email(recipient_email, token_code):
    # Email configuration
    EMAIL_ADDRESS = "trustsharingtoken@gmail.com"
    EMAIL_PASSWORD = "xrav cplk mkus btck"

    # Set up the MIME
    message = MIMEMultipart()
    message['From'] = EMAIL_ADDRESS
    message['To'] = recipient_email
    message['Subject'] = 'Your Trust Sharing Download Token'

    # Construct the email body
    email_body = f'Your token code is: {
        token_code}\n\nYou can download the file at: http://127.0.0.1:5000/tokenredirect'

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
        return jsonify({"message": str(e)}), 500
