<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cdrrmo_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the current maximum Incident ID
$sql_get_max_incident_id = "SELECT MAX(id) AS max_id FROM incidents";
$result_get_max_incident_id = $conn->query($sql_get_max_incident_id);

if ($result_get_max_incident_id->num_rows > 0) {
    $row = $result_get_max_incident_id->fetch_assoc();

    // Check if "max_id" key exists in the array
    $max_id = isset($row['max_id']) ? $row['max_id'] : 0;

    // Calculate the next incident ID
    $next_incident_id = $max_id + 1;

    // Display the next Incident ID without the additional information
    $formatted_date = date('Ymd');
    $incident_id = $formatted_date . '-' . str_pad($next_incident_id, 3, '0', STR_PAD_LEFT);

    echo $incident_id;
} else {
    echo 'Error: Unable to retrieve the next Incident ID';
}

$result_get_max_incident_id->free_result();
$conn->close();
?>
