from flask import Flask, render_template, request, jsonify, send_file, Blueprint, session, redirect, url_for
from datetime import datetime
import os
from .files2 import *
from flask_session import Session
from docx import Document


# Specify the folder where you want to save the uploaded files
upload_blueprint = Blueprint(
    'upload', __name__, template_folder='endUser_templates', static_folder='endUser_static')
UPLOAD_FOLDER = 'users/uploads'

# # Ensure the upload folder exists
os.makedirs(UPLOAD_FOLDER, exist_ok=True)


# # Reroute the user
@upload_blueprint.route('/display')
def display():
    # Call your function to retrieve data
    file_display = retrieve_files_to_Display()
    return render_template('endUserDisplayUI.html', files=file_display)


@upload_blueprint.route('/retrieveUI')
def retrieve():
    # Call your function to retrieve data
    file_display = retrieve_files_to_Display()
    return render_template('endUserRetrieveUI.html', files=file_display)


@upload_blueprint.route('/uploadUI')
def uploadUI():
    # Call your function to retrieve data
    return render_template('endUserUploadUI.html')


# Uploading the files
@upload_blueprint.route('/upload', methods=['POST'])
def upload():
    # Extract minshare and totalshare values from the request form data
    min_share = request.form.get('minshare')
    total_share = request.form.get('totalshare')
    user_id = session['user_id']
    user_type = request.form.get('usertype')
    key_size = request.form.get('keysize')
    encryption_type = request.form.get('encryptiontype')
    block_mode = request.form.get('blockmode')
    mac_mode = request.form.get('macmode')
    nonce_size = request.form.get('noncesize')

    # Check if 'file' is in request.files
    if 'file' not in request.files:
        return jsonify({'error': 'No file part'})

    # To retrieve a list of files with key 'file'
    files = request.files.getlist('file')

    # Upload the files
    upload_files(files, min_share, total_share, user_id, user_type,
                 key_size, encryption_type, block_mode, mac_mode, nonce_size)

    # Send a response with the progress status
    return jsonify({'message': 'File uploaded successfully'})


@upload_blueprint.route('/submit', methods=['POST'])
def submit():
    selected_file_id = int(request.form.get('selectedFile'))
    fileName = retrieve_file_name(selected_file_id)
    fileType = get_file_type(fileName)
    # You can now use the selected_file_id as needed, for example, process it, save it to a database, etc.
    # In this example, we'll just print it.
    # Get the absolute path to the directory where the script is located
    script_dir = os.path.dirname(os.path.abspath(__file__))

    if fileType == "Text file" or fileType == "Microsoft Word document" or fileType == "PDF document":
        s_string = SSS_Reconstruct(selected_file_id)
    else:
        temp_file_path = os.path.join(
            script_dir, "tempfiles", "temp_file_" + str(selected_file_id) + ".png")
        # Create the directory if it doesn't exist
        os.makedirs(os.path.dirname(temp_file_path), exist_ok=True)
        SSS_Reconstruct_img(selected_file_id, temp_file_path)

        d_name = "recovered.jpg"

    if fileType == "Text file":
        # Create the full path to the temporary file
        temp_file_path = os.path.join(
            script_dir, "tempfiles", "temp_file_" + str(selected_file_id) + ".txt")

        # Create the directory if it doesn't exist
        os.makedirs(os.path.dirname(temp_file_path), exist_ok=True)
        # Write to the file
        with open(temp_file_path, 'w') as temp_file:
            temp_file.write(s_string)
        d_name = "recovered.txt"

    elif fileType == "Microsoft Word document":
        # Create the full path to the temporary file
        temp_file_path = os.path.join(
            script_dir, "tempfiles", "temp_file_" + str(selected_file_id) + ".docx")

        # Create the directory if it doesn't exist
        os.makedirs(os.path.dirname(temp_file_path), exist_ok=True)
        # Create a new Document
        doc = Document()
        # Add a paragraph to the document with the secret string
        doc.add_paragraph(s_string)
        # Save the document to the specified path
        doc.save(temp_file_path)

        d_name = "recovered.docx"
    elif fileType == "PDF document":
        # Create the full path to the temporary file
        temp_file_path = os.path.join(
            script_dir, "tempfiles", "temp_file_" + str(selected_file_id) + ".pdf")
        # Create the directory if it doesn't exist
        os.makedirs(os.path.dirname(temp_file_path), exist_ok=True)

        # Create a PDF document
        doc = fitz.open()

        # Add a page to the document
        page = doc.new_page()

        # Add text to the page
        page.insert_text((50, 100), s_string,
                         fontname="helv", fontsize=12, color=(0, 0, 0))

        # Save the document to the specified path
        doc.save(temp_file_path)

        # Close the document
        doc.close()
        d_name = "recovered.pdf"
    else:
        pass

    # Send the file as an attachment for download
    return send_file(temp_file_path, as_attachment=True, download_name=d_name)


@upload_blueprint.route('/sharedFile/<int:file_id>')
def shared_file_route(file_id):
    # Pass file_id as a keyword argument to the template
    return render_template('endUserSharedUI.html', file_id=file_id)


@upload_blueprint.route('/getFileDetails')
def get_file_details_route():
    file_id = request.args.get('fileId')
    details = get_file_details(file_id)
    return jsonify(details)


@upload_blueprint.route('/generateToken', methods=['POST'])
def generate_token_route():
    data = request.get_json()
    file_id = data.get('fileId')
    # Extract recipientEmail from JSON body
    recipient_email = data.get('recipientEmail')

    if not file_id:
        return jsonify({'success': False, 'message': 'File ID is missing'}), 400
    if not recipient_email:
        return jsonify({'success': False, 'message': 'Recipient email is missing'}), 400

    success = generate_token_for_file(file_id, recipient_email)
    if success:
        return jsonify({'success': True, 'message': 'Token generated successfully'})
    else:
        return jsonify({'success': False, 'message': 'Failed to generate token'}), 500

@upload_blueprint.route('/deleteFile', methods=['POST'])
def delete_file_route():
    data = request.get_json()
    file_id = data.get('fileId')
    delete_file_data(file_id)

    return jsonify({"message": "Files deleted successfully"}), 200

@upload_blueprint.route('/revokeToken', methods=['POST'])
def revoke_token_route():
    data = request.get_json()
    token = data.get('token')  # Extract fileId from JSON body

    if not token:
        print("token is None")
        return jsonify({'success': False, 'message': 'Token is missing'})

    success = revoke_token_for_file(token)
    return jsonify({'success': success})


@upload_blueprint.route('/profileUI')
def profileUI():
    # This route could render an HTML template for the profile page
    return render_template('endUserProfileUI.html')


@upload_blueprint.route('/getUserProfile', methods=['GET'])
def get_profile():
    user_id = session.get('user_id')
    print(user_id)
    if not user_id:
        return jsonify({'error': 'User not logged in'}), 401
    profile_data = get_user_profile(user_id)
    return jsonify(profile_data)


@upload_blueprint.route('/updateProfile', methods=['POST'])
def update_profile():
    if 'user_id' not in session:
        return jsonify({'error': 'User not logged in'}), 401
    user_data = request.json
    # Ensure userID is passed correctly
    user_data['userID'] = session['user_id']
    result = update_user_profile(user_data)
    return jsonify(result)
