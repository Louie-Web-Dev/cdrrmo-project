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

$sql = "SELECT * FROM incidents WHERE status IN ('New', 'Verified')";
$result = $conn->query($sql);

echo '<span id="noti_number" style="color: #EE4B2B; font-weight: bold;">' . $result->num_rows . '</span>';
$conn->close();
?>