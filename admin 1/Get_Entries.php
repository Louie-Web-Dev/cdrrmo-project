<?php
// Assuming you store the entries value in a session variable
session_start();

if (isset($_GET['entries'])) {
    $entries = $_GET['entries'];

    // Set a default value if entries is empty or not a valid number
    $entries = ($entries === '' || !is_numeric($entries)) ? 50 : (int)$entries;

    // Store the entries value in a session variable
    $_SESSION['entries'] = $entries;

    // You can perform additional actions here if needed
} else {
    // Set the default entries value in case it is not provided
    $_SESSION['entries'] = 50;
}
?>