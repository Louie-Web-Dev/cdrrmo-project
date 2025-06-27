// Add this function to your JavaScript code
function showPopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
}

// Add this function to your JavaScript code
function closePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}

// Modify the existing function to handle the form submission
function submitForm(event) {
    // Your AJAX logic to submit the form data to save.php
    // Handle the response to determine if the submission was successful

    // Example using fetch API
    fetch('save.php', {
        method: 'POST',
        body: new FormData(document.getElementById('myForm')),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Show the popup
            showPopup();
            console.log('Popup should be shown'); // Add this line
        } else {
            // Handle the error (e.g., display an error message)
            console.error(data.message);
        }
    })
    .catch(error => console.error(error));

    // Prevent the form from submitting through the regular form submission
    event.preventDefault();
}

// Add this function to your JavaScript code
function redirectToIncidentReport() {
    window.location.href = 'incident-report.php';
}
    