from Crypto.Cipher import AES, CAST, ChaCha20, ChaCha20_Poly1305
from Crypto.Util import Counter, Padding
from Crypto.Hash import HMAC, SHA256
from Crypto.Util.Padding import pad
import secrets
import os
from cryptography.hazmat.primitives.ciphers import Cipher, algorithms, modes
from cryptography.hazmat.backends import default_backend
from cryptography.hazmat.primitives import padding
from Crypto.Random import get_random_bytes
from Crypto.Util.Padding import unpad


def encrypt_AES_GCM(plainText, secretKey):
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plainText).encode('utf-8')

    # Pad the message to increase the length of the final ciphertext
    padded_msg = Padding.pad(plainText_bytes, AES.block_size)

    aesCipher = AES.new(secretKey, AES.MODE_GCM)
    ciphertext, authTag = aesCipher.encrypt_and_digest(padded_msg)
    encryptedMsg = ciphertext, aesCipher.nonce, authTag
    tuple_str = str(encryptedMsg)

    return tuple_str


def decrypt_AES_GCM(fileName, secretKey):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, nonce, authTag) = encryptedMsg
    aesCipher = AES.new(secretKey, AES.MODE_GCM, nonce)
    decrypted_msg = aesCipher.decrypt_and_verify(ciphertext, authTag)
    # Unpad the decrypted message
    unpadded_msg = Padding.unpad(decrypted_msg, AES.block_size)

    # Convert bytes back to string
    decrypted_str = unpadded_msg.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"

    try:
        with open(newFileName, "w") as file:
            # Write the decrypted integer to the new file
            file.write(str(decrypted_int))
    except Exception as e:
        print(f"Error writing to {newFileName}: {e}")
        # If an error occurred, proceed to write to the image file
        newimgFileName = base
        newimgFileName += ".png"
        with open(newimgFileName, "wb") as file:
            # Write the decrypted integer to the new image file
            file.write(str(decrypted_int))
    else:
        print(f"Successfully wrote to {newFileName}")

    os.remove(fileName)

    return decrypted_int


def encrypt_aes_ctr(plaintext, key):
    # Generate a random 16-byte IV (Initialization Vector)
    iv = secrets.token_bytes(16)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    # Pad the message to increase the length of the final ciphertext
    padded_msg = Padding.pad(plainText_bytes, AES.block_size)

    # Create an AES cipher object with CTR mode
    cipher = AES.new(key, AES.MODE_CTR, counter=Counter.new(
        128, initial_value=int.from_bytes(iv, byteorder='big')))

    # Pad the plaintext and then encrypt
    ciphertext = cipher.encrypt(padded_msg)
    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def decrypt_aes_ctr(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg
    # Extract the IV and ciphertext from the data
    # Create an AES cipher object with CTR mode
    cipher = AES.new(key, AES.MODE_CTR, counter=Counter.new(
        128, initial_value=int.from_bytes(iv, byteorder='big')))

    # Decrypt the ciphertext
    decrypted_msg = cipher.decrypt(ciphertext)

    # Unpad the decrypted message
    unpadded_msg = Padding.unpad(decrypted_msg, AES.block_size)

    # Convert bytes back to string
    decrypted_str = unpadded_msg.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def encrypt_aes_ofb(plaintext, key):
    # Generate a random 16-byte IV (Initialization Vector)
    iv = secrets.token_bytes(16)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    # Pad the message to increase the length of the final ciphertext
    padded_msg = Padding.pad(plainText_bytes, AES.block_size)

    # Create an AES cipher object with OFB mode
    cipher = AES.new(key, AES.MODE_OFB, iv)

    # Pad the plaintext and then encrypt
    ciphertext = cipher.encrypt(padded_msg)
    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def decrypt_aes_ofb(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg
    # Extract the IV and ciphertext from the data

    # Create an AES cipher object with OFB mode
    cipher = AES.new(key, AES.MODE_OFB, iv)

    # Decrypt the ciphertext
    decrypted_msg = cipher.decrypt(ciphertext)

    # Unpad the decrypted message
    unpadded_msg = Padding.unpad(decrypted_msg, AES.block_size)

    # Convert bytes back to string
    decrypted_str = unpadded_msg.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def encrypt_aes_cbc(plaintext, key):
    # Generate a random 16-byte IV (Initialization Vector)
    iv = secrets.token_bytes(16)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    # Pad the message to increase the length of the final ciphertext
    padded_msg = Padding.pad(plainText_bytes, AES.block_size)

    # Create an AES cipher object with CBC mode
    cipher = AES.new(key, AES.MODE_CBC, iv)

    # Pad the plaintext and then encrypt
    ciphertext = cipher.encrypt(padded_msg)
    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def decrypt_aes_cbc(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg
    # Extract the IV and ciphertext from the data
    # Create an AES cipher object with CBC mode
    cipher = AES.new(key, AES.MODE_CBC, iv)

    # Decrypt the ciphertext
    decrypted_msg = cipher.decrypt(ciphertext)

    # Unpad the decrypted message
    unpadded_msg = Padding.unpad(decrypted_msg, AES.block_size)

    # Convert bytes back to string
    decrypted_str = unpadded_msg.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def camellia_encrypt_OFB(plaintext, key):
    # Generate a random 16-byte IV (Initialization Vector)
    iv = secrets.token_bytes(16)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    cipher = Cipher(algorithms.Camellia(key), modes.OFB(iv),
                    backend=default_backend())
    encryptor = cipher.encryptor()
    ciphertext = encryptor.update(plainText_bytes) + encryptor.finalize()

    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def camellia_decrypt_OFB(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg

    cipher = Cipher(algorithms.Camellia(key), modes.OFB(iv),
                    backend=default_backend())
    decryptor = cipher.decryptor()
    decrypted_data = decryptor.update(ciphertext) + decryptor.finalize()

    # Convert bytes back to string
    decrypted_str = decrypted_data.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def camellia_encrypt_CBC(plaintext, key):
    # Generate a random 16-byte IV (Initialization Vector)
    iv = secrets.token_bytes(16)

    # Convert plaintext to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')

    # Apply PKCS7 padding to make the plaintext length a multiple of the block size
    padder = padding.PKCS7(128).padder()
    padded_data = padder.update(plainText_bytes) + padder.finalize()

    # Create the cipher object
    cipher = Cipher(algorithms.Camellia(key), modes.CBC(iv),
                    backend=default_backend())

    # Encrypt the padded data
    encryptor = cipher.encryptor()
    ciphertext = encryptor.update(padded_data) + encryptor.finalize()

    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)

    # Return IV and ciphertext
    return tuple_str


def camellia_decrypt_CBC(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg

    cipher = Cipher(algorithms.Camellia(key), modes.CBC(iv),
                    backend=default_backend())
    decryptor = cipher.decryptor()
    decrypted_data = decryptor.update(ciphertext) + decryptor.finalize()

    # Remove PKCS7 padding
    unpadder = padding.PKCS7(128).unpadder()
    unpadded_data = unpadder.update(decrypted_data) + unpadder.finalize()

    # Convert bytes back to string
    decrypted_str = unpadded_data.decode('utf-8')

    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)

    # Remove the ".encrypted" extension and any other extensions
    newFileName = base.replace(".encrypted", "")

    # Add ".txt" extension
    newFileName += ".txt"

    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    # Remove the encrypted file
    os.remove(fileName)

    return decrypted_int


def camellia_encrypt_CFB(plaintext, key):
    # Generate a random 16-byte IV (Initialization Vector)
    iv = secrets.token_bytes(16)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    cipher = Cipher(algorithms.Camellia(key), modes.CFB(iv),
                    backend=default_backend())
    encryptor = cipher.encryptor()
    plainText_bytes = str(plaintext).encode('utf-8')
    ciphertext = encryptor.update(plainText_bytes) + encryptor.finalize()

    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def camellia_decrypt_CFB(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg

    cipher = Cipher(algorithms.Camellia(key), modes.CFB(iv),
                    backend=default_backend())
    decryptor = cipher.decryptor()
    decrypted_data = decryptor.update(ciphertext) + decryptor.finalize()

    # Convert bytes back to string
    decrypted_str = decrypted_data.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def cast128_encrypt_CBC(plaintext, key):
    # Generate a random 16-byte IV (Initialization Vector)
    iv = secrets.token_bytes(8)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')

    cipher = CAST.new(key, CAST.MODE_CBC, iv)
    ciphertext = cipher.encrypt(pad(plainText_bytes, CAST.block_size))

    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def cast128_decrypt_CBC(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg
    cipher = CAST.new(key, CAST.MODE_CBC, iv)
    decrypted = cipher.decrypt(ciphertext)
    unpad_decrypted = unpad(decrypted, CAST.block_size)

    # Convert bytes back to string
    decrypted_str = unpad_decrypted.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def cast128_encrypt_CTR(plaintext, key):
    nonce_7 = secrets.token_bytes(7)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    cipher = CAST.new(key, CAST.MODE_CTR, nonce=nonce_7)

    ciphertext = cipher.encrypt(plainText_bytes)
    encryptedMsg = ciphertext, nonce_7
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def cast128_decrypt_CTR(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, nonce_7) = encryptedMsg
    cipher = CAST.new(key, CAST.MODE_CTR, nonce=nonce_7)
    decrypted = cipher.decrypt(ciphertext)

    # Convert bytes back to string
    decrypted_str = decrypted.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def cast128_encrypt_OFB(plaintext, key):
    iv = secrets.token_bytes(8)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    cipher = CAST.new(key, CAST.MODE_OFB, iv)

    ciphertext = cipher.encrypt(plainText_bytes)
    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def cast128_decrypt_OFB(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg
    cipher = CAST.new(key, CAST.MODE_OFB, iv)
    decrypted = cipher.decrypt(ciphertext)

    # Convert bytes back to string
    decrypted_str = decrypted.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def cast128_encrypt_CFB(plaintext, key):
    iv = secrets.token_bytes(8)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    cipher = CAST.new(key, CAST.MODE_CFB, iv)

    ciphertext = cipher.encrypt(plainText_bytes)
    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def cast128_decrypt_CFB(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg
    cipher = CAST.new(key, CAST.MODE_CFB, iv)
    decrypted = cipher.decrypt(ciphertext)

    # Convert bytes back to string
    decrypted_str = decrypted.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def idea_encrypt_CBC(plaintext, key):
    iv = secrets.token_bytes(8)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')

    cipher = Cipher(
        algorithms.IDEA(key),
        modes.CBC(iv),
        backend=default_backend()
    )
    encryptor = cipher.encryptor()
    # Add padding to the plaintext
    padder = padding.PKCS7(64).padder()
    plaintext_padded = padder.update(plainText_bytes) + padder.finalize()

    # Encrypt the padded plaintext
    ciphertext = encryptor.update(plaintext_padded) + encryptor.finalize()

    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def idea_decrypt_cbc(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg

    cipher = Cipher(
        algorithms.IDEA(key),
        modes.CBC(iv),
        backend=default_backend()
    )
    decryptor = cipher.decryptor()

    # Decrypt the ciphertext
    decrypted_padded = decryptor.update(ciphertext) + decryptor.finalize()

    # Remove padding
    unpadder = padding.PKCS7(64).unpadder()
    decrypted = unpadder.update(decrypted_padded) + unpadder.finalize()

    # Convert bytes back to string
    decrypted_str = decrypted.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def idea_encrypt_OFB(plaintext, key):
    iv = secrets.token_bytes(8)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')

    cipher = Cipher(
        algorithms.IDEA(key),
        modes.OFB(iv),
        backend=default_backend()
    )
    encryptor = cipher.encryptor()

    # Add padding to the plaintext
    padder = padding.PKCS7(64).padder()
    plaintext_padded = padder.update(plainText_bytes) + padder.finalize()

    # Encrypt the padded plaintext
    ciphertext = encryptor.update(plaintext_padded) + encryptor.finalize()

    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def idea_decrypt_OFB(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg

    cipher = Cipher(
        algorithms.IDEA(key),
        modes.OFB(iv),
        backend=default_backend()
    )
    decryptor = cipher.decryptor()

    # Decrypt the ciphertext
    decrypted_padded = decryptor.update(ciphertext) + decryptor.finalize()

    # Remove padding
    unpadder = padding.PKCS7(64).unpadder()
    decrypted = unpadder.update(decrypted_padded) + unpadder.finalize()

    # Convert bytes back to string
    decrypted_str = decrypted.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def idea_encrypt_CFB(plaintext, key):
    iv = secrets.token_bytes(8)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')

    cipher = Cipher(
        algorithms.IDEA(key),
        modes.CFB(iv),
        backend=default_backend()
    )
    encryptor = cipher.encryptor()
    plainText_bytes = str(plaintext).encode('utf-8')

    # Add padding to the plaintext
    padder = padding.PKCS7(64).padder()
    plaintext_padded = padder.update(plainText_bytes) + padder.finalize()

    # Encrypt the padded plaintext
    ciphertext = encryptor.update(plaintext_padded) + encryptor.finalize()

    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def idea_decrypt_CFB(fileName, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg

    cipher = Cipher(
        algorithms.IDEA(key),
        modes.CFB(iv),
        backend=default_backend()
    )
    decryptor = cipher.decryptor()

    # Decrypt the ciphertext
    decrypted_padded = decryptor.update(ciphertext) + decryptor.finalize()

    # Remove padding
    unpadder = padding.PKCS7(64).unpadder()
    decrypted = unpadder.update(decrypted_padded) + unpadder.finalize()

    # Convert bytes back to string
    decrypted_str = decrypted.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def sm4_encrypt(plaintext, mode, key):
    iv = secrets.token_bytes(16)
    # Convert integer to bytes using UTF-8 encoding
    plainText_bytes = str(plaintext).encode('utf-8')
    padder = padding.PKCS7(128).padder()
    cipher = None
    if mode == "CBC":
        cipher = Cipher(algorithms.SM4(key), modes.CBC(iv))
    elif mode == "OFB":
        cipher = Cipher(algorithms.SM4(key), modes.OFB(iv))
    elif mode == "CFB":
        cipher = Cipher(algorithms.SM4(key), modes.CFB(iv))
    elif mode == "CTR":
        cipher = Cipher(algorithms.SM4(key), modes.CTR(iv))

    encryptor = cipher.encryptor()
    encrypted_str = padder.update(plainText_bytes) + padder.finalize()
    ciphertext = encryptor.update(encrypted_str) + encryptor.finalize()
    encryptedMsg = ciphertext, iv
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def sm4_decrypt(fileName, mode, key):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    (ciphertext, iv) = encryptedMsg

    cipher = None
    if (mode == "CBC"):
        cipher = Cipher(algorithms.SM4(key), modes.CBC(iv))
    if (mode == "OFB"):
        cipher = Cipher(algorithms.SM4(key), modes.OFB(iv))
    if (mode == "CFB"):
        cipher = Cipher(algorithms.SM4(key), modes.CFB(iv))
    if (mode == "CTR"):
        cipher = Cipher(algorithms.SM4(key), modes.CTR(iv))

    decryptor = cipher.decryptor()
    unpadder = padding.PKCS7(128).unpadder()

    # Decrypt the ciphertext without the IV
    decrypted_bytes = decryptor.update(
        ciphertext) + decryptor.finalize()

    # Remove padding
    unpadded_bytes = unpadder.update(decrypted_bytes) + unpadder.finalize()

    # Convert bytes back to string
    decrypted_str = unpadded_bytes.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def chacha20_encrypt(plaintext, input_nonce, key):
    nonce = get_random_bytes(int(input_nonce))
    plainText_bytes = str(plaintext).encode('utf-8')

    cipher = ChaCha20.new(key=key, nonce=nonce)

    # Pad the plaintext before encryption
    padded_plaintext = pad(plainText_bytes, ChaCha20.block_size)

    ciphertext = cipher.encrypt(padded_plaintext)
    encryptedMsg = ciphertext, nonce
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def chacha20_decrypt(fileName, key):

    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    ciphertext, nonce = encryptedMsg

    cipher = ChaCha20.new(key=key, nonce=nonce)

    # Decrypt the ciphertext
    padded_plaintext = cipher.decrypt(ciphertext)

    # Unpad the result
    plaintext = unpad(padded_plaintext, ChaCha20.block_size)

    # Convert bytes back to string
    decrypted_str = plaintext.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int


def chacha20_poly1305_encrypt(key, input_nonce, plaintext, associated_data=b""):
    nonce = get_random_bytes(int(input_nonce))
    plainText_bytes = str(plaintext).encode('utf-8')
    cipher = ChaCha20_Poly1305.new(key=key, nonce=nonce)
    cipher.update(associated_data)

    ciphertext, tag = cipher.encrypt_and_digest(plainText_bytes)

    # Concatenate ciphertext and tag
    encryptedMsg = ciphertext, tag, nonce, associated_data
    tuple_str = str(encryptedMsg)
    # Return IV and ciphertext
    return tuple_str


def chacha20_poly1305_decrypt(key, fileName):
    with open(fileName, "r") as file:
        tuple_str = file.read()
        encryptedMsg = eval(tuple_str)
    ciphertext, tag, nonce, associated_data = encryptedMsg

    cipher = ChaCha20_Poly1305.new(key=key, nonce=nonce)
    cipher.update(associated_data)
    plaintext = cipher.decrypt_and_verify(ciphertext, tag)

    # Convert bytes back to string
    decrypted_str = plaintext.decode('utf-8')
    # Convert string to integer
    decrypted_int = int(decrypted_str)

    # Split the filename into base and extension parts
    base, extension = os.path.splitext(fileName)
    # Remove the ".encrypted" extension
    newFileName = base
    # Add ".txt" extension
    newFileName += ".txt"
    with open(newFileName, "w") as file:
        # Write the decrypted integer to the new file
        file.write(str(decrypted_int))

    os.remove(fileName)
    return decrypted_int
