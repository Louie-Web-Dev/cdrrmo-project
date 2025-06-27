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
    $report_text = $_POST['report_text'];
    $text_action_dispatch = $_POST['text_action_dispatch'];
    $text_action_arrive = $_POST['text_action_arrive'];
    $text_victim_details = $_POST['text_victim_details'];
    $team_arrived_base = $_POST['team_arrived_base'];
    $team_departed_scene = $_POST['team_departed_scene'];
    $victim_details = $_POST['victim_details'];
    $prepared_by = $_POST['prepared_by'];
    $position = $_POST['position'];
    $encoded_by = $_POST['encoded_by'];
    $encoder_position = $_POST['encoder_position'];
    $noted_by = $_POST['noted_by'];
    $position_noted = $_POST['position_noted'];





    $update_sql = "UPDATE incidents SET report_text = '$report_text', text_action_dispatch = '$text_action_dispatch',
    text_action_arrive = '$text_action_arrive',
    text_victim_details = '$text_victim_details',
    team_departed_scene = '$team_departed_scene',
    team_arrived_base  = '$team_arrived_base',
    victim_details = '$victim_details',
    prepared_by = '$prepared_by',
    position = '$position',
    encoded_by = '$encoded_by',
    encoder_position = '$encoder_position',
    noted_by = '$noted_by',
    position_noted = '$position_noted'
    WHERE id = $incidents_id";



    
    if (mysqli_query($conn, $update_sql)) {
        header("Location: resolved_incident.php");
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
    <?php include 'nav-header.php'; ?>
    <title>EMS Summary Report</title>
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
        <h1> EMS Summary Report</h1>
        <div class="first">
        <div class="incidentID">
        <label for="incident-id">Incident ID: &nbsp;&nbsp;&nbsp;<span style="margin-left: 50px"><?php echo $row['Incident_ID']; ?></span></label><br>
        </div>
        <label for="incident-id">Time Reported: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['time']; ?></label><br>
        <label for="incident-id">Departure from Base: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['departure']; ?></label><br>
        <label for="incident-id">Arrival at Destination: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['arrival']; ?></label><br>
        <label for="incident-id">Departure from Destination: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['dept']; ?></label><br>
        <label for="incident-id">Arrival at Base: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['base']; ?></label><br>
        </div>

        <div class="second">
            <label for="report-text">Time Reported:</label>
            <textarea class="text-input" id="report_text" name="report_text"><?php echo $row['report_text']; ?></textarea><br>

            <label for="report-text">Team Dispatched:</label>
            <textarea class="text-input" id="text_action_dispatch" name="text_action_dispatch"><?php echo $row['text_action_dispatch']; ?></textarea><br>

            <label for="report-text">Team Arrived:</label>
            <textarea class="text-input" id="text_action_arrive" name="text_action_arrive"><?php echo $row['text_action_arrive']; ?></textarea><br>

            <label for="report-text">Victim Status Details:</label>
            <textarea class="text-input" id="text_victim_details" name="text_victim_details"><?php echo $row['text_victim_details']; ?></textarea><br>

            <label for="report-text">Team Departed at the Scene:</label>
            <textarea class="text-input" id="team_departed_scene" name="team_departed_scene"><?php echo $row['team_departed_scene']; ?></textarea><br>

            <label for="report-text">Team Arrived on Base:</label>
            <textarea class="text-input" id="team_arrived_base" name="team_arrived_base"><?php echo $row['team_arrived_base']; ?></textarea><br>

            <label for="report-text">Victim Details:</label>
            <textarea class="text-input" id="victim_details" name="victim_details"><?php echo $row['victim_details']; ?></textarea><br>
        </div>


        <div class="third">
            <label for="report-text">Prepare By:</label>
            <input type="text" id="prepared_by" name="prepared_by" value="<?php echo $row['prepared_by']; ?>"><br>

            <label for="report-text">Position:</label>
            <input type="text" id="position" name="position" value="<?php echo $row['position']; ?>"><br>

            <label for="report-text">Encode By:</label>
            <input type="text" id="encoded_by" name="encoded_by" value="<?php echo $row['encoded_by']; ?>"><br>

            <label for="report-text">Position:</label>
            <input type="text" id="encoder_position" name="encoder_position" value="<?php echo $row['encoder_position']; ?>"><br>

            <label for="report-text">Noted By:</label>
            <input type="text" id="noted_by" name="noted_by" value="<?php echo $row['noted_by']; ?>"><br>

            <label for="report-text">Position:</label>
            <input type="text" id="position_noted" name="position_noted" value="<?php echo $row['position_noted']; ?>"><br>
        </div>
        
    </div>

        <button id="submitBtn" type="submit">Save</button>
        </form>
        <button id="backBtn"><a href="incident-list.php">Back</a></button>
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
        .dashboard-container input[type="text"] {
            width: 300px; /* Increase the width as needed */
            height: 40px;
            margin-top: 10px;
            margin-left: 50px;
            margin-right: 20%;
            font-family: 'Mulish', sans-serif;
            border: 1px solid black;
            border-radius: 7px;
            padding-left: 10px;
            padding-right: 10px;
            font-size: 15px;
            box-sizing: border-box;
            text-align: left;
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
            margin-right: 29%;
            font-family: 'Mulish', sans-serif;
            border: 1px solid black;
        }
        .dashboardContainer::-webkit-scrollbar {
            display: block;
            width: 5px;
        }

        .dashboardContainer::-webkit-scrollbar-thumb {
            background: white;
            border-radius: 15px;
        }

        .dashboardContainer::-webkit-scrollbar-track {
            background: #173381;
        }

        .dashboard-container label {
            font-family: 'Mulish', sans-serif;
        }

        .first {
            text-align: right;
            margin-right: 45%;
            margin-top: 5px;
        }

        .first label {
            margin-top: 10px;
        }

        .second label {
            vertical-align: top;
            margin-top: 35px;
            padding-right: 50px;
        }

        .second textarea {
            width: 300px;
            margin-right: 14%;
            margin-top: 10px;
            padding-top: 5px;
            height: 180px;
        }

        .text-input {
            resize: none;
            overflow-y: hidden;
            line-height: 1;
            text-align: justify;
            min-height: 75px;
            border: 1px solid black;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 7px;
        }

        .incidentID {
            margin-right: -41px;
        }

        .third {
            margin-right: -7%;
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

        @media screen and (max-width: 1555px) and (min-width: 320px) {
            .dashboard-container {
                width: 98%;
            }

            .dashboard-container .header img {
                display: block;
            }
        }

        @media screen and (max-width: 1950px) and (min-width: 1620px) {
            .dashboard-container {
                width: 85.4%;
            }

            .second {
                margin-right: 8.5%;
            }

            .third {
                margin-right: 1.5%;
            }
        }
    </style>
</body>
</html>