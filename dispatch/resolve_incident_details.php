<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include('config.php');

// Check if incident ID is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$incidentId = $_GET['id'];

// Check if the request is an AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // AJAX request, proceed with resolution
    $resolutionSuccessful = performActualResolutionFunction($incidentId);

    // Check if the resolution was successful
    if ($resolutionSuccessful) {
        // Return a success response
        echo json_encode(['success' => true, 'message' => 'Incident resolved successfully.']);
    } else {
        // Return an error response if resolution fails
        echo json_encode(['success' => false, 'error' => 'Failed to resolve the incident.']);
    }

    mysqli_close($conn);
    exit();
}

// Fetch incident details
$sql = "SELECT * FROM incidents WHERE id = $incidentId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    // Incident not found
    echo json_encode(['success' => false, 'error' => 'Incident not found.']);
    mysqli_close($conn);
    exit();
}

// Define a function to perform the actual resolution
function performActualResolutionFunction($incidentId) {
    global $conn;

    // Sanitize and validate the input
    $incidentId = $conn->real_escape_string($incidentId);

    // Perform the status update in the database
    $updateStatusQuery = "UPDATE incidents SET status = 'Resolved' WHERE id = $incidentId";
    $resultUpdate = $conn->query($updateStatusQuery);

    return $resultUpdate;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="../admin\Image\sto_thomas.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Incident Details</title>
    <!--<link rel="stylesheet" href="styles.css">-->
</head>
<body>


    <div class="dashboard-container">
        <div class="header">
        <img src=".\Image\logo.jpg" alt="Sto. Thomas" class="logo">
        <img src=".\Image\aksyon.png" alt="Aksyon Bilis" class="logo">
        <div class="text1">Republic of the Philippines<br>Province of Batangas</div>
        <div class="text2">CITY OF STO. TOMAS</div>
        <div class="text3">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
        <div class="text4">FULL INCIDENT DETAILS REPORT</div>
        </div>

        <h2>Incident Details</h2>
        <label for="incident-id" style="margin-bottom: 5px;">Incident ID: <?php echo $row['Incident_ID']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Status: <?php echo $row['status']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Date Reported: <?php echo $row['date']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Time Reported: <?php echo $row['time']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Source: <?php echo $row['source']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Caller Full Name:<?php echo $row['caller_last_name']; ?>, <?php echo $row['caller_first_name']; ?> <?php echo $row['caller_middle_initial']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Caller Address: <?php echo $row['caller_address']; ?>, Sto. Tomas Batangas</label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Caller Age: <?php echo $row['age']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Incident Location: <?php echo $row['location']; ?>, Sto. Tomas Batangas</label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Specific Location: <?php echo $row['specific_location']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Additional Incident Details: <?php echo $row['additional_details']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Vehicle Type: <?php echo $row['vehicle_type']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Number of Affected Individuals:<?php echo $row['number_affected']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Action Taken: <?php echo ($row['action_taken'] === 'Both') ? 'Dispatch' : '';?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Other Action Taken: <?php echo $row['action_taken_others']; ?></label><br><br>

       <label for="incident-id" style="margin-bottom: 5px;">Verified By: <?php echo $row['verified_by']; ?></label><br><br>

       <h2>EMS Report Details</h2>

        <label for="incident-id" style="margin-bottom: 5px;">Departure from Base: <?php echo $row['departure']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Arrival at Destination: <?php echo $row['arrival']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Departure from Destination: <?php echo $row['dept']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Arrival at Base: <?php echo $row['base']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Incident Severity Level: <?php echo $row['level']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Contact Person: <?php echo $row['person']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Contact Number: <?php echo $row['co_number']; ?></label><br><br>

        <h3>VICTIM/PATIENT DETAILS</h3>
        <h4>Victim 1</h4>
        <label for="incident-id" style="margin-bottom: 5px;">Full Name: <?php echo $row['victim_ln']; ?>, <?php echo $row['victim_fn']; ?> <?php echo $row['victim_mi']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Age: <?php echo $row['victim_age']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Gender: <?php echo $row['victim_gender']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Address: <?php echo $row['victim_address']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Status: <?php echo $row['victim_status']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Personal Item/s Recovered on Site: <?php echo $row['victim_item']; ?></label><br><br>
        
        <label for="incident-id" style="margin-bottom: 5px;">Other Victims: <?php echo $row['othervictims1']; ?></label><br><br>

        <h4>Victim 2</h4>
        <label for="incident-id" style="margin-bottom: 5px;">Full Name: <?php echo $row['victim_ln2']; ?>, <?php echo $row['victim_fn2']; ?> <?php echo $row['victim_mi2']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Age: <?php echo $row['victim_age2']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Gender: <?php echo $row['victim_gender2']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Address: <?php echo $row['victim_address2']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Status: <?php echo $row['victim_status2']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Personal Item/s Recovered on Site: <?php echo $row['victim_item2']; ?></label><br><br>
        
        <label for="incident-id" style="margin-bottom: 5px;">Other Victims: <?php echo $row['othervictims2']; ?></label><br><br>

        <h3>VEHICLE AND DRIVER DETAILS</h3>

        <label for="incident-id" style="margin-bottom: 5px;">Owner Full Name: <?php echo $row['last']; ?>, <?php echo $row['first']; ?> <?php echo $row['middle']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Brand of Car: <?php echo $row['brand']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Vehicle Type: <?php echo $row['vehicle']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Driver`s Name: <?php echo $row['ln']; ?>, <?php echo $row['fn']; ?> <?php echo $row['mi']; ?></label><br><br>

        <h3>OPERATION DETAILS</h3>
        <label for="incident-id" style="margin-bottom: 5px;">Action Taken: <?php echo $row['severity']; ?></label><br><br>
        <label for="incident-id" style="margin-bottom: 5px;">
            Pre-Hospital Patient care Report:<br>
            <img src="../Patient_care_report/<?php echo $row['fileInput']; ?>" alt="Patient care Report" style="width: 300px; height: 150px;;">
        </label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">
            Image Incident:<br>
            <img src="../Incident_Image/<?php echo $row['fileInput2']; ?>" alt="Incident Image" style="width: 300px; height: 150px;;">
        </label><br><br>

        <h3>DISPATCH TEAM</h3>
        
        <label for="incident-id" style="margin-bottom: 5px;">Team Leader's Name: <?php echo $row['leader_fullname']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Driver's Name: <?php echo $row['driver_fullname']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">Nurse's Name: <?php echo $row['nurse_fullname']; ?></label><br><br>

        <label for="incident-id" style="margin-bottom: 5px;">EMT's Name: <?php echo $row['emt_fullname']; ?></label><br><br>
        
        <label for="incident-id" style="margin-bottom: 5px;">Other Dispatch: <?php echo $row['other_dispatch']; ?></label><br><br>



        <button id="printButton" class="fixedButton" onclick="window.print()">Print</button>
        <button id="backBtn"><a href="incident-list.php">Back to Incident List</a></button>
        <button id="actualResolveBtn">Resolve Incident</button>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
    $(document).ready(function () {
        $('#actualResolveBtn').on('click', function () {
            // Perform the actual resolution using AJAX
            $.ajax({
                type: 'POST',
                url: 'resolve_incident_details.php?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Successful resolution, you can show a success message or perform additional actions
                        console.log('Incident resolved successfully!');
                        // Redirect back to incident-list.php or any other page
                        window.location.href = 'incident-list.php';
                    } else {
                        // Handle error if resolution fails
                        console.error('Error: ' + response.error);
                        // Optionally, show an error message to the user
                    }
                },
                error: function () {
                    // Handle AJAX error
                    console.error('AJAX request failed.');
                }
            });
        });
    });
</script>
    </div>
    <style>
        body {
            background-color: #ECEBEF;

        .fixedButton {
            position: fixed;
            z-index: 999; /* Ensure the button is on top of other elements */
        }

        #printButton {
            bottom: 65px; /* Adjust the distance from the bottom as needed */
            right: 20px;
            padding: 10px 30px;
            border-radius: 10px;
            cursor: pointer; /* Adjust the distance from the right as needed */
        }
        }
        #backBtn{
            text-decoration: none;
            position: fixed;
            padding: 10px 30px;
            bottom: 20px;
            left: 20px;
            display: block;
            border-radius: 10px;
            cursor: pointer;
        }
        #actualResolveBtn {
            position: fixed;
            padding: 10px 30px;
            bottom: 20px;
            right: 20px;
            display: block;
            z-index: 999;
            border-radius: 10px;
            cursor: pointer;
        }
        .header{
                margin-left: -40px;
            }
        h2{
        ;
        }
        h1{
        ;
        }
        h3{
        ;
        }
        h4{
        ;
        }
        .dashboard-container {
            background-color: white;
            width: 46%;
            height: fit-content;
            margin-top: 50px;
            margin: auto;
            padding: 50px;
            text-align: justify;
            padding-bottom: 10px;
            border-radius: 7px;
        }

        .header img:nth-of-type(1) {
            height: 75px;
            width: 75px;
            margin-left: 60%;
            margin-top: 0px;
        }


        .header img:nth-of-type(2) {
            height: 75px;
            width: 150px;
            margin-left: 24%;
            margin-top: -80px;
            float: left;
    
        }
        .text1, .text2 {
            background-color: transparent;
            font-size: 13px;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 600;
            margin-top: -75px;

        }

        .text2 {
            margin-top: 0;
        }

        .text3 {
            font-size: 18px;
            background-color: transparent;
            text-align: center;
            font-weight: 800;
            margin-top: 33px;
        }

        .text4 {
            margin-top: 0px;
            font-size: 20px;
            background-color: transparent;
            text-align: center;
            font-weight: 800;   
        }


        @media print {
            body {
            background-color: #ECEBEF
            ;
        }
        h1{
            margin-top: 10px;
        }
            button {
        display: none;
    }
        #backBtn {
                display: none;
            }
            .header{
                margin-left: -50px;
            }
        .header img:nth-of-type(1) {
            height: 75px;
            width: 75px;
            margin-left: 62%;
            margin-top: 0px;
        }
        #actualResolveBtn{
            display: none;
        }


        .header img:nth-of-type(2) {
            height: 75px;
            width: 150px;
            margin-left: 22%;
            margin-top: -80px;
            float: left;
    
        }
        .dashboard-container {
            margin-top: -30px;
            background-color: white;
            width: 100%;
            height: fit-content;
            padding: 30px;
            text-align: justify;
            padding-bottom: 10px;
            border-radius: 7px;
        }
}




    </style>


</body>
</html>