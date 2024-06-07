const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

document.addEventListener("DOMContentLoaded", function () {
    const registrationForm = document.getElementById("registrationForm");

    registrationForm.onsubmit = async (e) => {
      e.preventDefault();
      const email = document.getElementById("signup_email").value;
      const username = document.getElementById("signup_username").value;
      const password = document.getElementById("signup_password").value;

      const response = await fetch("/register", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, username, password }),
      });

      const result = await response.json();
      alert(result.message);
    };
  });

  document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const logoutButton = document.getElementById("logoutButton");

    loginForm.onsubmit = async (e) => {
        e.preventDefault();
        const email = document.getElementById("signin_email").value;
        const password = document.getElementById("signin_password").value;
        const formData = { email, password };
    
        fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                if (data.lastLog == false) {
                    alert("Please scan the QR below using a 2FA app to set up your 2FA");
                    var qrCodeImage = document.getElementById("QR CODE");
                    qrCodeImage.src = "static/img/totp.png";
                } else {
                    var userInput = prompt("Please enter the 2FA:");
                    // Validate OTP and proceed with login only if OTP is valid
                    validateOTP(data.role, userInput, email)
                    .then(isValid => {
                        if (isValid) {
                            handleLoginSuccess(data.role);
                        } else {
                            alert('Invalid OTP. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error validating OTP:', error.message);
                        alert('Error validating OTP. Please try again.');
                    });
                }
            } else {
                // Handle other unsuccessful login attempts
                if (data.message === 'Invalid credentials') {
                    // Alert the user that the credentials are invalid
                    alert('Invalid email or password. Please try again.');
                } else {
                    // Handle other types of failures
                    document.getElementById('message').innerText = data.message;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    };

    logoutButton.onclick = async () => {
        const response = await fetch('/logout');
        const result = await response.json();
        alert(result.message);
    };
});


function validateSignUpForm() {
    const name = getValue("signup_username");
    const email = getValue("signup_email");
    const password = getValue("signup_password");
    const confirmPassword = getValue("signupConfirmPassword");
    const errorSpan = document.getElementById("signupError");

    // Basic validation
    if (isEmpty([name, email, password, confirmPassword])) {
        showError(errorSpan, "All fields are required");
        return false;
    }

    if (password !== confirmPassword) {
        showError(errorSpan, "Passwords do not match");
        return false;
    }

    clearError(errorSpan);
    return true;
}

function validateSignInForm() {
    const email = getValue("signin_email");
    const password = getValue("signin_password");
    const errorSpan = document.getElementById("signInError");

    if (isEmpty([email, password])) {
        showError(errorSpan, "Email and password are required");
        return false;
    }

    clearError(errorSpan);
    return true;
}

function getValue(elementId) {
    const element = document.getElementById(elementId);
    return element ? element.value.trim() : '';
}

function isEmpty(values) {
    return values.some(value => value === "");
}

function showError(errorElement, message) {
    if (errorElement) {
        errorElement.textContent = message;
    }
}

function clearError(errorElement) {
    if (errorElement) {
        errorElement.textContent = "";
    }
}

const logoutBtn = document.querySelector(".logout-btn")

logoutBtn.addEventListener("click",()=>{
    window.location.replace("login.html")
})

function clearLoginFormFields() {
    document.getElementById("email").value = "";
    document.getElementById("password").value = "";
}

function validateOTP(role, otp, email) {
    // Prepare data to send to the server
    const formData = { role, otp, email };
    // Send a POST request to the server for OTP validation
    return fetch('/validate-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(data => {
        if (data.status === 200) {
            // Return true if OTP is valid
            return true;
        } else {
            // Throw an error if OTP is invalid
            throw new Error('Invalid OTP');
        }
    })
    .catch(error => {
        console.error('Error validating OTP:', error.message);
        return false; // Return false if there's an error or OTP is invalid
    });
}

function handleLoginSuccess(role) {
    if (role === 'endUser') {
        window.location.href = '/homePage';
    } else if (role === 'admin') {
        window.location.href = 'admin/adminPage';
    } else if (role === 'suspended') {
        alert('Account Suspended. Please contact support.');
    }
}