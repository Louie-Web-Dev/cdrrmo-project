<?php
require_once "config.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$incidentTypes = ["Medical", "Trauma", "Extrication", "Cond-trans", "Stanby", "Pedestrian", "Missing-person", "Power-outage", "Self-accident", "Vehicular-accident", "Wound-care", "Crime", "Damaged-property", "Fire", "Telco-outage", "Flooding"];
$statuses = ["Verified", "Resolved", "Archived"];

$selectedMonth = date("n");
$selectedYear = date("Y");
$selectedLocation = isset($_POST['location']) ? $_POST['location'] : 'all';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedMonth = isset($_POST['months']) ? $_POST['months'] : date("n");
    $selectedYear = isset($_POST['year']) ? $_POST['year'] : date("Y");
}

echo '<table border="1">';
echo '<tr><th>Incident Type</th>';

foreach ($statuses as $status) {
    echo "<th>$status</th>";
}
echo '</tr>';

foreach ($incidentTypes as $incidentType) {
    echo "<tr><td>$incidentType</td>";

    foreach ($statuses as $status) {
        $escapedIncidentType = str_replace('-', '_', $incidentType);
        $sql = "SELECT COUNT(*) AS count FROM incidents WHERE incident_type LIKE '%$incidentType%' AND status = '$status'";

        if ($selectedLocation !== 'all') {
            $sql .= " AND location = '$selectedLocation'";
        }

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