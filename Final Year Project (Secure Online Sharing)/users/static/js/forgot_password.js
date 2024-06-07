document.getElementById('downloadBtn').addEventListener('click', function() {
    // Clear any previous error message
    document.getElementById('message').innerText = '';

    var email = document.getElementById('emailInput').value;
    if (!email || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }
    fetch('/passwordReset', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Corrected: Only parse as JSON once
    })
    .then(data => {
        if(data.success) {
            alert('Password reset email sent, please check your email');
            // fetchFileDetails(fileId); // Ensure this function exists and works correctly
        } else {
            alert('Error in sending email: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
