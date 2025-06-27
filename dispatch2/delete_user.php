<?php
require_once "database.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["user_id"])) {
    // Sanitize the user ID to prevent SQL injection
    $userId = mysqli_real_escape_string($conn, $_POST["user_id"]);

    // SQL to delete the user with the provided user ID
    $sql = "DELETE FROM users WHERE id = '$userId'";

    if (mysqli_query($conn, $sql)) {
        // Deletion was successful, redirect to userlist.php
        header("Location: userlist.php");
        exit();
    } else {
        // soon to be change
        // An error occurred during deletion, you may handle it accordingly
        header("Location: error.php");  // Redirect to an error page
        exit();
    }
    }

mysqli_close($conn);
?>