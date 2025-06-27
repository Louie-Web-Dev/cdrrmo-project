<?php
session_start(); // Start the session

// Check if the default entries value is not set in the session
if (!isset($_SESSION['entries_default'])) {
    // Set the default entries value in the session
    $_SESSION['entries_default'] = 50;
}

// Include your database connection file or establish a connection here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cdrrmo_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the number of entries to display
$entries = isset($_SESSION['entries']) ? $_SESSION['entries'] : $_SESSION['entries_default']; // Use session variable if available, otherwise default to session default

// Check if there is a search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Define columns to be excluded from the calculation
$excludedColumns = array('id', 'Incident_ID', 'status', 'action_taken_others', 'closed_by', 'others', 'resolution_remarks', 'resolution_remarks', 'other', 'vehicle_type', 'number_affected', 'age', 'contact');


// Perform a query to get the latest incidents in descending order of timestamp with a limit
$query = "SELECT *, CONCAT(date, ' ', time) AS datetime_combined FROM incidents WHERE status = 'Archived' AND (incident_type LIKE '%$searchQuery%' OR location LIKE '%$searchQuery%' OR Incident_ID LIKE '%$searchQuery%' OR date LIKE '%$searchQuery%') ORDER BY datetime_combined DESC LIMIT $entries";

$result = $conn->query($query);

$tableBody = '';
while ($row = $result->fetch_assoc()) {
    // Count the number of filled columns
    $filledColumns = 0;
    $totalColumns = count($row) - count($excludedColumns); // Exclude specified columns

    foreach ($row as $column => $value) {
        // Check if the current column should be excluded
        if (!in_array($column, $excludedColumns) && !empty($value)) {
            $filledColumns++;
        }
    }

    // Calculate the percentage
    $percentage = round(($filledColumns / $totalColumns) * 100, 2);

    // Build the table row
    $tableBody .= '<tr>';
    $tableBody .= '<td>' . $row['Incident_ID'] . '</td>';
    $tableBody .= '<td>' . $row['datetime_combined'] . '</td>';
    $tableBody .= '<td>' . $row['incident_type'] . '</td>';
    $tableBody .= '<td>' . $row['location'] . '</td>';
    $tableBody .= '<td class="status-cell" data-incident-id="' . $row['id'] . '">' . $row['status'] . ' (' . $percentage . '%)</td>';
    $tableBody .= '<td>';
    $tableBody .= '<button class="edit-report-button custom-edit-button" data-incident-id="' . $row['id'] . '" onclick="openEditReport(' . $row['id'] . ')">';
    $tableBody .= '<i class="fas fa-edit"></i>';
    $tableBody .= '</button>';
    $tableBody .= '<button class="inspect-button custom-inspect-button" data-incident-id="' . $row['id'] . '" onclick="openInspectModal(' . $row['id'] . ')">';
    $tableBody .= '<i class="fa-solid fa-file"></i>';
    $tableBody .= '</button>';
    $tableBody .= '<button id="status-button-' . $row['id'] . '" class="btn ' . ($row['status'] === 'Verified' ? 'btn-success' : 'btn-war') . '" onclick="changeStatusButton(' . $row['id'] . ', \'' . $row['status'] . '\')">';
    $tableBody .= $row['status'] === 'Verified' ? 'R' : '<i class="fa-solid fa-rotate-left" style="background-color: transparent; padding: 0;"></i>';
    $tableBody .= '</button>';
    $tableBody .= '</td>';
    $tableBody .= '</tr>';
}

echo $tableBody;

$conn->close();
?>