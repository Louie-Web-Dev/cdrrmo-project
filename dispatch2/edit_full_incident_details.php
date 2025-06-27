<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include('config.php');

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$incidents_id = $_GET['id'];

$sql = "SELECT * FROM incidents WHERE id = $incidents_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Incident not found.";
    mysqli_close($conn);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $Incident_ID = $_POST['Incident_ID'];
    $source = $_POST['source'];
    $caller_last_name = $_POST['caller_last_name'];
    $caller_first_name = $_POST['caller_first_name'];
    $caller_first_name = $_POST['caller_first_name'];
    $caller_first_name = $_POST['caller_first_name'];
    $caller_address = $_POST['caller_address'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $specific_location = $_POST['specific_location'];
    $additional_details = $_POST['additional_details'];
    $vehicle_type = $_POST['vehicle_type'];
    $number_affected = $_POST['number_affected'];
    $verification_remarks = $_POST['verification_remarks'];
    $resolution_remarks = $_POST['resolution_remarks'];
    $action_taken_others = $_POST['action_taken_others'];


    $update_sql = "UPDATE incidents SET date = '$date', time = '$time', Incident_ID = '$Incident_ID', source = '$source', caller_last_name = '$caller_last_name', caller_first_name = '$caller_first_name', caller_middle_initial = '$caller_middle_initial', caller_address = '$caller_address', contact = '$contact', age = '$age', location ='$location', specific_location = '$specific_location', selectedValuesStr = '$selectedValuesStr', additional_details = '$additional_details', vehicle_involved = '$vehicle_involved', individuals_affected = '$individuals_affected', vehicle_type = '$vehicle_type', number_affected = '$number_affected', verification_remarks = '$verification_remarks', resolution_remarks = '$resolution_remarks', closed_by = '$closed_by', verified_by = '$verified_by', action_taken = '$action_taken', action_taken_others = '$action_taken_others' WHERE id = $incidents_id";





    
    if (mysqli_query($conn, $update_sql)) {
        header("Location: incident-list.php");
        exit();
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="../admin\Image\sto_thomas.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Incident Details</title>
    <!--<link rel="stylesheet" href="styles.css">-->
</head>
<body>
    <div class="dashboard-container">
        <h1>Edit Incident Details</h1>
        <form method="POST">

<label for="incident-id">Incident ID:</label>
<input type="text" id="Incident_ID" name="Incident_ID" value="<?php echo $row['Incident_ID']; ?>"><br>

<label for="full_name">Date of Incident:</label>
<input type="date" id="date" name="date" value="<?php echo $row['date']; ?>"><br>

<label for="email">Time Reported:</label>
<input type="time" id="time" name="time" step="1" value="<?php echo $row['time']; ?>"><br>

<label for="source">Source:</label>
<input type="text" id="source" name="source" value="<?php echo $row['source']; ?>"><br>

<label for="surname_input">Caller Last Name:</label>
<input type="text" name="caller_last_name" value="<?php echo $row['caller_last_name']; ?>"><br>

<label for="fn-input">Caller First Name:</label>
<input type="text" name="caller_first_name" value="<?php echo $row['caller_first_name']; ?>"><br>

<label for="mi-input">Caller Middle Initial:</label>
<input type="text" name="caller_middle_initial" value="<?php echo $row['caller_middle_initial']; ?>"><br>

<label for="address-input">Caller Address:</label>
<input type="text" name="caller_address" value="<?php echo $row['caller_address']; ?>"><br>

<label for="contact-input">Caller Contact:</label>
<input type="text" name="contact" value="<?php echo $row['contact']; ?>"><br>

<label for="age-input">Caller Age:</label>
<input type="text" name="age" value="<?php echo $row['age']; ?>"><br>

<label for="location-input">Caller Location:</label>
<input type="text" name="location" value="<?php echo $row['location']; ?>"><br>

<label for="age-input">Caller Specific Location:</label>
<input type="text" name="specific_location" value="<?php echo $row['specific_location']; ?>"><br>

<label for="age-input">Additional Details:</label>
<input type="text" name="additional_details" value="<?php echo $row['additional_details']; ?>"><br>

<label for="age-input">Vehicle Type:</label>
<input type="text" name="vehicle_type" value="<?php echo $row['vehicle_type']; ?>"><br>

<label for="number_affected">Number of Affected Individuals:</label>
<input type="text" name="number_affected" value="<?php echo $row['number_affected']; ?>"><br>

<label for="age-input">Action Taken:</label>
<input type="text" name="action_taken" value="<?php echo $row['action_taken']; ?>"><br>

<label for="age-input">Action Taken If Others:</label>
<input type="text" name="action_taken_others" value="<?php echo $row['action_taken_others']; ?>"><br>

<label for="age-input">Verified By:</label>
<input type="text" name="verified_by" value="<?php echo $row['verified_by']; ?>"><br>







            <button id="submitBtn" type="submit">Save Changes</button>
        </form>

        <button id="backBtn"><a href="incident-list.php">Back to Incident</a></button>
    </div>

    <style>
        body {
            background-color: #f9f9f9;
        }

        .dashboard-container {
            background-color: white;
            width: 50%;
            height: fit-content;
            margin: 7% auto;
            padding-bottom: 10px;
            text-align: right;
            border-radius: 7px;
        }

        h1 {
            text-align: center;
            padding-top: 20px;
            font-family: 'Mulish', sans-serif;
        }

        .dashboard-container input {
            width: 220px;
            height: 30px;
            margin-top: 10px;
            margin-left: 50px;
            margin-right: 29%;
            font-family: 'Mulish', sans-serif;
            border: 1px solid black;
        }

        .dashboard-container label {
            font-family: 'Mulish', sans-serif;
        }

        #backBtn {
            background-color: #173381;
            height: 30px;
            width: 15%;
            float: left;
            border-radius: 7px;
            margin-top: -25px;
        }

        #backBtn a {
            color: white;
            text-decoration: none;
        }

        #submitBtn {
            background-color: #173381;
            height: 30px;
            width: 15%;
            color: white;
            border-radius: 7px;
        }
    </style>
</body>
</html>