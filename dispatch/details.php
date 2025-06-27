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
    
</head>
<body>
<div class="reportContainer">
    <div class="header">
    <img src="\cdrrmo-project\images\sto_thomas.png" alt="Sto. Thomas" class="logo">
    <img src="\cdrrmo-project\images\aksyon-bilis.png" alt="Aksyon Bilis" class="logo">

    <div class="text1">Republic of the Philippines<br>Province of Batangas</div>
    <div class="text2">CITY OF STO. TOMAS</div>
    <div class="text3">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
    <div class="text4">INCIDENT REPORT</div>
</div>
    <div class="dashboard-container">
    
        <div class="incident-details">
            
            <div class="detail-label">DATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= date('F j, Y', strtotime($incident['date'])); ?></div></div>
                
            <div class="detail-label">TIME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value">
            <?= date('Hi', strtotime($incident['time'])); ?> Hrs
            </div></div>

            <div class="detail-label">INCIDENT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['incident_type']; ?></div></div>

            <div class="detail-label">LOCATION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['location']; ?>, City of Sto. Tomas Batangas</div></div>

            <div class="detail-label">CONTROL NO&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="detail-value"><?= $incident['Incident_ID']; ?></div></div>
        </div>
        <div class="horizontal-line"></div>
        
    </div>
        
        <button onclick="window.print()">Print</button>


        <button type="button" onclick="navigateToNextPage();">Next</button>
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
}

    .reportContainer {

    background-color: white;
    width: 50%;
    height: 100%;

}


.header img {
    background-color: transparent;
    position: absolute;
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
    left: 59%;
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

.detail-label {
    display: inline-block;
    margin-right: 5px; 
    margin-bottom: -20px;
    
}

.detail-value {
    display: inline-block;
    font-family: 'Times New Roman', Times, serif;
    font-weight: normal;
    background: transparent;
}

.horizontal-line {
            border-top: 3px solid black; 
            margin-top: -8px; 
            position: relative; 
            z-index: 1;
            margin-right: 53px;
            margin-left: 53px;
        }
.detail-label,
.detail-value {
     
}

@media print {
    body {
        font-family: 'Times New Roman', Times, serif;
  
    }

    .incident-details {
        display: flex;
        flex-direction: column;
        margin-left: -150px;
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
        border-top: 3px solid black;
        margin-top: -8px; 
        position: relative; 
        z-index: 1;
        margin-right: -150px;
        margin-left: -150px;
        }
    
}





</style>
</body>

</html>