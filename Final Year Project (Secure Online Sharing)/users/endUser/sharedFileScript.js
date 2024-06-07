document.addEventListener('DOMContentLoaded', () => {
    const fileId = window.location.search.split('=')[1]; // Assuming file ID is passed as URL parameter
    fetchFileDetails(fileId);

    document.getElementById('generateToken').addEventListener('click', () => {
        generateToken(fileId);
    });
});

function fetchFileDetails(fileId) {
    fetch(`/getFileDetails?fileId=${fileId}`)
        .then(response => response.json())
        .then(data => {
            displayFileDetails(data);
        });
}

function displayFileDetails(fileDetails) {
    const detailsDiv = document.getElementById('fileDetails');
    detailsDiv.innerHTML = `FileName: ${fileDetails.fileName}<br>
                            Total Shares: ${fileDetails.totalShares}<br>
                            Min Shares: ${fileDetails.minShares}<br>
                            Available Tokens: ${fileDetails.tokens.join(', ')}`;
}

function generateToken(fileId) {
    fetch(`/generateToken?fileId=${fileId}`, { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Token generated successfully');
                fetchFileDetails(fileId);
            } else {
                alert('Error in token generation');
            }
        });
}
