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
    //$verification_remarks = $_POST['verification_remarks'];
    //$resolution_remarks = $_POST['resolution_remarks'];
    $action_taken_others = $_POST['action_taken_others'];




    $verification_remarks = isset($_POST['verification_remarks']) ? mysqli_real_escape_string($conn, $_POST['verification_remarks']) : 'NULL';
    $resolution_remarks = isset($_POST['resolution_remarks']) ? mysqli_real_escape_string($conn, $_POST['resolution_remarks']) : 'NULL';
    $caller_middle_initial = isset($_POST['caller_middle_initial']) ? mysqli_real_escape_string($conn, $_POST['caller_middle_initial']) : 'NULL';
   
    $vehicle_involved = isset($_POST['vehicle_involved']) ? mysqli_real_escape_string($conn, $_POST['vehicle_involved']) : 'NULL';
    $individuals_affected = isset($_POST['individuals_affected']) ? mysqli_real_escape_string($conn, $_POST['individuals_affected']) : 'NULL';
    $closed_by = isset($_POST['closed_by']) ? mysqli_real_escape_string($conn, $_POST['closed_by']) : 'NULL';
    $verified_by = isset($_POST['verified_by']) ? mysqli_real_escape_string($conn, $_POST['verified_by']) : 'NULL';
    $action_taken = isset($_POST['action_taken']) ? mysqli_real_escape_string($conn, $_POST['action_taken']) : 'NULL';






    $update_sql = "UPDATE incidents SET date = '$date', time = '$time', Incident_ID = '$Incident_ID', source = '$source', caller_last_name = '$caller_last_name', caller_first_name = '$caller_first_name', caller_middle_initial = '$caller_middle_initial', caller_address = '$caller_address', contact = '$contact', age = '$age', location ='$location', specific_location = '$specific_location', additional_details = '$additional_details', vehicle_involved = '$vehicle_involved', individuals_affected = '$individuals_affected', vehicle_type = '$vehicle_type', number_affected = '$number_affected', closed_by = '$closed_by', verified_by = '$verified_by', action_taken = '$action_taken', action_taken_others = '$action_taken_others' WHERE id = $incidents_id";



    //verification_remarks = '$verification_remarks', //resolution_remarks = '$resolution_remarks', 


    
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
    <?php include 'nav-header.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Incident Details</title>
    
    <!--<link rel="stylesheet" href="styles.css">-->
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
                <img src=".\Image\logo.jpg" alt="" style="height: 75px; width: 75px; background-color: transparent; 
                position: absolute; left: 34%; top: 3%;">
                <img src=".\Image\aksyon.png" alt="" style="background-color: transparent; height: 75px;
                width: 150px; position: absolute; top: 2%; left: 59%;">
                <div class="text1">REPPUBLIC OF THE PHILIPPINES<br>PROVINCE OF BATANGAS</div>
                <div class="text2">CITY OF STO. TOMAS</div>
                <div class="text3">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
            </div>
    <div class="responseContainer">
            <form method="POST">
            <h1>Edit Incident Details</h1>
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

            <label for="location-input">Incident Location:</label>
            <input type="text" name="location" value="<?php echo $row['location']; ?>"><br>

            <label for="age-input">Incident Specific Location:</label>
            <input type="text" name="specific_location" value="<?php echo $row['specific_location']; ?>"><br>

            <label for="age-input">Incident Type:</label>
            <input type="text" name="incident_type" value="<?php echo $row['incident_type']; ?>"><br>

            <label for="age-input">Additional Details:</label>
            <input type="text" name="additional_details" value="<?php echo $row['additional_details']; ?>"><br>

            <label for="age-input">Vehicle Involved:</label>
            <input type="text" name="vehicle_involved" value="<?php echo $row['vehicle_involved']; ?>"><br>

            <label for="age-input">Vehicle Type:</label>
            <input type="text" name="vehicle_type" value="<?php echo $row['vehicle_type']; ?>"><br>

            <label for="number_affected">Number of Affected Individuals:</label>
            <input type="text" name="number_affected" value="<?php echo $row['number_affected']; ?>"><br>

            <label for="age-input">Action Taken:</label>
            <input type="text" name="action_taken" value="<?php echo $row['action_taken']; ?>"><br>

            <label for="age-input">Action Taken If Others:</label>
            <input type="text" name="action_taken_others" value="<?php echo $row['action_taken_others']; ?>"><br>

            <label for="age-input">Verified/Encoded By:</label>
            <input type="text" name="verified_by" value="<?php echo $row['verified_by']; ?>"><br>





</div>
<button id="submitBtn" type="submit">Save Changes</button>
<button id="backBtn"><a href="incident-list.php">Back</a></button>
</form>
    </div>

    <style>
        body {
            background-color: #173381;
        }

        .dashboard-container {
            background-color: white;
            width: 82%;
            height: 95%;
            position: fixed;
            right: 10px;
            margin-top: 83px;
            border-radius: 15px;
            padding-bottom: 50px;
            overflow: scroll;
        }
        .dashboard-container::-webkit-scrollbar {
                  display: block;
                  width: 5px;
              }
  
              .dashboard-container::-webkit-scrollbar-thumb {
                  background: grey;
                  border-radius: 5px;
              }
  
              .dashboard-container::-webkit-scrollbar-track {
                  background: #173381;
              }

              .text1, .text2, .text3, .text4 {
              background-color: transparent;
              font-size: 13px;
              margin-left: 0;
              text-align: center;
              font-family: 'Mulish', sans-serif;
              font-weight: 600;
              margin-top: 30px;
          }
  
          .text2 {
              margin-top: 0;
          }
  
          .text3 {
              font-size: 20px;
          }
  
          .text4 {
              margin-top: 0;
              margin-top: 15px;
              font-size: 15px;
              font-weight: bolder;
          }

        .responseContainer {
            background: transparent;
            font-family: 'Mulish', sans-serif;
            margin-top: 10px;
            margin: 10px auto;
            width: 60%;
            height: fit-content;
            border: #173381 2px solid;
            border-radius: 15px;
            text-align: right;
            padding-bottom: 20px;
        }
        .responseContainer h1 {
            font-family: 'Mulish', sans-serif;
            font-weight: 600;
            text-align: center;
            background-color: #173381;
            width: 100%;
            color: white;
            font-size: 18px;
            border-top-right-radius: 15px;
            border-top-left-radius: 15px;
            padding: 9px;
            padding-left: 50px;
            margin: 0;
        }


        .dashboard-container input {
            width: 220px;
            height: 30px;
            margin-top: 10px;
            margin-left: 50px;
            margin-right: 22%;
            font-family: 'Mulish', sans-serif;
            border: 1px solid black;
            padding-left: 10px;
            border-radius: 7px;
        }

        .dashboard-container label {
            font-family: 'Mulish', sans-serif;
        }

        #backBtn {
            background-color: #173381;
            height: 30px;
            width: 5%;
            float: left;
            border-radius: 7px;
            margin-left: 50px;
        }

        #backBtn a {
            color: white;
            text-decoration: none;
            
        }

        #submitBtn {
            float: right;
            background-color: #173381;
            height: 30px;
            width: 5%;
            color: white;
            border-radius: 7px;
            margin-right: 50px;
        }

        @media screen and (max-width: 1950px) and (min-width: 1620px) {
            .dashboard-container {
                width: 85.4%;
            }
        }

        @media screen and (max-width: 1555px) and (min-width: 320px) {
            .dashboard-container {
                width: 98%;
            }

            .dashboard-container .header img {
                display: block;
            }
        }
    </style>
</body>
</html>