function redirectToDisplayUI() {
    window.location.href = "/display";
  }

  function redirectToUploadfilesUI() {
    window.location.href = "/uploadUI";
  }

function redirectToHome() {
  // Use window.location.href to navigate to the home route
  window.location.href = "/homePage";
  }
    

  // JavaScript (you can include this in a <script> tag or an external JavaScript file)
document.getElementById('fileDropdown').addEventListener('change', function() {
  var selectedFileId = this.value; // Retrieve the selected file ID

  // You can use the selectedFileId as needed, for example, send it to the server or update other parts of the page.
  console.log('Selected File ID:', selectedFileId);
});
