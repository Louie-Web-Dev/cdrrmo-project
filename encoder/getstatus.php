<?php
include('config.php');

// Retrieve the incident ID from the GET parameters
$incidentId = $_GET['id'];

// Query the database to get the latest status
$query = "SELECT status FROM incidents WHERE id = $incidentId";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];

    // Return the status as JSON
    echo json_encode(['id' => $incidentId, 'status' => $status]);
} else {
    // Handle the error
    echo json_encode(['error' => 'Failed to retrieve status']);
}

// Close the database connection
mysqli_close($conn);
?>
