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

$sql = "SELECT * FROM incidents WHERE status IN ('New', 'Verified') ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="notification-item">';
        echo '<div class="detail-label">Incident NO: ' . $row['Incident_ID'] . '</div>';
        echo '<div class="detail-label">Status: ' . $row['status'] . '</div>';
        echo '<div class="detail-label">Incident Type: ' . $row['incident_type'] . '</div>';
        echo '</div>';
    }
} else {
    echo 'No new notifications.';
}

$conn->close();
?>
