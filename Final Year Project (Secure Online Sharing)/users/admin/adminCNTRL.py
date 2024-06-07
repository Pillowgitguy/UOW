from flask import Flask, render_template, request, jsonify, send_file, Blueprint, session, redirect, url_for
from .adminPage import fetch_users, update_user_role


admin_blueprint = Blueprint('admin', __name__, template_folder='admin_templates', static_folder='admin_static')

@admin_blueprint.route('/adminPage')
def admin_page():
    return render_template('adminPageUI.html')

@admin_blueprint.route('/users', methods=['GET'])
def get_users():
    users = fetch_users()
    return jsonify(users)

@admin_blueprint.route('/users/<int:user_id>/role', methods=['POST'])
def set_user_role(user_id):
    data = request.json
    new_role = data.get('role')
    update_user_role(user_id, new_role)
    return jsonify({"message": "User role updated successfully."})

if __name__ == '__main__':
    admin_blueprint.run(debug=True)
