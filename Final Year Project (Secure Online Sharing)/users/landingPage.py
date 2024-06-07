from flask import Flask, request, jsonify, render_template, session, redirect, url_for, send_file
from . import Account
import os
from flask_session import Session
from .endUser.endUserUploadCTL import upload_blueprint
from .admin.adminCNTRL import admin_blueprint
from .endUser.files2 import *

app = Flask(__name__)

app.register_blueprint(upload_blueprint)
app.register_blueprint(admin_blueprint, url_prefix='/admin')

app.config['UPLOAD_FOLDER'] = 'users/uploads'


# Set the secret key from the environment variable or use a default for development
app.config['SECRET_KEY'] = os.environ.get(
    'FLASK_SECRET_KEY', 'default_key_for_dev')

# Session configuration
app.config['SESSION_TYPE'] = 'filesystem'
Session(app)


@app.route('/')
def index():
    return render_template('/landingPage.html')


@app.route('/loginPage')
def login_page():
    return render_template('login.html')


@app.route('/logoutPage')
def logout_page():
    return render_template('logout.html')


@app.route('/forgot_password_page')
def forgot_password_page():
    return render_template('forgot_password.html')


@app.route('/reset_password_page')
def reset_password_page():
    return render_template('reset_password.html')


@app.route('/change_password', methods=['POST'])
def change_password():
    user_data = request.json

    if Account.check_token_existence(user_data['token']):
        user_email = Account.get_email_from_token(user_data['token'])
        Account.update_password(user_email, user_data['password'])
        return jsonify({'success': True})
    else:
        return jsonify({'success': False})


@app.route('/register', methods=['POST'])
def register():
    user_data = request.json

    # Check for empty fields
    if not user_data['email'] or not user_data['username'] or not user_data['password']:
        return jsonify({'message': 'All fields must be filled', 'status': 'fail'}), 400

    success, message = Account.register_user(
        user_data['email'], user_data['username'], user_data['password'])

    return jsonify({'message': message}), (200 if success else 400)


@app.route('/login', methods=['POST'])
def user_login():
    user_data = request.json

    if not user_data['email'] or not user_data['password']:
        return jsonify({'message': 'Email and password are required', 'status': 'fail'}), 400
    last_login = Account.retrieve_last_login(user_data['email'])
    user = Account.validate_login(user_data['email'], user_data['password'])

    if user and last_login != None:
        session['user_id'] = user['UserID']
        session['role'] = user['role']
        # Include the role in the response
        return jsonify({'message': 'Login successful', 'status': 'success', 'role': user['role'], 'lastlog': True})
    elif last_login == None:
        user_name = Account.retrieve_username(user_data['email'])
        Account.create_2FA(user_name, user_data['email'])
        return jsonify({'message': 'Login successful', 'status': 'success', 'lastLog': False})
    else:
        return jsonify({'message': 'Invalid credentials', 'status': 'fail'}), 401


@app.route('/homePage')
def homepage():
    # Add a debugging message
    print("Accessing homepage route")
    # Serve the homePage.html file
    return render_template('homePage.html')


@app.route('/logout')
def logout():
    # Remove 'user_id' from the session
    session.pop('user_id', None)
    # Redirect to the login page
    return redirect(url_for('logout_page'))


@app.route('/tokenredirect')
def tokenredirect_route():
    # Add a debugging message
    print("Accessing downlaod route")
    # Serve the homePage.html file
    return render_template('tokenDownload.html')


@app.route('/passwordReset', methods=['POST'])
def passwordReset_route():
    data = request.json
    email = data['email']
    if not email:
        return jsonify({'success': False, 'message': 'Recipient email is missing'}), 400
    success = Account.send_reset_email(email)
    if success:
        return jsonify({'success': True, 'message': 'Email sent'})
    else:
        return jsonify({'success': False, 'message': 'No email matching new found.'})


@app.route('/downloadfile', methods=['POST'])
def download_file_route():
    data = request.json
    token = data['token']
    file_id_response = get_file_id_by_token(token)

    if file_id_response['success']:
        file_id = file_id_response['file_id']
        s_string = SSS_Reconstruct(file_id)

        # Get the absolute path to the directory where the script is located
        script_dir = os.path.dirname(os.path.abspath(__file__))

        # Create the full path to the temporary file
        temp_file_path = os.path.join(
            script_dir, "tempfiles", "temp_file_" + str(file_id) + ".txt")

        # Create the directory if it doesn't exist
        os.makedirs(os.path.dirname(temp_file_path), exist_ok=True)

        # Write to the file
        with open(temp_file_path, 'w') as temp_file:
            temp_file.write(s_string)

        # Assuming s_string contains the path to the reconstructed file
        # You can provide this path for the file download
        if s_string:
            temp_file_path = os.path.join(
                script_dir, "tempfiles", "temp_file_" + str(file_id) + ".txt")
            os.makedirs(os.path.dirname(temp_file_path), exist_ok=True)
            with open(temp_file_path, 'w') as temp_file:
                temp_file.write(s_string)
            return send_file(temp_file_path, as_attachment=True, download_name="s_string.txt")
        else:
            return render_template('error_page.html', message="File reconstruction failed")
    else:
        return render_template('error_page.html', message="Token not found or expired")


@app.route('/validate-otp', methods=['POST'])
def validate_otp():
    data = request.get_json()  # Get JSON data from the request
    otp = data.get('otp')
    email = data.get('email')
    otp_check = Account.verify_otp(otp, email)
    # Check if OTP is valid
    if otp_check == True:
        # Return success response
        return jsonify({'message': 'Login successful', 'status': 'success'})
    else:
        return jsonify({'error': 'Invalid OTP'}), 400  # Return error response
