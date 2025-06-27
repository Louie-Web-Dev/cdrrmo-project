<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['incident_id'])) {
    $incidentId = $_GET['incident_id'];

    $getStatusQuery = "SELECT status FROM incidents WHERE id = $incidentId";
    $result = $conn->query($getStatusQuery);

    if ($result) {
        $row = $result->fetch_assoc();
        echo $row['status'];
    } else {
        echo "Error fetching status";
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
