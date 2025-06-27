<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'], $_POST['user_id'])) {
    $action = $_POST['action'];
    $userId = $_POST['user_id'];

    if ($action === 'disable') {
        // Perform logic to disable user (update database, etc.)
        $updateStatusQuery = "UPDATE users SET status = 'disabled' WHERE id = $userId";
        $resultUpdate = mysqli_query($conn, $updateStatusQuery);

        // Handle the result, perform error checking if needed

    } elseif ($action === 'enable') {
        // Perform logic to enable user (update database, etc.)
        $updateStatusQuery = "UPDATE users SET status = 'enabled' WHERE id = $userId";
        $resultUpdate = mysqli_query($conn, $updateStatusQuery);

        // Handle the result, perform error checking if needed
    }

    // Redirect to userlist.php
    header("Location: userlist.php");
    exit();
}
?>