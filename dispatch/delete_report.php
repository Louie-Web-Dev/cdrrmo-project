<?php
// Start a session and check if the user is logged in
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
include('config.php'); // Make sure this is the correct file for your database connection

if (isset($_POST['report_id'])) {
    $reportId = $_POST['report_id'];

    // SQL query to select the incident report by ID
    $selectQuery = "SELECT * FROM incidents WHERE id = $reportId";
    $result = mysqli_query($conn, $selectQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Extract data from the selected report
    $Incident_ID = $row['$Incident_ID'];
    $incident_type = $row['incident_type'];
    $status = $row['status'];
    $date = $row['date'];
    $time = $row['time'];
    $source = $row['source'];
    $caller_last_name = $row['caller_last_name'];
    $caller_first_name = $row['caller_first_name'];
    $caller_middle_initial = $row['caller_middle_initial'];
    $caller_address = $row['caller_address'];
    $contact = $row['contact'];
    $age = $row['age'];
    $location = $row['location'];
    $specific_location = $row['specific_location'];
    $additional_details = $row['additional_details'];
    $vehicle_type = $row['vehicle_type'];
    $number_affected = $row['number_affected'];
    $verification_remarks = $row['verification_remarks'];
    $resolution_remarks = $row['resolution_remarks'];
    $dispatch_date = $row['dispatch_date'];
    $dispatch_time = $row['dispatch_time'];
    $dispatch_driver = $row['dispatch_driver'];
    $dispatch_nurse = $row['dispatch_nurse'];
    $dispatch_emt = $row['dispatch_emt'];
    $actTaken = $row['actTaken'];
    $response=$row['response'];
    $departure=$row['departure'];
    $arrival=$row['arrival'];
    $dept=$row['dept'];
    $base=$row['base'];
    $level=$row['level'];
    $person=$row['person'];
    $co_number=$row['co_number'];
    $lastname=$row['lastname'];
    $firstname=$row['firstname'];
    $svl=$row['svl'];
    $gender=$row['gender'];
    $last=$row['last'];
    $first=$row['first'];
    $middle=$row['middle'];
    $brand=$row['brand'];
    $vehicle=$row['vehicle'];
    $others=$row['others'];
    $platenumber=$row['platenumber'];
    $drivername=$row['drivername'];
    $ln=$row['ln'];
    $fn=$row['fn'];
    $mi=$row['mi'];
    $severity=$row['severity'];
    $other=$row['other'];
    $atd=$row['atd'];   
    $yesorno=$row['yesorno'];
    $text=$row['text'];  
    $leadername=$row['leadername'];
    $individuals_affected=$row['individuals_affected'];
    $vehicle_involved=$row['vehicle_involved'];
    $additional_details=$row['additional_details'];


        // Specify the id explicitly in the INSERT query
        $insertQuery = "INSERT INTO resolved_incidents (id, status, date, time, source, caller_last_name, caller_first_name, caller_middle_initial, caller_address, contact, age, location, specific_location, incident_type, additional_details, vehicle_involved, individuals_affected, vehicle_type, number_affected, verification_remarks, resolution_remarks, dispatch_date, dispatch_time, dispatch_driver, dispatch_nurse, dispatch_emt, actTaken, response, departure, arrival, dept, base, level, person, 
        co_number, lastname, firstname, svl, gender, last, first, middle, brand, vehicle, others, platenumber, drivername, ln,
        fn, mi, severity, other, atd, yesorno, text, leadername, Incident_ID) 
                VALUES ($reportId, '$status', '$date', '$time', '$source', '$caller_last_name', '$caller_first_name', '$caller_middle_initial', '$caller_address', '$contact', '$age', '$location', '$specific_location', '$incident_type', '$additional_details', '$vehicle_involved', '$individuals_affected', '$vehicle_type', '$number_affected', '$verification_remarks', '$resolution_remarks', '$dispatch_date', '$dispatch_time', '$dispatch_driver', '$dispatch_nurse', '$dispatch_emt', '$actTaken', '$response','$departure','$arrival','$dept','$base','$level','$person','$co_number','$lastname', '$firstname','$svl','$gender', '$last', '$first', '$middle', '$brand', '$vehicle', '$others', '$platenumber', '$drivername', '$ln', '$fn', '$mi', '$severity', '$other', '$atd', '$yesorno', '$text', '$leadername', '$Incident_ID')";

        if (mysqli_query($conn, $insertQuery)) {
            // Successfully transferred the report to resolved_incidents
            // Now, you can delete the report from the incidents table
            $deleteQuery = "DELETE FROM incidents WHERE id = $reportId";
            if (mysqli_query($conn, $deleteQuery)) {
                // Report successfully removed from the incidents table
                header("Location: incident-list.php"); // Redirect to your page after successful removal
                exit();
            } else {
                echo "Error deleting report: " . mysqli_error($conn);
            }
        } else {
            echo "Error transferring report to resolved_incidents: " . mysqli_error($conn);
        }
    } else {
        echo "Report not found.";
    }
}
?>