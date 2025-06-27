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
    <img src=".\Image\logo.jpg" alt="Sto. Thomas" class="logo">
    <img src=".\Image\aksyon.png" alt="Aksyon Bilis" class="logo">

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

        <div class="report">
            <h3>Report:</h3>
            <div class="report-detail"><?= $incident['report_text']; ?>
            </div>
            <h3>Action Taken:</h3>
            <div class="report-detail"><?= $incident['text_action_dispatch']; ?><br>
            <?= $incident['text_action_arrive']; ?>
            </div>

            <div class="report-detail-victim">
                <?php
                $sentences = explode('.', $incident['text_victim_details']);
                foreach ($sentences as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<li>' . $trimmedSentence . '.</li>';
                    }
                }
                ?>
            </div>

            <div class="report-detail"><?= $incident['team_departed_scene']; ?><br>
            <?= $incident['team_arrived_base']; ?>
            </div>

       
            <h3>Name of Patient:</h3><br>
            <div class="report-detail-victim">
                <?php
                $sentences = explode('-', $incident['victim_details']);
                foreach ($sentences as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<li>' . $trimmedSentence . '.</li>';
                    }
                }
                ?>
            </div><br>

            <h3>Prepared by:</h3><br>
            <?php
                $sentencesPreparedBy = explode('^', $incident['prepared_by']);
                foreach ($sentencesPreparedBy as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<p style="font-size: 18px;">' . rtrim($trimmedSentence, '.') . '<br>';
                    }
                }
                ?>

                <?php
                $sentencesPosition = explode('^', $incident['position']);
                foreach ($sentencesPosition as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<p style="font-size: 18px;">' . rtrim($trimmedSentence, '.') . '<br>';
                    }
                }
            ?>
            <br>
            <h3>Encoded by:</h3><br>
            <?php
                $sentencesPreparedBy = explode('^', $incident['encoded_by']);
                foreach ($sentencesPreparedBy as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<p style="font-size: 18px;">' . rtrim($trimmedSentence, '.') . '<br>';
                    }
                }
                ?>

                <?php
                $sentencesPosition = explode('^', $incident['encoder_position']);
                foreach ($sentencesPosition as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<p style="font-size: 18px;">' . rtrim($trimmedSentence, '.') . '<br>';
                    }
                }
            ?>
            <br>
            <h3>Noted by:</h3><br>
            <?php
                $sentencesPreparedBy = explode('^', $incident['noted_by']);
                foreach ($sentencesPreparedBy as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<p style="font-weight: 500; font-size: 18px;">' . rtrim($trimmedSentence, '.') . '<br>';
                    }
                }
                ?>

                <?php
                $sentencesPosition = explode('^', $incident['position_noted']);
                foreach ($sentencesPosition as $sentence) {
                    $trimmedSentence = trim($sentence);
                    if (!empty($trimmedSentence)) {
                        echo '<p style="font-size: 18px;">' . rtrim($trimmedSentence, '.') . '<br>';
                    }
                }
            ?>

        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="footer">
        <div class="horizontal-line2"></div>
        <h5>Gov. Malvar St., City Hall Main Building, Poblacion 1, Sto. Tomas City, Batangas</h5>
        <h5>Telephone No.(043)784-8022 to 24</h5>
        <h5>Fax No. (043) 778-4901</h5>
        <h5>Website: www.stotomasbatangas.gov.ph</h5>
        <h5>"AKSYON BILIS"</h5>
    </div>

          
           








    </div>
        
        <button onclick="window.print()">Print</button>


        <button type="button" onclick="navigateToNextPage();">Next</button>
            <script>
                function navigateToNextPage() {
                    window.location.href = "resolved_incident.php";
                }
            </script>



    <style>
    body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
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
    left: 40%;
    top: 2.5%;
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
    margin-top: 35px;
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

h5{
    text-align: center;
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
.horizontal-line2 {
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

        .report {

            margin-left: 55px;
            margin-bottom: 20px;
        }

        .report h3 {
            font-weight: 400;
        }

        .report-detail {
            font-size: 16px;
            margin-bottom: 15px;
            margin-right: 50px;
            margin-left: 45px;
        }
        .report-detail-victim{
            font-size: 16px;
            margin-bottom: 15px;
            margin-right: 50px;
            margin-left: 70px;
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
    .report {

    margin-left: -140px;
    margin-bottom: 20px;
    }

    .report h3 {
    font-weight: 400;
    }
    .report h4 {
    font-weight: 100;
    }

    .report-detail {
    font-size: 18px;
    margin-bottom: 15px;
    margin-right: 50px;
    margin-left: 45px;
    }
    .report-detail-victim{
    font-size: 16px;
    margin-bottom: 15px;
    margin-right: 50px;
    margin-left: 70px;
    }

    .incident-details {
        display: flex;
        flex-direction: column;
        margin-left: -150px;
        margin-top: -60px;
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
        text-align: center;
        margin-left: -100px;
        margin-right: -100px;
        

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
    .incident-details {
    display: flex;
    flex-direction: column;
    margin-top: -30px;
}


    .report {

    margin-bottom: 20px;
    margin-right: -150px;
    }

    .report h3 {
    font-weight: 400;
    }

    .report-detail {
    font-size: 16px;

    margin-left: 45px;
    }
    .report-detail-victim{
    font-size: 16px;
    margin-bottom: 15px;
    margin-left: 70px;
    }

    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
        margin-right: 300px;
            }
            .horizontal-line2 {
                margin-right: 250px;
                margin-left: -150px; 
            }

            h5 {
                margin-right: 400px; /* Adjust the margin as needed */
            }
    }





</style>
</body>

</html>