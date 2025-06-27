<?php
// Assuming you have a database connection
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['incident_id'])) {
        $incidentId = $_GET['incident_id'];

        // Fetch 'verified_by' from the database for the given incident_id
        $query = "SELECT verified_by FROM incidents WHERE incident_id = $incidentId";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $verifiedBy = $row['verified_by'];

            // Return 'verified_by' as a response
            echo $verifiedBy;
        } else {
            // Handle database query error
            http_response_code(500);
            echo "Failed to fetch 'verified_by'. Please try again.";
        }
    } else {
        // Handle missing incident_id parameter
        http_response_code(400);
        echo "Incident ID is missing.";
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo "Method Not Allowed";
}

// Close the database connection
mysqli_close($connection);
?>
