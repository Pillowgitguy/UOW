//JavaScript code is executed only when the DOM has fully loaded. 
document.addEventListener('DOMContentLoaded', () => {
    // Retrieves the item dropped in the drop-area
    const dropArea = document.getElementById('drop-area');

    // When mouse is dragging item over the drop-area space
    dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        // Style the box when item is dragged over
        dropArea.classList.add('drag-over');
    });

    // Reset the box's styling
    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('drag-over');
    });

    // When the item is being dropped
    dropArea.addEventListener('drop', (event) => {
        // Prevents the default behaviour of the browser when dropping the item, which opening the item
        event.preventDefault();
        // Reset the box's styling
        dropArea.classList.remove('drag-over');
        // retrieves the dropped files from the event.dataTransfer.files object
        const files = event.dataTransfer.files;
        // Check if there is at least one file and the min and total share are updated
        if (files.length > 0 && resultUpdated) {

            //appends the first file to it with the key 'file', and sends it to the '/upload' endpoint using the Fetch API
            const formData = new FormData();

            // Append each file with a unique key (e.g., 'file_0', 'file_1', etc.)
            for (let i = 0; i < files.length; i++) {
                formData.append('file', files[i]);
            }

            // Append the dropdown values to the FormData object
            formData.append('minshare', document.getElementById('minshare').value);
            formData.append('totalshare', document.getElementById('totalshare').value);
            formData.append('usertype', document.getElementById('usertype').value);
            if (document.getElementById('usertype').value == "tech"){
              formData.append('keysize', document.getElementById('keysize').value);
              formData.append('encryptiontype', document.getElementById('encryptiontype').value);
              formData.append('blockmode', document.getElementById('blockMode').value);
            }
            else{
              formData.append('keysize', document.getElementById('keysizeContainer').value);
              formData.append('encryptiontype', document.getElementById('encryptiontypeContainer').value);
              formData.append('blockmode', document.getElementById('blockmodeContainer').value);
            }
            formData.append('macmode', document.getElementById('macmode').value);
            formData.append('noncesize', document.getElementById('noncesize').value)
            fetch('/upload', {
                method: 'POST',
                body: formData
            })
                //response is processed as JSON, and a simple alert is shown with the server's response message
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.message) {
                        alert(data.message);
                    } else {
                        console.error('Invalid response from the server:', data);
                        alert('An error occurred during file upload.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during file upload.');
                });
        }
        else{
            alert('Please select all options before dropping files.');
        }
    });
});


// Add a flag to check if the result div has been updated
var resultUpdated = false;

// validation.js
function validateMinTotalShareValues(dropdown1Value, dropdown2Value) {
    // Your validation logic here
    if (dropdown2Value <= dropdown1Value) {
      return false
    } else {
      return true
    }
}

function validateEncryptionValues(userT, keyS, encryptionT, blockT, macT, nSize){
    if (userT == "non-tech"){               // When user select non-tech
        return true;
    } else if (encryptionT != "ChaCha"){       // When user select other than ChaCha
        var encryptionInputs = [keyS, encryptionT, blockT];
        for (var i = 0; i < encryptionInputs.length; i++) {
            if(encryptionInputs[i] === ""){
                return false;
            }
        }
        return true
    } else {                                // When user select ChaCha
        var encryptionInputs = [keyS, encryptionT, blockT, macT, nSize];
        for (var i = 0; i < encryptionInputs.length; i++) {
            if(encryptionInputs[i] === ""){
                return false;
            }
        }
        return true
    }
}


function displayResult(mShare, tShare, uType, kSize, eType, bMode, mMode, nSize) {
    var resultDiv = document.getElementById('result');
    if (eType == "ChaCha"){
        resultDiv.innerHTML = 'Submitted Values: <br>&emsp;Min share: ' + mShare + 
                            '<br>&emsp;Total share: ' + tShare + 
                            '<br>&emsp;Key size: ' +  kSize + 
                            '<br>&emsp;Encryption type: ' + eType +
                            '<br>&emsp;Block mode: ' + bMode +
                            '<br>&emsp;Mac mode: ' + mMode +
                            '<br>&emsp;Nonce size: ' + nSize + 
                            '<br><strong>Note: If file is bigger than 1024 bytes, the min share will be set as 5 and the selected total share will increase by 5<strong>';
    } else {
        // Display the submitted values in the result div
        resultDiv.innerHTML = 'Submitted Values: <br>&emsp;Min share: ' + mShare + 
                            '<br>&emsp;Total share: ' + tShare +
                            '<br>&emsp;User type: ' + uType +
                            '<br>&emsp;Encryption type: ' + eType +  
                            '<br>&emsp;Key size: ' +  kSize + 
                            '<br>&emsp;Block mode: ' + bMode + 
                            '<br><strong>Note: If file is bigger than 1024 bytes, the min share will be set as 5 and the selected total share will increase by 5<strong>';
    }
}
  
function submitForm() {
  var userType = document.getElementById('usertype').value;
      // Get the selected values
      var minShare = parseInt(document.getElementById('minshare').value);
      var totalShare = parseInt(document.getElementById('totalshare').value); 
      var keySize = parseInt(document.getElementById('keysize').value);
      var encryptionType = document.getElementById('encryptiontype').value;
      var blockMode = document.getElementById('blockMode').value;
      var macMode = document.getElementById('macmode').value;
      var noncesize = document.getElementById('noncesize').value;
  
    if (userType == "non-tech"){
        // Set the defualt setting for non-tech users
        document.getElementById('keysizeContainer').value = 256;
        document.getElementById('encryptiontypeContainer').value = "AES";
        document.getElementById('blockmodeContainer').value = "GCM";
        var encryptionType = document.getElementById('encryptiontypeContainer').value;
        var blockMode = document.getElementById('blockmodeContainer').value;
        var keySize = parseInt(document.getElementById('keysizeContainer').value);
    }

    // Check user input
    checkMTShare = validateMinTotalShareValues(minShare, totalShare);
    checkEncryption = validateEncryptionValues(userType, keySize, encryptionType, blockMode, macMode, noncesize);
    if (checkMTShare == false){
        alert('The min share must be smaller than the total shares. \nPlease select a valid value.');
    } else if (checkEncryption == false){
        alert("Please select all option for the encryption.");
    } else {
        displayResult(minShare, totalShare, userType, keySize, encryptionType, blockMode, macMode, noncesize);
        resultUpdated = true;
    }
}

function updateEncryptionOptions() {
    var keysizeSelect = document.getElementById("keysize");
    var encryptionTypeSelect = document.getElementById("encryptiontype");

    // Clear previous options
    encryptionTypeSelect.innerHTML = "";

    // Add options based on the selected key size
    if (keysizeSelect.value === "128") {
      var encryptionOptions = ["Select...", "AES", "IDEA", "CAST", "Camellia", "SM4"];
      for (var i = 0; i < encryptionOptions.length; i++) {
        var option = document.createElement("option");
        option.value = encryptionOptions[i];
        option.text = encryptionOptions[i];
        encryptionTypeSelect.appendChild(option);
      }
    } else if(keysizeSelect.value === "192") {
      var encryptionOptions = ["Select...", "AES", "Camellia"];
      for (var i = 0; i < encryptionOptions.length; i++) {
        var option = document.createElement("option");
        option.value = encryptionOptions[i];
        option.text = encryptionOptions[i];
        encryptionTypeSelect.appendChild(option);
      }
    } else {
        var encryptionOptions = ["Select...", "AES", "ChaCha", "Camellia" ];
        for (var i = 0; i < encryptionOptions.length; i++) {
          var option = document.createElement("option");
          option.value = encryptionOptions[i];
          option.text = encryptionOptions[i];
          encryptionTypeSelect.appendChild(option);
        }
    }
  }

function handleUserTypeChange() {
    var userTypeSelect = document.getElementById("usertype");
    var keysizeContainer = document.getElementById("keysizeContainer");
    var encryptiontypeContainer = document.getElementById("encryptiontypeContainer");
    var blockmodeContainer = document.getElementById("blockmodeContainer");
    var macmodeContainer = document.getElementById("macmodeContainer");

    // Show/hide based on user type
    if (userTypeSelect.value === "tech") {
      keysizeContainer.style.display = "block";
      encryptiontypeContainer.style.display = "block";
      blockmodeContainer.style.display = "block";

    } else {
      keysizeContainer.style.display = "none";
      encryptiontypeContainer.style.display = "none";
      blockmodeContainer.style.display = "none";
      macmodeContainer.style.display = "none";
    }
}

function handleEncryptionTypeChange() {
    var encryptionTypeSelect = document.getElementById("encryptiontype");
    var macmodeContainer = document.getElementById("macmodeContainer");
    var noncesizeContainer = document.getElementById("noncesizeContainer");
    var encryptionTypeSelect = document.getElementById('encryptiontype');
    var blockModeSelect = document.getElementById('blockMode');
    var selectedEncryptionType = encryptionTypeSelect.value;

    // Show/hide MAC mode based on encryption type
    if (selectedEncryptionType === "ChaCha") {
        macmodeContainer.style.display = "block";
        noncesizeContainer.style.display = "block";
    } else {
        macmodeContainer.style.display = "none";
        noncesizeContainer.style.display = "none";
    }

    // Clear existing options
    blockModeSelect.innerHTML = '';
    // Define block modes based on the selected encryption type
    var blockModes = [];

    switch (selectedEncryptionType) {
      case 'AES':
        blockModes = ['Select...', 'GCM', 'CTR', 'OFB', 'CBC'];
        break;
      case 'Camellia':
        blockModes = ['Select...', 'OFB', 'CFB', 'CBC'];
        break;
      case 'CAST':
        blockModes = ['Select...', 'CBC', 'CTR', 'OFB', 'CFB'];
        break;
      case 'IDEA':
        blockModes = ['Select...', 'CBC', 'OFB', 'CFB'];
        break;
      case 'SM4':
        blockModes = ['Select...', 'CFB', 'CTR', 'OFB', 'CBC'];
        break;
      case 'ChaCha':
        blockModes = ['NIL'];
        break;
      default:
        blockModes = [];
    }

    // Populate block modes dropdown
    for (var i = 0; i < blockModes.length; i++) {
      var option = document.createElement('option');
      option.value = blockModes[i];
      option.text = blockModes[i];
      blockModeSelect.add(option);
    }
}
handleEncryptionTypeChange()
// Reroute the user to DisplayUI.html button --> js --> CTL.py --> endUserDisplayUI.html
function redirectToDisplayUI() {
    window.location.href = "/display";
  }

function redirectToHome() {
// Use window.location.href to navigate to the home route
window.location.href = "/homePage";
}
