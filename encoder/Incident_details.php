<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "save.php";

$incident = null;

if (isset($_GET["id"])) {
    $incidentId = $_GET["id"];
    $sql = "SELECT * FROM incidents WHERE id = $incidentId";
    $result = mysqli_query($conn, $sql);


    if ($result && mysqli_num_rows($result) > 0) {
        $incident = mysqli_fetch_assoc($result);
    } else {
        
        header("Location: incidents.php");
        exit();
    }
} else {
    
    header("Location: incidents.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDRRMO Sto. Tomas</title>
    <link rel="icon" type="image/x-icon" href="/cdrrmo-project/images/sto_thomas.png">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>
<body>
<div class="reportContainer">
    <div class="header">
    <img src=".\Image\logo.jpg" alt="Sto. Thomas" class="logo">
    <img src=".\Image\aksyon.png" alt="Aksyon Bilis" class="logo">

    <div class="text1">Republic of the Philippines<br>Province of Batangas</div>
    <div class="text2">CITY OF STO. TOMAS</div>
    <div class="text3">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
    <div class="text4">INCIDENT DETAIL SHEET</div>
</div>
    <div class="dashboard-container">
    
        <div class="incident-details">
            
            <div class="detail-label">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= date('F j, Y', strtotime($incident['date'])); ?></div></div>
                
            <div class="detail-label">Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value">
            <?= $incident['time']; ?>
            </div></div>

            <div class="detail-label">Incident&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['incident_type']; ?></div></div>

            <div class="detail-label">Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['location']; ?>, City of Sto. Tomas Batangas</div></div>

            <div class="detail-label">Control No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['Incident_ID']; ?></div></div>
        </div>
        <div class="horizontal-line"></div>

        <h4>Caller's Details</h4>
        <div class="horizontal-line2"></div>

        <div class="incident-details">
            
              
            <div class="detail-label">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['caller_last_name']; ?>,
        <?= $incident['caller_first_name']; ?>
        <?= $incident['caller_middle_initial']; ?></div></div>
                
            <div class="detail-label">Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['caller_address']; ?>, City of Sto. Tomas Batangas</div></div>

            <div class="detail-label">Contact No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['contact']; ?></div></div>
        </div>
        <div class="horizontal-line"></div>
        <h4>Patient Details</h4>
        <div class="horizontal-line2"></div>

        <div class="incident-details">
        <!--paltan mismo ng victim/patient details-->
        <div class="detail-label">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['caller_last_name']; ?>,
        <?= $incident['caller_first_name']; ?>
        <?= $incident['caller_middle_initial']; ?></div></div>
                
            <div class="detail-label">Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['caller_address']; ?>, City of Sto. Tomas Batangas</div></div>

            <div class="detail-label">Contact No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['contact']; ?></div></div>
        </div>
        <div class="horizontal-line"></div>
        <h4>Vehicular Accident Detail</h4>
        <div class="horizontal-line2"></div>

        <div class="incident-details">
            
              
            <div class="detail-label">Specific Location&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['specific_location']; ?>&nbsp;</div></div>
                
            <div class="detail-label">Vechile's involved&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['vehicle_involved']; ?> / <?= $incident['vehicle_type']; ?></div></div>

            <div class="detail-label">Other Details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['additional_details']; ?>&nbsp;</div></div>
        </div>
        <div class="horizontal-line"></div>
        <h4>Response Details</h4>
        <div class="horizontal-line2"></div>

        <div class="incident-details">
            
              <!--lalagayan ng Response Details dagdagan sa incident deatils form -->
            <div class="detail-label">Action Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?php
                if ($incident['action_taken'] === 'Others') {
                    echo $incident['action_taken_others'];
                } else {
                    echo $incident['action_taken'];
                }
                ?>&nbsp;</div></div>
            <div class="detail-label">Verified By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['verified_by']; ?></div></div>


        </div>
        <div class="horizontal-line"></div>
        
        <div class="horizontal-line4"></div>
        <h6>(Signature over Printed Name)</h6>
        <h5>Operator/Encoder</h5>
        

    </div>
        
  
    <button id="printButton" class="fixedButton" onclick="window.print()">Print</button>

    <!-- Next button with fixed position -->
    <button id="nextButton" class="fixedButton" type="button" onclick="navigateToNextPage();">Next</button>

    <script>
        function navigateToNextPage() {
            window.location.href = "incident-list.php";
        }
    </script>



    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
            flex-direction: column;
            z-index: 1;
        }
        .fixedButton {
            position: fixed;
            z-index: 999; /* Ensure the button is on top of other elements */
        }

        #printButton {
            bottom: 20px; /* Adjust the distance from the bottom as needed */
            right: 20px; /* Adjust the distance from the right as needed */
        }

        #nextButton {
            bottom: 70px; /* Adjust the distance from the bottom as needed */
            right: 20px; /* Adjust the distance from the right as needed */
        }

        #saveButton {
            bottom: 120px; /* Adjust the distance from the bottom as needed */
            right: 20px; /* Adjust the distance from the right as needed */
        }





        .reportContainer {

            background-color: white;
            width: 45%;
            height: 100%;

        }


        .header img {
            background-color: transparent;
            position: absolute;
        }


        .header img:nth-of-type(1) {
            height: 75px;
            width: 75px;
            left: 40%;
            top: 3%;
        }


        .header img:nth-of-type(2) {
            height: 75px;
            width: 150px;
            left: 55%;
            top: 2%;
        }

        .text1, .text2 {
            background-color: transparent;
            font-size: 13px;
            margin-left: 0;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 600;
            margin-top: 40px;
        }

        .text2 {
            margin-top: 0;
        }

        .text3 {
            font-size: 18px;
            background-color: transparent;
            margin-left: 0;
            text-align: center;
            font-weight: 800;
            margin-top: 33px;
        }

        .text4 {
            margin-top: 0px;
            font-size: 20px;
            background-color: transparent;
            margin-left: 0;
            text-align: center;
            font-weight: 800;
        }

        .incident-details {
            display: flex;
            flex-direction: column;
            margin-left: 50px;
            margin-top: -20px;
        }
        h3{
            margin-top: -20px;
            text-align: center;
            margin-bottom: 20px;
        }
        h4{
            margin-top: -20px;
            text-align: center;
            margin-bottom: 20px;
        }

        h5{
            margin-top:  -20px;
            margin-bottom: 20px;
            margin-left: 80px;
        }
        h6{
            margin-top:  -10px;
            margin-bottom: 20px;
            margin-left: 64px;
        }

        .detail-label {
            display: inline-block;
            margin-right: -100px; 
            margin-bottom: -18px;
            
        }
        .detail-label2 {
            display: inline-block;
            margin-right: 50px; 
            margin-left: 100px;
        }
        .detail-value {
            display: inline-block;
            font-family: 'Times New Roman', Times, serif;
            font-weight: normal;
            background: transparent;
            border: none;
            margin-right: none;
            margin-left: 50px;
        }

        .horizontal-line {
            border-top: 2px solid black; 
            margin-top: -8px; 
            position: relative; 
            z-index: 1;
            margin-right: 53px;
            margin-left: 53px;
            margin-bottom: 18px;
        }
        .horizontal-line2 {
            border-top: 2px solid black; 
            margin-top: -22px; 
            position: relative; 
            z-index: 1;
            margin-right: 53px;
            margin-left: 53px;
            margin-bottom: 15px;
        }
        .horizontal-line3 {
            border-top: 2px solid black; 
            margin-top: -22px; 
            position: relative; 
            z-index: 1;
            margin-right: 53px;
            margin-left: 53px;
            margin-bottom: 15px;
        }
        .horizontal-line4 {
            border-top: 2px solid black; 
            margin-top: 50px; 
            position: relative; 
            z-index: 1;
            margin-right: 500px;
            margin-left: 53px;
            margin-bottom: 15px;
        }
        .detail-label,
        .detail-value {
            
        }

@media print {
    body {
        font-family: 'Times New Roman', Times, serif;
  
    }
    .reportContainer {

    background-color: white;
    width: 50%;
    height: 100%;

    }
    .header img:nth-of-type(1) {
        height: 75px;
        width: 75px;
        left: 38%;
        top: 3%;
        }


        .header img:nth-of-type(2) {
            height: 75px;
            width: 150px;
            left: 60%;
            top: 2%;
        }

        .text1, .text2 {
            background-color: transparent;
            font-size: 13px;
            margin-left: 0;
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 600;
            margin-top: 30px;
        }

    .incident-details {
        display: flex;
        flex-direction: column;
        margin-left: -150px;
    }
    .detail-value {
        display: inline-block;
        font-family: 'Times New Roman', Times, serif;
        font-weight: normal;
        background: transparent;
        border: none;
        margin-right: none;
    }

    button {
        display: none;
    }
    
    
    .header img:nth-of-type(1) {
        height: 75px;
        width: 75px;
        left: 25%;
        top: 1.5%;
    }

    
    .header img:nth-of-type(2) {
        height: 75px;
        width: 150px;
        left: 61%;
        top: 1%;
    }
    .text1, .text2 {
        background-color: transparent;
        font-size: 13px;
        margin-left: 0;
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
        font-weight: 600;
        margin-top: 30px;
    }

    .text2 {
        margin-top: 0;
    }

    .text3 {
        font-size: 18px;
        background-color: transparent;
        margin-left: -100px;
        margin-right: -100px;
        font-weight: 800;
        margin-top: 33px;
    }

    .text4 {
        margin-top: 0px;
        font-size: 20px;
        background-color: transparent;
        margin-left: 0;
        text-align: center;
        font-weight: 800;
    }
    .horizontal-line {
        border-top: 2px solid black;
        margin-top: -10px; 
        position: relative; 
        z-index: 1;
        margin-right: -150px;
        margin-left: -150px;
        }
    .horizontal-line2 {
        border-top: 2px solid black;
        margin-top: -22px; 
        position: relative; 
        z-index: 1;
        margin-right: -150px;
        margin-left: -150px;
        }
    .horizontal-line3 {
        border-top: 2px solid black; 
        margin-top: -22px; 
        position: relative; 
        z-index: 1;
        margin-right: 53px;
        margin-left: 53px;
        margin-bottom: 15px;
        }
    .horizontal-line4 {
        border-top: 2px solid black; 
        margin-top: 50px; 
        position: relative; 
        z-index: 1;
        margin-right: 300px;
        margin-left: -150px;
        margin-bottom: 15px;
        }

        h5{
        margin-top:  -20px;
        margin-bottom: 120px;
        margin-left: -110px;
        
        }
        h6{
        margin-top:  -15px;
        margin-bottom: 20px;
        margin-left: -130px;
        text-align: justify;
        }
}
</style>
</body>

</html>