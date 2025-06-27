<?php
// Assuming you have a database connection
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['incident_id']) && isset($_POST['verified_by'])) {
        $incidentId = $_POST['incident_id'];
        $verifiedBy = $_POST['verified_by'];

        // Update 'accepted_by' in the database for the given incident_id
        $query = "UPDATE incidents SET accepted_by = '$verifiedBy' WHERE incident_id = $incidentId";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Return a success response
            echo "Accepted by updated successfully.";
        } else {
            // Handle database query error
            http_response_code(500);
            echo "Failed to update 'accepted_by'. Please try again.";
        }
    } else {
        // Handle missing parameters
        http_response_code(400);
        echo "Incident ID or Verified By is missing.";
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo "Method Not Allowed";
}

// Close the database connection
mysqli_close($connection);
?>
