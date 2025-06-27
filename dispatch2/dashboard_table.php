<?php
$selectedMonth = isset($_POST['months']) ? $_POST['months'] : date("n");
$selectedYear = isset($_POST['year']) ? $_POST['year'] : "all";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cdrrmo_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define incident types
$incidentTypes = ["Medical", "Trauma", "Extrication", "Cond-trans", "Stanby", "Pedestrian", "Missing-person", "Power-outage", "Self-accident", "Vehicular-accident", "Wound-care", "Crime", "Damaged-property", "Fire", "Telco-outage", "Flooding"];

// Define statuses
$statuses = ["Archived", "Verified", "Resolved"];

echo '<table border="1">';
echo '<tr><th>Incident Type</th>'; // Empty cell for the top-left corner

// Display statuses in the first row
foreach ($statuses as $status) {
    echo "<th>$status</th>";
}
echo '</tr>';

// Display incident types and counts
foreach ($incidentTypes as $incidentType) {
    echo "<tr><td>$incidentType</td>";

    foreach ($statuses as $status) {
        $escapedIncidentType = str_replace('-', '_', $incidentType); // Replace hyphen with underscore
        $sql = "SELECT COUNT(*) AS count FROM incidents WHERE incident_type LIKE '%$incidentType%' AND status = '$status'";

        // Add filters for selected month and year
        if (!empty($selectedMonth) && $selectedMonth != 'all') {
            $sql .= " AND MONTH(date) = " . intval($selectedMonth);
        }
        if ($selectedYear !== 'all') {
            $sql .= " AND YEAR(date) = $selectedYear";
        }

        $result = $conn->query($sql);
        if ($result === false) {
            die("Error in SQL query: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        echo '<td>' . $row['count'] . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
