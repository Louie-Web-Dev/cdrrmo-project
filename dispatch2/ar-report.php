<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDRRMO Sto. Tomas</title>
  <link rel="icon" type="image/x-icon" href="/cdrrmo-project/images/sto_thomas.png">
  <?php include 'nav-header.php'; ?>
</head>
<body>
    
<form action="save_ar.php" method="post" onsubmit="return confirmSave();">

<div class="ar-container">

<div class="ar-header">
    <img src=".\Image\logo.jpg" id="logo" alt="" style="height: 75px; width: 75px; background-color: transparent; 
position: absolute; left: 32.5%; top: 2%;">
    <img src=".\Image\aksyon.png" id="logo2" alt="" style="background-color: transparent; height: 75px;
    width: 150px; position: absolute; top: 1%; left: 58%;">
    <div class="text1">REPPUBLIC OF THE PHILIPPINES<br>PROVINCE OF BATANGAS</div>
    <div class="text2">CITY OF STO. TOMAS</div>
    <div class="text3">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
    <div class="text4">SPOT REPORT: AMBULANCE REQUEST</div>

        <div class="print-container">
                <i class="fa-solid fa-print" onclick="window.print()"></i>
        </div>
</div>

<div class="response-container">
    <h1>RESPONSE DETAILS</h1>

    <div class="response_date">
        <label for="response_date">Response Date:</label>
        <input type="date" id="response_date" name="response_date">
    </div>

    <div class="departure">
        <label for="departure">Departure from Base:</label>
        <input type="time" id="departure" name="departure">
    </div>
    
    <div class="arrival">
        <label for="arrival">Arrival at Destination:</label>
        <input type="time" id="arrival">
    </div>

    <div class="departure-des">
        <label for="dept">Departure from Destination:</label>
        <input type="time" id="dept">
    </div>

    <div class="arrival-base">
        <label for="base">Arrival at Base:</label>
        <input type="time" id="base">
    </div>
</div>

<div class="action-container">
    <h1>ACTION TAKEN</h1>

   <div class="action-taken">
    <label for="actiontaken">Action Taken:</label>
    <input type="checkbox"><span>Transport Patient from location to destination</span>
    <br>
    <input type="checkbox" id="others-checkbox"><span>Others</span>
    <br>
    <input type="text" id="others-textbox">
   </div>

   <div class="actTkn-details">
    <label for="details">Action Taken Details:</label>
    <input type="text" id="actTkn-details">
   </div>

   <div class="dispatch-team">
    <label for="dispatch-team">Dispatch Team:</label>
    <input type="checkbox" id="dispatch-yes">
    <span for="dispatch-yes">Yes</span>
    <input type="text" class="dispatch-yes">
    <br>
    <input type="checkbox" id="dispatch-no">
    <span id="dispatch_no" for="dispatch-no">No</span>
    <input type="text" class="dispatch-no">
   </div>

   <div class="team-leader">
    <label for="team-leader">Team Leader`s Name:</label>
    <span></span>
   </div>
</div>

<div class="victim-container">
    <h1>VICTIM/PATIENT DETAILS</h1>

    <button id="openModalBtn">Add Victim Info</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeModalBtn">&times;</span>
            <h2>Enter Victim Information</h2>
            <div class="bgColor"></div>
            <form id="victimForm">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" ><br><br>

                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName"><br><br>

                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select><br><br>

                <label for="gender">Gender:</label>
                <input type="radio" id="male" name="gender" value="Male"><span class="male">Male</span>
                <input type="radio" id="female" name="gender" value="Female"><span class="female">Female</span><br><br>

                <button id="nextBtn" type="button">Next</button>
            </form>
        </div>
    </div>

    <div class="infoContainer" id="infoContainer">
        <!-- Information will be displayed here -->
    </div>

    <script>
        // JavaScript code to handle the modal and information display
        const openModalBtn = document.getElementById('openModalBtn');
        const modal = document.getElementById('myModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const victimForm = document.getElementById('victimForm');
        const nextBtn = document.getElementById('nextBtn');
        const infoContainer = document.getElementById('infoContainer');

        openModalBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeModalBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        nextBtn.addEventListener('click', () => {
            const lastName = document.getElementById('lastName').value;
            const firstName = document.getElementById('firstName').value;
            const status = document.getElementById('status').value;
            const gender = document.querySelector('input[name="gender"]:checked').value;

            // Create a new element to display the information
            const infoElement = document.createElement('div');
            infoElement.innerHTML = `
                <strong>Last Name:</strong> ${lastName}<br>
                <strong>First Name:</strong> ${firstName}<br>
                <strong>Status:</strong> ${status}<br>
                <strong>Gender:</strong> ${gender}<br><br>
            `;

            // Append the information to the container
            infoContainer.appendChild(infoElement);

            // Clear the form
            victimForm.reset();
            modal.style.display = 'none';
        });
    </script>

</div>

<div class="saveBtn">
<button type="submit">Save</button>
<script>
    function confirmSave() {
        return confirm("Are you sure you want to save this incident report?");
    }
</script>

</form>



    <style>

        body {
            background-color: #173381;
        }

.ar-container {
    background-color: white;
    width: 82%;
    height: 100%;
    position: fixed;
    right: 10px;
    margin-top: 83px;
    margin-bottom: 20px; /* Add margin at the bottom */
    border-radius: 15px;
    overflow: scroll;
    padding-bottom: 50px;

}

.ar-container::-webkit-scrollbar {
        display: block;
        width: 10px;
    }

    .ar-container::-webkit-scrollbar-thumb {
        background: white;
        border-radius: 5px;
    }

    .ar-container::-webkit-scrollbar-track {
        background: #173381;
    }

.ar-header {
    background-color: transparent;
    margin-top: 10px;
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
    font-weight: bolder;
}

.text3 {
    font-size: 20px;
}

.text4 {
    margin-top: 0;
    font-size: 15px;
    font-weight: bolder;
    padding-bottom: 15px;
}



.ar-header i {
    position: absolute;
    top: 30px;
    right: 10px;
    color: #173381;
    font-size: 25px;
    background-color: transparent;
}

@media print {
    body * {
        visibility: hidden;
    }
}


.print-container {
    background-color: transparent;
    cursor: pointer;
    visibility: visible;
}

.response-container {
    font-family: 'Mulish', sans-serif;
    margin-top: 10px;
    width: 45%;
    height: 300px;
    border: #173381 2px solid;
    border-radius: 15px;
    background-color: transparent;
    margin-left: 3%;
}

.response-container h1 {
    font-family: 'Mulish', sans-serif;
    font-weight: 600;
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

.response_date {
    background-color: transparent;
}

.response_date label, input {
    margin-top: 5px;
    background-color: transparent;
}

.response_date label {
    margin-left: 100px;
}

.response_date input {
    color: rgb(151, 151, 151);
    margin-left: 30px;
    width: 260px;
    border: rgb(151, 151, 151) solid 2px;
}

.departure, .departure label, input {
    background-color: transparent;
}

.departure label {
    margin-left: 61px;
}

.departure input {
    color: rgb(151, 151, 151);
    margin-left: 31px;
    width: 260px;
    border: rgb(151, 151, 151) solid 2px;
}

.arrival, .arrival label, input {
    background-color: transparent;
}

.arrival label {
    margin-left: 62px;
}

.arrival input {
    color: rgb(151, 151, 151);
    margin-left: 31px;
    width: 260px;
    border: rgb(151, 151, 151) solid 2px;
}

.departure-des, .departure-des label, input {
    background-color: transparent;
}

.departure-des label {
    margin-left: 18px;
}

.departure-des input {
    color: rgb(151, 151, 151);
    margin-left: 30px;
    width: 260px;
    border: rgb(151, 151, 151) solid 2px;
}

.arrival-base, .arrival-base label, input {
    background-color: transparent;
}

.arrival-base label {
    margin-left: 106px;
}

.arrival-base input {
    color: rgb(151, 151, 151);
    margin-left: 30px;
    width: 260px;
    border: rgb(151, 151, 151) solid 2px;
}

.response_date input, label {
    margin-top: 15px;
}

.action-container {
    font-family: 'Mulish', sans-serif;
    margin-top: 10px;
    width: 45%;
    height: 320px;
    border: #173381 2px solid;
    border-radius: 15px;
    background-color: transparent;
    left: 1%;
}

.action-container h1 {
    font-family: 'Mulish', sans-serif;
    font-weight: 600;
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

.action-taken, .action-taken label, input, span {
    background-color: transparent;
}

.action-taken label {
    margin-left: 115px;
}

.action-taken input {
    margin-left: 30px;
}

#others-checkbox {
    margin-left: 245px;
}

.action-taken span {
    margin-left: 6px;
    font-size: 12px;
}

#others-textbox {
    margin-left: 245px;
    width: 260px;
    border: rgb(151, 151, 151) solid 2px;
}

.actTkn-details, .actTkn-details label {
    background-color: transparent;
}

.actTkn-details label {
    margin-left: 64px;
}

.actTkn-details input {
    margin-left: 27px;
    width: 260px;
    border: rgb(151, 151, 151) solid 2px;
}

.dispatch-team, .dispatch-team span, label {
    background-color: transparent;
}

.dispatch-team label {
    margin-left: 103px;
}

#dispatch-yes {
    margin-left: 26px;
}

#dispatch-no {
    margin-left: 244px;
}

.dispatch-team span {
    padding-left: 20px;
}

.dispatch-yes {
    position: absolute;
    width: 188px;
    margin-top: 7px;
    margin-left: 10px;
    border: rgb(151, 151, 151) solid 2px;
}

.dispatch-no {
    width: 188px;
    margin-left: 12px;
    border: rgb(151, 151, 151) solid 2px;
}

.team-leader, .team-leader label, span {
    background-color: transparent;
}

.team-leader label {
    margin-left: 65px;
}

.victim-container {
    font-family: 'Mulish', sans-serif;
    margin-top: 10px;
    float: right;
    width: 45%;
    height: 300px;
    border: #173381 2px solid;
    border-radius: 15px;
    background-color: transparent;
    margin-right: 3%;
    margin-top: -630px;
}

.victim-container h1 {
    font-family: 'Mulish', sans-serif;
    font-weight: 600;
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

.modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            width: 60%;
        }
        .infoContainer {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: transparent;
            color: black;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        #openModalBtn {
            background-color: #173381;
            width: 150px;
            height: 40px;
            font-weight: bold;
            font-family: 'Mulish', sans-serif;
            color: white;
            margin: 15px;
            border-radius: 15px;
        }

        #myModal h2 {
            color: white;
            position: absolute;
            top: 7px;
            left: 37%;
        }

        .bgColor {
            margin-left: -20px;
            background-color: #173381;
            width: 104.5%;
            height: 35px;
            margin-top: -20px;
        }

        #closeModalBtn {
            position: absolute;
            font-size: 20px;
            color: white;
            top: 2px;
            border-radius: 5px;
        }

        #victimForm {
            margin-top: 30px;
        }

        #firstName, #lastName {
            width: 300px;
            height: 30px;
            border: 1px solid black;
            margin-left: 130px;

        }

        #victimForm label {
            position: absolute;
            margin-top: -20px;
            margin-left: 200px;
        }

        #victimForm select {
            position: absolute;
            width: 300px;
            background-color: transparent;
            border: 1px black solid;
            margin-left: 327px;
            height: 30px;
            top: 160px;
        }

        #male, #female {
            height: 40px;
            width: 40px;
            margin-left: 120px;
        }

        .male, .female {
            margin-left: 150px;
        }

        #nextBtn {
            background-color: #173381;
            width: 150px;
            height: 40px;
            font-weight: bold;
            font-family: 'Mulish', sans-serif;
            color: white;
            margin: 15px;
            border-radius: 15px;
            margin-left: 45%;
        }

.action-container, .response-container, .victim-container {
    align-items: center;
    justify-content: center;
    margin-left: 5%;
}


.saveBtn button {
    position: absolute;
    color: white;
    background-color: #173381;
    bottom: 120px;
    right: 32px;
    width: 100px;
    height: 40px;
    border-radius: 15px;
    font-family: 'Mulish', sans-serif;
    text-align: center;
}

@media screen and (max-width: 1555px) and (min-width: 320px) {
    .ar-container {
        width: 98%;
    }

    .response-container {
        width: 95%;
        margin-left: 3%;
        text-align: right;
    }

    .response-container h1,
    .action-container h1 {
        text-align: left;
    }

    .action-container {
        width: 95%;
        margin-left: 3%;
        text-align: right;
    }

    .victim-container {
        float: none;
        margin-top: 10px;
        margin-left: 3%;
        width: 95%;
    }

    .saveBtn button {
        position: none;
        margin-bottom: -660px;
    }

    .response_date,
    .departure,
    .arrival,
    .departure-des,
    .arrival-base {
        margin-right: 30%;
    }

    .action-taken,
    .actTkn-details,
    .team-leader {
        margin-right: 30%;
    }

    .dispatch-team {
        margin-right: 51%;
    }

    .team-leader {
        margin-right: 59%;
    }
}

@media screen and (max-width: 1950px) and (min-width: 1620px) {
        .ar-container {
        min-width: 85.4%;
        }
    }
    </style>

</body>
</html>