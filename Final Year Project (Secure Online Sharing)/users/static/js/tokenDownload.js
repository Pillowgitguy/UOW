document.getElementById('downloadBtn').addEventListener('click', function() {
    // Clear any previous error message
    document.getElementById('message').innerText = '';

    var token = document.getElementById('tokenInput').value;
    fetch('/downloadfile', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ token: token })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob(); // Handle the response as a Blob
    })
    .then(blob => {
        // Create a new URL for the blob
        const blobUrl = window.URL.createObjectURL(blob);

        // Create a temporary link element and trigger a download
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = 'downloaded_file.txt'; // Provide a file name here
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(blobUrl); // Clean up the URL
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('message').innerText = 'Invalid Token';
    });
});
