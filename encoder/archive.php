<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$user_id = $_GET['id'];

// Function to escape special characters to prevent SQL injection
function escape($value) {
    global $conn;
    return mysqli_real_escape_string($conn, $value);
}

// Update the user status to "archived" in the database
$update_sql = "UPDATE users SET status = 'archived' WHERE id = " . escape($user_id);

if (mysqli_query($conn, $update_sql)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error archiving user: " . mysqli_error($conn);
}

mysqli_close($conn);
?>