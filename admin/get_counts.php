<?php
require_once "config.php";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentYear = date('Y');
$currentMonth = date('m');

$sql_incidents_new = "SELECT COUNT(*) AS item_count_new FROM incidents WHERE status LIKE '%New%' AND YEAR(date) = $currentYear";
$result_incidents_new = $conn->query($sql_incidents_new);

$sql_incidents_verified = "SELECT COUNT(*) AS item_count_verified FROM incidents WHERE status LIKE '%Verified%' AND YEAR(date) = $currentYear";
$result_incidents_verified = $conn->query($sql_incidents_verified);

$sql_incidents_resolved = "SELECT COUNT(*) AS item_count_resolved FROM incidents WHERE status LIKE '%Resolved%' AND YEAR(date) = $currentYear AND MONTH(date) = $currentMonth";
$result_incidents_resolved = $conn->query($sql_incidents_resolved);

if ($result_incidents_new && $result_incidents_verified && $result_incidents_resolved) {
    $row_incidents_new = $result_incidents_new->fetch_assoc();
    $count_incidents_new = $row_incidents_new['item_count_new'];

    $row_incidents_verified = $result_incidents_verified->fetch_assoc();
    $count_incidents_verified = $row_incidents_verified['item_count_verified'];

    $row_incidents_resolved = $result_incidents_resolved->fetch_assoc();
    $count_incidents_resolved = $row_incidents_resolved['item_count_resolved'];

    echo '<div class="numbersContainer">';
    echo '<label for="new">New Incident Report</label><br>';
    echo '<label for="verified">Resolved Incident Report</label><br>';
    echo '<label for="resolved" style="margin-top: -33px;">Verified Incident Report</label><br>';
    echo '<span for="new">' . $count_incidents_new . '</span>';
    echo '<span for="verified">' . $count_incidents_verified . '</span>';
    echo '<span for="resolved">' . $count_incidents_resolved . '</span>';
    echo '</div>';
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
