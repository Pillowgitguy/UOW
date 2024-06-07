document.getElementById("downloadBtn").addEventListener("click", function() {
    var token = document.getElementById("tokeninput").value;
    var password = document.getElementById("password").value;
    var passwordCheck = document.getElementById("passwordcheck").value;

    // Check if the passwords match
    if (password !== passwordCheck) {
        document.getElementById("message").innerHTML = "Passwords do not match";
        return;
    }

    // Perform password change or reset action here
    // You can make an AJAX request to your server to handle the password change/reset

    // Example AJAX request using fetch API
    fetch('/change_password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            token: token,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        // Handle response from server
        console.log(data);
        if (data.success) {
            alert("Password changed successfully");
        } else {
            alert("Token has either expired or does not exist, please reset your password again");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("message").innerHTML = "An error occurred while changing password";
    });
});
