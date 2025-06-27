<div class="table">
        <?php
        require_once "config.php";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
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
        $statuses = ["New", "Verified", "Resolved", "Archived"];

        $selectedMonth = date("n");
        $selectedYear = date("Y");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedMonth = isset($_POST['months']) ? $_POST['months'] : date("n");
            $selectedYear = isset($_POST['year']) ? $_POST['year'] : date("Y");
        }

       
echo '<table border="1">';
echo '<tr><th>Location</th>';

foreach ($statuses as $status) {
    echo "<th>$status</th>";
}

// Add a new column for Total
echo '<th>Total</th>';
echo '</tr>';

foreach ($locations as $location) {
    echo "<tr><td>$location</td>";

    // Initialize a variable to store the total count for the location
    $totalCount = 0;

    foreach ($statuses as $status) {
        $escapedLocation = str_replace('-', '_', $location);
        $sql = "SELECT COUNT(*) AS count FROM incidents WHERE location LIKE '%$escapedLocation%' AND status = '$status'";

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
        $count = $row['count'];
        
        // Output the count for each status
        echo '<td>' . $count . '</td>';

        // Accumulate the count to calculate the total
        $totalCount += $count;
    }

    // Output the total count for the location
    echo '<td>' . $totalCount . '</td>';

    echo '</tr>';
}

echo '</table>';

$conn->close();
?>