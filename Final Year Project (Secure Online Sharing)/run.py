# run.py

# Use this if want test the upload
# from users.endUser.endUserUploadCTL import app

# Use this to test the login
from users.landingPage import app

if __name__ == '__main__':
    app.run(debug=True)
