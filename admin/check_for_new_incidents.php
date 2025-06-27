<?php
require_once "config.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to check if there are new incidents in the current year
$sql_check_new_incidents = "SELECT COUNT(*) AS new_incidents_count FROM incidents WHERE status LIKE '%New%' AND YEAR(date) = ?";
$stmt = $conn->prepare($sql_check_new_incidents);
$stmt->bind_param("s", date('Y'));

$result = $stmt->execute();

if ($result) {
    $stmt->bind_result($newIncidentsCount);
    $stmt->fetch();

    echo ($newIncidentsCount > 0) ? 'true' : 'false';
} else {
    echo 'false';
}

$stmt->close();
$conn->close();
?>