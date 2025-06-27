<?php
    session_start();
    if (!isset($_SESSION["user"]) || $_SESSION["usertype"] !== "admin") {
        header("Location: /cdrrmo-project/login.php");
        exit();
    }

    require_once "database.php";

    $email = $_SESSION["username"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        $fullName = $userData["full_name"];
    } else {
        
        $fullName = "User Full Name Not Available";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDRRMO Sto. Tomas</title>
    <?php include 'nav-header.php'; ?>
</head>
<body>
<form id="incidentForm" action="save.php" method="post" onsubmit="return confirmSave()">
<script>
  function confirmSave() {
    openModal();
    return false; // Prevents the form from submitting
  }
</script>
<div class="incidentContainer">

                        <div class="saveBtn bg-transparent" style="padding-bottom: 50px;">
                            <button type="button" onclick="openModal()">Save</button>
                        </div>

        <div class="header">
            <img src=".\Image\logo.jpg" alt="" style="height: 75px; width: 75px; background-color: transparent; 
            position: absolute; left: 34%; top: 3%;">
            <img src=".\Image\aksyon.png" alt="" style="background-color: transparent; height: 75px;
            width: 150px; position: absolute; top: 2%; left: 59%;">
            <div class="text1">REPPUBLIC OF THE PHILIPPINES<br>PROVINCE OF BATANGAS</div>
            <div class="text2">CITY OF STO. TOMAS</div>
            <div class="text3">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
            <div class="text4">INCIDENT DETAILS</div>

        </div>
        <div class="detailsContainer">
            <h1>INCIDENT DETAILS</h1>
            <?php

        // Create connection
        require_once "database.php";

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to get the current maximum Incident ID
        $sql_get_max_incident_id = "SELECT MAX(id) AS max_id FROM incidents";
        $result_get_max_incident_id = $conn->query($sql_get_max_incident_id);

        if ($result_get_max_incident_id->num_rows > 0) {
            $row = $result_get_max_incident_id->fetch_assoc();

            // Check if "max_id" key exists in the array
            $max_id = isset($row['max_id']) ? $row['max_id'] : 0;

            // Calculate the next incident ID
            $next_incident_id = $max_id + 1;

            // Display the next Incident ID without the additional information
            $formatted_date = date('Ymd');
            $incident_id = $formatted_date . '-' . str_pad($next_incident_id, 3, '0', STR_PAD_LEFT);

            echo '<div class="incidentID bg-transparent" style="margin-right: 330px; padding-top: 10px;">
                    <label for="">Incident ID:</label>
                    <span id="incidentIdDisplay">' . $incident_id . '</span>
                    <input type="hidden" name="Incident_ID" id="incidentIdInput" value="' . $incident_id . '">
                </div>';
        } else {
            echo '<p class="bg-transparent">Error: Unable to retrieve the next Incident ID</p>';
        }

        $result_get_max_incident_id->free_result();
        $conn->close();
        ?>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
        $(document).ready(function() {
            // Function to update the Incident ID
            function updateIncidentId() {
                $.ajax({
                    url: 'get_next_incident_id.php', // Replace with the actual PHP file name
                    type: 'GET',
                    success: function(response) {
                        $('#incidentIdDisplay').text(response);
                        $('#incidentIdInput').val(response);
                    },
                    error: function() {
                        console.log('Error fetching next Incident ID');
                    }
                });
            }

            // Initial call to set up the Incident ID
            updateIncidentId();

            // Set up an interval to update the Incident ID every 10 seconds (adjust as needed)
            setInterval(updateIncidentId, 100);
        });
        </script>
  
                <div class="status bg-transparent">
                    <label for="status">Status:</label>
                    <select name="status" id="" required>
                        <option value="" disabled>Select status</option>
                        <option value="New" selected>New</option>
                        <option value="Verified">Verified</option>
                    </select>
                </div>
  
                <div class="date bg-transparent">
                    <label for="">Date of Incident:</label>
                    <input type="date" name="date" id="date">
                </div>
                <script>
                    // Get today's date in the format YYYY-MM-DD
                    function getToday() {
                        const today = new Date();
                        const year = today.getFullYear();
                        let month = (today.getMonth() + 1).toString().padStart(2, '0');
                        let day = today.getDate().toString().padStart(2, '0');
                        return `${year}-${month}-${day}`;
                    }

                    // Set the value of the date input to today's date
                    document.getElementById('date').value = getToday();
                </script>
  
                <div class="time bg-transparent">
                <label for="">Time Reported:</label>
                <input type="time" name="time" id="time" step="1" required>
            </div>

            <script>
                var intervalId;

                function updateTime() {
                    var currentTime = new Date();
                    var hours = currentTime.getHours().toString().padStart(2, '0');
                    var minutes = currentTime.getMinutes().toString().padStart(2, '0');
                    var seconds = currentTime.getSeconds().toString().padStart(2, '0');

                    // Format the time as HH:mm:ss
                    var formattedTime = hours + ':' + minutes + ':' + seconds;

                    // Set the formatted time as the value of the input
                    document.getElementById('time').value = formattedTime;
                }

                // Start the interval to update the time every second
                intervalId = setInterval(updateTime, 1000);

                // Call the function once on page load
                updateTime();

                // Listen for user input
                document.getElementById('time').addEventListener('input', function() {
                    clearInterval(intervalId); // Stop the automatic update
                });
            </script>

                  <div class="source bg-transparent">
                      <label for="source">Source:</label>
                          <select name="source" id="">
                              <option value="" disabled selected>Select Source</option>
                              <option value="Phone/Message">Phone/Message</option>
                              <option value="Facebook">Facebook</option>
                              <option value="Internal">Internal</option>
                              <option value="Command Center">Command Center</option>
                              <option value="National Agency">National Agency</option>
                          </select>
                      </option>
                  </div>
          </div>
  
          <div class="callerContainer">
              <h1>CALLER DETAILS</h1>
                  <div class="caller_last_name bg-transparent">
                      <label for="surname_input">Last Name:</label>
                      <input type="text" placeholder="ex. Dela Cruz" name="caller_last_name">
                  </div>
  
                  <div class="caller_first_name bg-transparent">
                      <label for="fn-input">First Name:</label>
                      <input type="text" placeholder="ex. Juan" name="caller_first_name">
                  </div>
  
                  <div class="caller_middle_initial bg-transparent">
                      <label for="mi-input">Middle Initial:</label>
                      <input type="text" placeholder="ex. M." name="caller_middle_initial">
                  </div>
  
                  <div class="caller_address bg-transparent">
                      <label for="address-input">Address:</label>
                      <input type="text" placeholder="Barangay " name="caller_address">
                  </div>
  
                  <div class="contact bg-transparent">
                      <label for="contact-input">Contact Number:</label>
                      <input type="number" name="contact" placeholder="Phone Number" id="contact-input" oninput="limitNumberLength(this, 11)">
                  </div>
  
                  <div class="age bg-transparent">
                      <label for="age-input">Age:</label>
                      <input type="number" name="age" placeholder="00" id="age-input" oninput="limitNumberLength(this, 2)">
                  </div>
  
                  <script>
                      function limitNumberLength(input, maxLength) {
                          if (input.value.length > maxLength) {
                          input.value = input.value.slice(0, maxLength); // Truncate input to max length
                          }
                          }
                  </script>
          </div>
  
          <div class="responseContainer bg-transparent">
              <h1>RESPONSE DETAILS</h1>
                  <div class="location bg-transparent">
                      <label for="location-select">Location of Incident:</label>
                          <select name="location" id="location-select" required>
                              <option value="" disabled selected>Select Barangay</option>
                              <option value="Barangay I">Barangay I</option>
                              <option value="Barangay II">Barangay II</option>
                              <option value="Barangay III">Barangay III</option>
                              <option value="Barangay IV">Barangay IV</option>
                              <option value="San Agustin">San Agustin</option>
                              <option value="San Antonio">San Antonio</option>
                              <option value="San Bartolome">San Bartolome</option>
                              <option value="San Felix">San Felix</option>
                              <option value="San Fernando">San Fernando</option>
                              <option value="San Francisco">San Francisco</option>
                              <option value="San Isidro Norte">San Isidro Norte</option>
                              <option value="San Isidro Sur">San Isidro Sur</option>
                              <option value="San Joaquin">San Joaquin</option>
                              <option value="San Jose">San Jose</option>
                              <option value="San Juan">San Juan</option>
                              <option value="San Luis">San Luis</option>
                              <option value="San Miguel">San Miguel</option>
                              <option value="San Pablo">San Pablo</option>
                              <option value="San Pedro<">San Pedro</option>
                              <option value="San Rafael">San Rafael</option>
                              <option value="San Roque">San Roque</option>
                              <option value="San Vicente">San Vicente</option>
                              <option value="Santa Ana">Santa Ana</option>
                              <option value="Santa Anastacia">Santa Anastacia</option>
                              <option value="Santa Clara">Santa Clara</option>
                              <option value="Santa Cruz">Santa Cruz</option>
                              <option value="Santa Elena">Santa Elena</option>
                              <option value="Santa Maria">Santa Maria</option>
                              <option value="Santa Teresita">Santa Teresita</option>
                              <option value="Santiago">Santiago</option>
                          </select>
                  </div>
  
                  <div class="specific_location bg-transparent">
                      <label for="specific-input">Specific Location:</label>
                      <input type="text" placeholder=" Sitio / Purok" name="specific_location">
                  </div>
  
                  <div class="incidentType bg-transparent">
                      <p class="bg-transparent">Incident Type</p>
                          <div class="types bg-transparent">
                              <div class="typeList bg-transparent">
                                  <input type="checkbox" id="Medical" name="Medical">
                                  <label for="Medical">Medical</label>
                                  <br>
                                  <input type="checkbox" id="trauma" name="Trauma">
                                  <label for="trauma">Trauma</label>
                                  <br>
                                  <input type="checkbox" id="extrication" name="Extrication">
                                  <label for="extrication">Extrication</label>
                                  <br>
                                  <input type="checkbox" id="cond-trans" name="Cond-trans">
                                  <label for="cond-trans">Conduct/Transport</label>
                                  <br>
                                  <input type="checkbox" id="stanby" name="Stanby">
                                  <label for="stanby">Standby/Assist</label>
                                  <br>
                                  <input type="checkbox" id="pedestrian" name="Pedestrian">
                                  <label for="pedestrian">Pedestrian</label>
                                  <br>
                                  <input type="checkbox" id="missing-person" name="Missing-person">
                                  <label for="missing-person">Missing Person/s</label>
                                  <br>
                                  <input type="checkbox" id="power-outage" name="Power-outage">
                                  <label for="power-outage">Power Outage</label>
                              </div>
  
                              <div class="typeList bg-transparent">
                                  <input type="checkbox" id="self-accident" name="Self-accident">
                                  <label for="self-accident">Self Accident</label>
                                  <br>
                                  <input type="checkbox" id="vehicular-accident" name="Vehicular-accident">
                                  <label for="vehicular-accident">Vehicular Accident</label>
                                  <br>
                                  <input type="checkbox" id="wound-care" name="Wound-care">
                                  <label for="wound-care">Wound Care</label>
                                  <br>
                                  <input type="checkbox" id="crime" name="Crime">
                                  <label for="crime">Crime</label>
                                  <Br>
                                  <input type="checkbox" id="damaged-property" name="Damaged-property">
                                  <label for="damaged-property">Damaged Property</label>
                                  <br>
                                  <input type="checkbox" id="lost-item" name="Fire">
                                  <label for="lost-item">Fire</label>
                                  <br>
                                  <input type="checkbox" id="telco-outage" name="Telco-outage">
                                  <label for="telco-outage">Telco Outage</label>
                                  <br>
                                  <input type="checkbox" id="flooding" name="Flooding">
                                  <label for="flooding">Flooding</label>
                              </div>
                          </div>
                  </div>
  
                  <div class="additional_details bg-transparent">
                      <label for="additional-details">Additional Incident<br>Details:</label>
                      <input type="text" name="additional_details" placeholder="What happened">
                  </div>
  
                  <div class="vehicle_involved bg-transparent">
                        <label for="vehicle_involved">Vehicle/s Involved:</label>
                        <input type="radio" id="vehicle_yes" name="vehicle_involved" value="Vehicle Involved">
                        <label for="vehicle_yes">Yes</label>

                        <input type="radio" id="vehicle_no" name="vehicle_involved" value="No Vehicle Involved">
                        <label for="vehicle_no">No</label>
                    </div>

  
                    <div class="vehicle_type bg-transparent">
                        <label for="">Vehicle Type:</label>
                        <select name="vehicle_type" id="vehicle-type" required>
                        <option value="" disabled selected>Select Vehicle</option>
                              <option value="None">None</option>
                              <option value="Car">Car</option>
                              <option value="Jeepney">Jeepney</option>
                              <option value="Van">Van</option>
                              <option value="Pick-Up">Pick-Up</option>
                              <option value="Motorcycle">Motorcycle</option>
                              <option value="Bus">Bus</option>
                              <option value="Truck">Truck</option>
                              <option value="Large Truck">Large Truck</option>
                              <option value="Large Truck with Trailer">Large Truck with Trailer</option>
                          </select>
                    </div>

                    <script>
                        // Get the radio buttons and the vehicle type div
                        var vehicleYes = document.getElementById('vehicle_yes');
                        var vehicleNo = document.getElementById('vehicle_no');
                        var vehicleTypeDiv = document.querySelector('.vehicle_type');
                        var vehicleTypeSelect = document.getElementById('vehicle-type');

                        // Add event listener to radio buttons
                        vehicleYes.addEventListener('change', toggleVehicleTypeVisibility);
                        vehicleNo.addEventListener('change', toggleVehicleTypeVisibility);

                        // Initial visibility check on page load
                        toggleVehicleTypeVisibility();

                        // Function to toggle the visibility of the vehicle type div
                        function toggleVehicleTypeVisibility() {
                            if (vehicleYes.checked) {
                                // If "Yes" is selected, show the vehicle type div and clear the selected value
                                vehicleTypeDiv.style.display = 'block';
                                vehicleTypeSelect.value = '';
                            } else if (vehicleNo.checked) {
                                // If "No" is selected, hide the vehicle type div and set the value to "None"
                                vehicleTypeDiv.style.display = 'none';
                                vehicleTypeSelect.value = 'None';
                            }
                        }
                    </script>

  
                    <div class="individuals_affected bg-transparent">
                        <label for="">Individuals Affected:</label>

                        <input type="radio" id="individuals_yes" name="individuals_affected" value="Individuals Affected">
                        <label for="individuals_yes">Yes</label>

                        <input type="radio" id="individuals_no" name="individuals_affected" value="No Individuals Affected">
                        <label for="individuals_no">No</label>
                    </div>

                    <div class="number_affected bg-transparent">
                        <label for="number_affected">Number of Affected<br>Individuals:</label>
                        <input type="number" name="number_affected">
                    </div>

                    <div class="individual_status bg-transparent">
                        <label for="individual_status">Status of Individuals:</label>
                        <input type="text" name="individual_status">
                    </div>

                    <script>
                        // Get the radio buttons and the affected sections
                        var individualsYes = document.getElementById('individuals_yes');
                        var individualsNo = document.getElementById('individuals_no');
                        var numberAffectedDiv = document.querySelector('.number_affected');
                        var individualStatusDiv = document.querySelector('.individual_status');
                        var numberAffectedInput = document.querySelector('input[name="number_affected"]');
                        var individualStatusInput = document.querySelector('input[name="individual_status"]');

                        // Add event listener to radio buttons
                        individualsYes.addEventListener('change', toggleAffectedSections);
                        individualsNo.addEventListener('change', toggleAffectedSections);

                        // Initial visibility check on page load
                        toggleAffectedSections();

                        // Function to toggle the visibility of affected sections
                        function toggleAffectedSections() {
                            if (individualsYes.checked) {
                                // If "Yes" is selected, show the affected sections and clear the values
                                numberAffectedDiv.style.display = 'block';
                                individualStatusDiv.style.display = 'block';
                                numberAffectedInput.value = '';
                                individualStatusInput.value = '';
                            } else if (individualsNo.checked) {
                                // If "No" is selected, hide the affected sections and set their values to "None"
                                numberAffectedDiv.style.display = 'none';
                                numberAffectedInput.value = 'None';

                                individualStatusDiv.style.display = 'none';
                                individualStatusInput.value = 'None';
                            }
                        }
                    </script>

        
<div class="action_taken bg-transparent">
    <label for="">Action Taken:</label>

    <input type="radio" id="dispatch" name="action_taken" value="Dispatch">
    <label for="dispatch">Dispatch</label>

    <input type="radio" id="other" name="action_taken" value="Others">
    <label for="other">Others</label>

    <input type="radio" id="both" name="action_taken" value="Both">
    <label for="both">Both</label>

    <div id="othersDetails" class="hidden">
        <label for="others_text">Specify:</label>
        <input type="text" id="others_text" name="action_taken_others">
    </div>
</div>

<script>
    // Get the radio buttons and the text field
    const dispatchRadio = document.getElementById('dispatch');
    const othersRadio = document.getElementById('other');
    const bothRadio = document.getElementById('both');
    const othersDetails = document.getElementById('othersDetails');

    // Add event listeners to the radio buttons
    dispatchRadio.addEventListener('change', handleRadioChange);
    othersRadio.addEventListener('change', handleRadioChange);
    bothRadio.addEventListener('change', handleRadioChange);

    // Function to handle radio button change event
    function handleRadioChange() {
        // Show or hide the text field based on the radio button selection
        if (othersRadio.checked && othersRadio.value === 'Others' || bothRadio.checked) {
            othersDetails.classList.remove('hidden');
        } else {
            othersDetails.classList.add('hidden');
        }

        // Clear the text field value when hiding
        if (!othersDetails.classList.contains('hidden')) {
            document.getElementById('others_text').value = '';
        }

        // Set the value of action_taken based on the selected radio button
        if (dispatchRadio.checked || bothRadio.checked) {
            document.getElementById('others_text').value = '';
        } else if (othersRadio.checked) {
            document.getElementById('others_text').value = '';
        }
    }
</script>
  
                  <div class="verifiedBy bg-transparent">
                      <label for="">Verified/Encoded By:</label>
                  <?php echo isset($_SESSION["fullName"]) ? $_SESSION["fullName"] : "User Full Name Not Available";?>
                  <input type="hidden" name="verified_by" value="<?php echo isset($_SESSION["fullName"]) ? $_SESSION["fullName"] : ""; ?>">
                  </div>
                    
                    
                  <!--<div class="verification_remarks bg-transparent">
                      <label for="verification_remarks">Verification Remarks:</label>
                      <input type="text" name="verification_remarks">
                  </div>-->
  
                  <!--<div class="closedBy bg-transparent">
                  <label for="">Closed By:</label>
                  <?php echo isset($_SESSION["fullName"]) ? $_SESSION["fullName"] : "User Full Name Not Available";?>
                  <input type="hidden" name="closed_by" value="<?php echo isset($_SESSION["fullName"]) ? $_SESSION["fullName"] : ""; ?>">
                  </div>
  
                  <div class="resolution_remarks bg-transparent">
                      <label for="resolution_remarks">Resolution Remarks:</label>
                      <input type="text" name="resolution_remarks">
                  </div>-->
          </div>
  
          <div class="saveBtn bg-transparent" style="padding-bottom: 50px;">
    <button type="button" onclick="openModal()">Save</button>
  </div>

  <div id="confirmationModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal()">&times;</span>
        <h1>.</h1>
      <h3>Confirmation</h3>
      <p>Are you sure you want to save this incident report?</p>
      <button onclick="confirmedSave()">Yes</button><button onclick="closeModal()">No</button>
    </div>
  </div>

  <script>
  function openModal() {
    document.getElementById('confirmationModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('confirmationModal').style.display = 'none';
  }

  function confirmedSave() {
    closeModal();
    document.forms["incidentForm"].submit();
  }
</script>

      </div>    
      
  </form>
  
  <style>
        /*modal ng save*/
        #confirmationModal { 
            display: none; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hidden {
            display: none;
        }

        #others_text {
            border: rgb(151, 151, 151) solid 2px; 
            margin-right: 15%;
            padding-left: 5px
        }

        .modal-content {
            position: flex;
            background-color: transparent;
            border-radius: 10px;
            max-width: 450px;
            width: 100%;
            box-sizing: border-box;

        }

        .modal-content h1 {
            position: absolute;
            margin-top: -20px;
            margin-left: -20px;
            background-color: #173381;
            color: #173381;
            padding: 10px;
            border-top-left-radius: 5px;
        }

        .modal-content h3 {
            margin-top: none;
            background-color: #173381;
            padding: 10px;
            margin-top: -20px;
            color: white;
            font-weight: bold;
            width: 100%;
        
        }

        .modal-content p {
            background-color: transparent;
            padding: 10px;
            
        }

        .close-button {
            background-color: #173381;
            color: white;
            position: absolute;
            top: 0;
            right: 0;
            font-size: 18px;
            cursor: pointer;
            padding: 6px;
            border-top-right-radius: 5px;
        }
        
        button {
            margin-top: 10px;
            
        }

        button:hover {
            background-color: #173381;
        
            color: white;
        }

            body {
                background-color: #173381;
            }


          .incidentContainer {
              background-color: white;
              width: 82%;
              height: 100%;
              position: fixed;
              right: 10px;
              margin-top: 83px;
              border-radius: 15px;
              overflow: auto;
              font-family: 'Mulish', sans-serif;
              padding-bottom: 100px;
              max-height: 95%;    
          }
          
  
          .incidentContainer::-webkit-scrollbar {
                  display: block;
                  width: 10px;
              }
  
              .incidentContainer::-webkit-scrollbar-thumb {
                  background: grey;
                  border-radius: 5px;
              }
  
              .incidentContainer::-webkit-scrollbar-track {
                  background: #173381;
              }
  
              .incidentContainer .header {
              background-color: transparent;
              margin-top: -50px;
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
  
          .header i {
              position: absolute;
              top: 30px;
              right: 10px;
              color: #173381;
              font-size: 25px;
              background-color: transparent;
          }
  
          .detailsContainer {
              background: transparent;
              font-family: 'Mulish', sans-serif;
              margin-top: 10px;
              margin-left: 3%;
              width: 45%;
              height: fit-content;
              border: #173381 2px solid;
              border-radius: 15px;
              text-align: right;
              padding-bottom: 10px;
          }
  
          .detailsContainer h1 {
              font-family: 'Mulish', sans-serif;
              font-weight: 600;
              text-align: left;
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
  
          .detailsContainer label,
          .detailsContainer input,
          .detailsContainer option,
          .detailsContainer select,
          .detailsContainer p{
              background-color: transparent;
              margin-top: 10px;
          }
  
          .detailsContainer p {
              margin-right: 69.7%;
          }
  
          .detailsContainer label {
              margin-right: 50px;
          }
  
          .detailsContainer input,
          .detailsContainer select {
              width: 45%;
              border: rgb(151, 151, 151) solid 2px;
              margin-right: 15%;
              padding-left: 5px;
          }
  
          .callerContainer {
              background: transparent;
              font-family: 'Mulish', sans-serif;
              margin-top: 10px;
              margin-left: 3%;
              width: 45%;
              height: fit-content;
              border: #173381 2px solid;
              border-radius: 15px;
              text-align: right;
              padding-bottom: 10px;
          }
  
          .callerContainer h1 {
              font-family: 'Mulish', sans-serif;
              font-weight: 600;
              text-align: left;
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
  
          .callerContainer label,
          .callerContainer input {
              background-color: transparent;
              margin-top: 10px;
          }
  
          .callerContainer label {
              margin-right: 50px;
          }
  
          .callerContainer input {
              width: 45%;
              border: rgb(151, 151, 151) solid 2px;
              margin-right: 15%;
              padding-left: 5px;
          }
  
          .responseContainer {
              background: transparent;
              font-family: 'Mulish', sans-serif;
              float: right;
              margin-top: -557px;
              margin-right: 3%;
              width: 45%;
              height: fit-content;
              border: #173381 2px solid;
              border-radius: 15px;
              text-align: right;
              padding-bottom: 10px;
              margin-bottom: 5px;
          }
  
          .responseContainer h1 {
              font-family: 'Mulish', sans-serif;
              font-weight: 600;
              text-align: left;
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
  
          .responseContainer label,
          .responseContainer input,
          .responseContainer option,
          .responseContainer select {
              background-color: transparent;
              margin-top: 10px;
          }
  
          .location input,
          .location select,
          .specific_location input,
          .specific_location select,
          .additional_details input,
          .additional_details select,
          .vehicle_type input,
          .vehicle_type select,
          .number_affected input,
          .number_affected select,
          .individual_status input,
          .individual_status select,
          .verification_remarks input,
          .verification_remarks select,
          .resolution_remarks input,
          .resolution_remarks select {
              width: 45%;
              border: rgb(151, 151, 151) solid 2px;
              margin-right: 15%;
              padding-left: 5px;
          }
  
          .responseContainer label {
              margin-right: 50px;
          }
  
          .responseContainer p {
              text-align: center;
              margin-top: 10px;
              font-weight: bold;
          }
  
          .types {
              display: flex;
              flex-wrap: wrap;
              text-align: left;
          }
  
          .typeList {
              margin-top: -10px;
              flex: 1;
              margin-right: 10px;
              margin-left: 10%;
          }
  
          .typeList label {
              margin-left: 10px;
              margin-top: 0;
          }
  
          .additional_details {
              margin-top: 10px;
          }
  
          .vehicle_involved,
          .individuals_affected {
              margin-right: 35%;

          }
          .action_taken{
            margin-right: 27%;
          }
  
  
          .verifiedBy, .closedBy {
              display: inline-block;
              flex: 1; /* This will make each item take equal space */
              margin-right: 300px; /* Adjust the margin as needed */
          }
  
  
  
          .dispatchDetails {
              background: transparent;
              font-family: 'Mulish', sans-serif;
              margin-top: 10px;
              margin-left: 3%;
              width: 45%;
              height: fit-content;
              border: #173381 2px solid;
              border-radius: 15px;
              text-align: right;
              padding-bottom: 10px;
          }
  
          .dispatchDetails h1 {
              font-family: 'Mulish', sans-serif;
              font-weight: 600;
              text-align: left;
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
  
          .dispatchDetails label,
          .dispatchDetails input,
          .dispatchDetails select,
          .dispatchDetails option {
              background-color: transparent;
          }
  
          .dispatchDetails input,
          .dispatchDetails select,
          .dispatchDetails option {
              width: 45%;
              border: rgb(151, 151, 151) solid 2px;
              margin-right: 15%;
              padding-left: 5px;
          }
  
          .dispatchDetails label {
              margin-top: 10px;
              margin-right: 50px;
          }
  
          .addRespo {
              text-align: center;
              margin-top: 15px;
              font-weight: bold;
          }
  
          #openModalBtn {
              background-color: #173381;
              color: white;
              width: 24%;
              border-radius: 15px;
          }
          
          .modal {
              display: none;
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0, 0, 0, 0.7);
          }
  
          .close {
              position: relative;
              margin-right: 10px;
              color: white;
          }
  
          .modal form {
              background: transparent;
              margin-top: 50px;
          }
  
          .bg-header {
              padding: 0;
              margin: -20px;
              width: 105.5%;
              height: 40px;
              background-color: #173381;
          }
  
          .modal h2 {
              position: absolute;
              color: white;
              background: transparent;
              top: 12px;
              left: 45%;
          }
  
          #responderForm input {
              border: 1px black solid;
              width: 300px;
          }
  
          .modal-content {
              background-color: #fff;
              margin: 10% auto;
              padding: 20px;
              border: 1px solid #888;
              border-radius: 5px;
              width: 50%;
          }
  
          .close {
              position: absolute;
              top: -3px;
              right: 0;
              padding: 10px;
              cursor: pointer;
              background-color: transparent;
          }
  
          /* Container Styles */
          .info-container {
              margin-top: 20px;
              padding: 10px;
              border: 1px solid #888;
              border-radius: 5px;
              background-color: transparent;
              display: none;
          }
  
          .actionDetails {
              background: transparent;
              font-family: 'Mulish', sans-serif;
              margin-top: 10px;
              margin-left: 3%;
              width: 45%;
              height: fit-content;
              border: #173381 2px solid;
              border-radius: 15px;
              text-align: right;
              padding-bottom: 10px;
          }
  
          .actionDetails h1 {
              font-family: 'Mulish', sans-serif;
              font-weight: 600;
              text-align: left;
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
  
          .actionDetails select,
          .actionDetails input {
              background-color: transparent;
              width: 45%;
              border: rgb(151, 151, 151) solid 2px;
              margin-right: 15%;
              padding-left: 5px;
          }
  
          .actionDetails label {
              background-color: transparent;
              margin-top: 10px;
              margin-right: 50px;
          }
  
          .saveBtn button {
              background-color: #173381;
              position: absolute;
              bottom: -43%;
              right: 3%;
              width: 7%;
              color: white;
              font-size: 15px;
              border-radius: 15px;
              padding: 10px;
          }
  
          @media screen and (max-width: 1555px) and (min-width: 320px) {
            .incidentContainer {
                width: 98.5%;
                height: 100%;
                height: fit-content;
                padding-bottom: 50px;
            }

            .incidentContainer .header img {
                display: block;
            }

            .incidentContainer .header {
                margin-top: 30px;
            }

            .detailsContainer,
            .callerContainer {
                width: 94%;
            }

            .responseContainer {
                width: 94%;
                float: none;
                margin: 10px auto;
            }

            .vehicle_involved,
            .individuals_affected {
                margin-right: 35.5%;
            }

            .action_taken {
                margin-left: 20%;
            }

            .verifiedBy {
                margin-right: 40%;
        
            }

            #othersDetails {
                margin-left: 30%;
            }

            .saveBtn button {
                position: absolute;
                bottom: -900px;
            }
          }

          @media screen and (max-width: 1619px) and (min-width: 1556px) {
            .verifiedBy {
                float: right;
            }
          }

          @media screen and (max-width: 1950px) and (min-width: 1620px) {
            .incidentContainer {
            min-width: 85.4%;
            height: 100%;
            }

            .responseContainer {
                margin-top: -535px;
            }

            .saveBtn button {
                bottom: -9%;
            }
        }
  
      </style>
  </body>
  </html>