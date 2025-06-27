<?php
include('config.php');
// it should include in incidentreport.php and incidentlist.php
// make the registration.php as reference
// Check if the form was submitted
// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response_date = $_POST['response_date'];
    $departure = $_POST['departure'];

    // SQL query to insert data into the database, including the combined checkbox values
    $sql = "INSERT INTO spot_report_ar (response_date, departure)
            VALUES ('$response_date', '$departure')";

    if (mysqli_query($conn, $sql)) {
        // insertion successful
        header("Location: ar-report.php"); // Redirect to the incident list page
        exit();
    } else {
        // insertion failed
        echo "Error: " . mysqli_error($conn);
    }
}
?>  