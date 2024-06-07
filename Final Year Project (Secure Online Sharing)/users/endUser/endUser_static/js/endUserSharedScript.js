document.addEventListener('DOMContentLoaded', () => {
    // Get the file ID from the URL path
    const pathSegments = window.location.pathname.split('/');
    const fileId = pathSegments[pathSegments.length - 1];

    if (fileId) {
        // Fetch and display file details
        fetchFileDetails(fileId);

        // Event listener for generating a new token
        document.getElementById('generateToken').addEventListener('click', () => {
            generateToken(fileId);
        });

        // Attach event listener to the "Delete File" button
        const deleteButton = document.getElementById('deleteFile');
        if (deleteButton) {
            deleteButton.addEventListener('click', () => {
                deleteFile(fileId);
            });
        } else {
            console.error('Delete button not found');
        }
    } else {
        console.error('No file ID found in URL');
    }
});

function fetchFileDetails(fileId) {
    fetch(`/getFileDetails?fileId=${fileId}`)
        .then(response => response.json())
        .then(data => {
            displayFileDetails(data);
            console.log(data);
        })
        .catch(error => console.error('Error fetching file details:', error));
}

function displayFileDetails(fileDetails) {
    const detailsDiv = document.getElementById('fileDetails');

    let htmlContent = '<div class="ts-file-details-table"><table>';
    htmlContent += `<tr><th>File Name</th><td>${fileDetails.FileName}</td></tr>`;
    htmlContent += `<tr><th>Total Shares</th><td>${fileDetails.totalShares}</td></tr>`;
    htmlContent += `<tr><th>Min Shares</th><td>${fileDetails.minShares}</td></tr>`;
    htmlContent += `<tr><th>Available Tokens</th><td>`;

    if (fileDetails.Tokens && fileDetails.Tokens.length > 0) {
        // Start a new table for the tokens
        htmlContent += `<table><tr><th>Token</th><th>Recipient</th><th>Expiry Date</th></tr>`;

        fileDetails.Tokens.forEach(({ Token, Receipient, TokenExpiry }) => {
            const expiryDate = new Date(TokenExpiry).toLocaleDateString("en-US");
            htmlContent += `<tr>
                                <td>${Token}</td>
                                <td>${Receipient}</td>
                                <td>${expiryDate}</td>
                                <td><button onclick="revokeToken('${Token}', '${fileDetails.FileID}')" class="ts-button">Revoke</button></td>
                            </tr>`;
        });

        // Close the tokens table
        htmlContent += `</table>`;
    } else {
        htmlContent += 'No tokens available';
    }

    htmlContent += '</td></tr></table></div>'; // Close the main table

    detailsDiv.innerHTML = htmlContent;
}




function generateToken(fileId) {
    const recipientEmail = document.getElementById('receipient_mail').value;
    if (!recipientEmail || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(recipientEmail)) {
        alert('Please enter a valid email address.');
        return;
    }

    fetch('/generateToken', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ fileId: fileId, recipientEmail: recipientEmail })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Corrected: Only parse as JSON once
    })
    .then(data => {
        if(data.success) {
            alert('Token generated successfully');
            window.location.reload();
            // fetchFileDetails(fileId); // Ensure this function exists and works correctly
        } else {
            alert('Error in token generation: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function revokeToken(token) {
    fetch('/revokeToken', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ token: token })
      })
        .then(response => {
          if (response.status === 200) {
            // Token revoked successfully
            alert('Token revoked successfully');
            window.location.reload();
          } else if (response.status === 404) {
            // Token not found
            alert('Token not found');
          } else {
            console.log('Error:', response.statusText);
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
}

function redirectToHome() {
    window.location.href = "/homePage";
    }

function deleteFile(fileId) {
    fetch('/deleteFile', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ fileId: fileId }),
    })
    .then(response => {
        if (response.status === 200) {
            response.json().then(data => {
                console.log(data);
                alert('File deleted successfully');
                window.location.href = "/uploadUI"; // Redirect user
            });
        } else {
            response.json().then(data => {
                console.error('Error:', data.message);
                alert('Error: ' + data.message); // Show error message to the user
            });
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

