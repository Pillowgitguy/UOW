document.addEventListener('DOMContentLoaded', function() {
    fetchUserProfile();
});

function fetchUserProfile() {
    fetch(`/getUserProfile`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.Username) { // Check if Username exists in response
                document.getElementById('username').value = data.Username;
                document.getElementById('email').value = data.Email;
            } else {
                console.log("Username not found in response:", data);
            }
        })
        .catch((error) => {
            console.error('Fetch error:', error);
        });
}

document.getElementById('editProfileForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = {
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
    };
    console.log("Submitting profile update:", formData);
    fetch('/updateProfile', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
    })
    .then(response => response.json())
    .then(data => {
        console.log("Update response:", data);
        alert('Profile updated successfully!');
        fetchUserProfile(); // Refresh profile data
    })
    .catch((error) => {
        console.error('Update error:', error);
    });
});
