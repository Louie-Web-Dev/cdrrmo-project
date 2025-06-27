<?php
require_once "config.php";

// List of locations to check
$locations = [
    'Barangay I',
    'Barangay II',
    'Barangay III',
    'Barangay IV',
    'San Agustin',
    'San Antonio',
    'San Bartolome',
    'San Felix',
    'San Fernando',
    'San Francisco',
    'San Isidro Norte',
    'San Isidro Sur',
    'San Joaquin',
    'San Jose',
    'San Juan',
    'San Luis',
    'San Miguel',
    'San Pablo',
    'San Pedro',
    'San Rafael',
    'San Roque',
    'San Vicente',
    'Santa Ana',
    'Santa Anastacia',
    'Santa Clara',
    'Santa Cruz',
    'Santa Elena',
    'Santa Maria',
    'Santa Teresita',
    'Santiago'
];

// Initialize the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an array to store incident counts
$incidentCounts = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected year and month from the form
    $selectedYear = $_POST["years"];
    $selectedMonth = $_POST["month"];

    // Fetch incident counts from the database for each location for the selected year and month
    foreach ($locations as $location) {
        $sql = "SELECT COUNT(*) as count FROM incidents WHERE location = '$location' AND YEAR(date) = $selectedYear AND MONTH(date) = $selectedMonth";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $incidentCounts[$location] = $row['count'];
        } else {
            $incidentCounts[$location] = 0;
        }
    }
} else {
    // Get the current year and month if the form is not submitted
    $selectedYear = date('Y');
    $selectedMonth = date('m');

    // Fetch incident counts from the database for each location for the current year and month
    foreach ($locations as $location) {
        $sql = "SELECT COUNT(*) as count FROM incidents WHERE location = '$location' AND YEAR(date) = $selectedYear AND MONTH(date) = $selectedMonth";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $incidentCounts[$location] = $row['count'];
        } else { 
            $incidentCounts[$location] = 0;
        }
    }
}

// Close the database connection
$conn->close();

// Return the incident counts as JSON
echo json_encode($incidentCounts);
?>
