<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include('config.php');

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $dbname);

$selectedIncidentID = isset($_GET['id']) ? $_GET['id'] : null;

if ($selectedIncidentID !== null) {
    // Example query, replace with your actual query to retrieve data
    $query = "SELECT * FROM incidents WHERE id = $selectedIncidentID";

    // Execute the query and fetch the result
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $incidentID = $row['Incident_ID'];
        $response = $row['response'];
        $departure=$row['departure'];
        $arrival=$row['arrival'];
        $dept = $row['dept'];
        $base = $row['base'];
        $level = $row['level'];
        $person = $row['person'];
        $co_number = $row['co_number'];
        $last = $row['last'];
        $first = $row['first'];
        $middle = $row['middle'];
        $brand = $row['brand'];
        $vehicle = $row['vehicle'];
        $others = $row['others'];
        $platenumber = $row['platenumber'];
        $ln = $row['ln'];
        $fn = $row['fn'];
        $mi = $row['mi'];
        $severity = $row['severity'];
        $other = $row['other'];
        $atd = $row['atd'];
        $victim_ln = $row['victim_ln'];
        $victim_fn = $row['victim_fn'];
        $victim_mi = $row['victim_mi'];
        $victim_age = $row['victim_age'];
        $victim_gender = $row['victim_gender'];
        $victim_address = $row['victim_address'];
        $victim_status = $row['victim_status'];
        $victim_item = $row['victim_item'];
        $victim_ln2 = $row['victim_ln2'];
        $victim_fn2 = $row['victim_fn2'];
        $victim_mi2 = $row['victim_mi2'];
        $victim_age2 = $row['victim_age2'];
        $victim_gender2 = $row['victim_gender2'];
        $victim_address2 = $row['victim_address2'];
        $victim_status2 = $row['victim_status2'];
        $victim_item2 = $row['victim_item2'];
        $othervictims1= $row['othervictims1'];
        $othervictims2= $row['othervictims2'];
        $other_dispatch= $row['other_dispatch'];
        $leader_fullname = $row['leader_fullname'];
        $driver_fullname = $row['driver_fullname'];
        $nurse_fullname = $row['nurse_fullname'];
        $emt_fullname = $row['emt_fullname'];
        $fileInput = $row['fileInput'];
        $fileInput2 = $row['fileInput2'];
    }
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
<form action="save_ems.php<?php echo isset($_GET['id']) ? '?id=' . $_GET['id'] : ''; ?>" method="post" onsubmit="return confirmSave()" enctype="multipart/form-data">

    <div class="emsContainer">
        <div class="header">
            <img src=".\Image\logo.jpg" alt="" style="height: 75px; width: 75px; background-color: transparent; 
            position: absolute; left: 34%; top: 3%;">
            <img src=".\Image\aksyon.png" alt="" style="background-color: transparent; height: 75px;
            width: 150px; position: absolute; top: 2%; left: 59%;">
            <div class="text1">REPPUBLIC OF THE PHILIPPINES<br>PROVINCE OF BATANGAS</div>
            <div class="text2">CITY OF STO. TOMAS</div>
            <div class="text3">CITY DISASTER RISK REDUCTION AND MANAGEMENT OFFICE</div>
            <div class="text4">SPOT REPORT: EMERGENCY MEDICAL SERVICE</div>
            <?php
            $selectedIncidentID = isset($_GET['id']) ? $_GET['id'] : null;
            ?>

            <div class="responseContainer">
                <h1>RESPONSE DETAILS</h1>

                    <div class="incidentIdContainer">
                        Incident ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo isset($incidentID) ? $incidentID : 'N/A'; ?>
                    </div>

                    <div class="response-date bg-transparent">
                    <label for="date">Response Date:</label>
                    <input type="date" name="response" id="date" value="<?php echo isset($response) ? $response : 'N/A'; ?>">
                    </div>


                    <div class="departure bg-transparent">
                        <label for="departure">Departure from Base:</label>
                        <input type="time" name="departure" id="departure" step="1" value="<?php echo isset($departure) ? $departure : 'N/A'; ?>">
                    </div>

                    <div class="arrival bg-transparent">
                        <label for="arrival">Arrival at Destination:</label>
                        <input type="time" name="arrival" step="1" value="<?php echo isset($arrival) ? $arrival : 'N/A'; ?>">
                    </div>

                    <div class="departure-des bg-transparent">
                        <label for="dept">Departure from Destination:</label>
                        <input type="time" name="dept" step="1" value="<?php echo isset($dept) ? $dept : 'N/A'; ?>">
                    </div>

                    <div class="arrival-base bg-transparent">
                        <label for="base">Arrival at Base:</label>
                        <input type="time" name="base" step="1" value="<?php echo isset($base) ? $base : 'N/A'; ?>">
                    </div>
            </div>

            <div class="incidentContainer">
                <h1>INCIDENT DETAILS</h1>
                <div class="level bg-transparent">
                    <label>Incident Severity Level:</label>
                    <input type="radio" id="Minor" name="level" value="Minor" <?php echo isset($level) && $level === 'Minor' ? 'checked' : ''; ?>>
                    <span>Minor</span>
                    <input type="radio" id="Major" name="level" value="Major" <?php echo isset($level) && $level === 'Major' ? 'checked' : ''; ?>>
                    <span>Major</span>
                </div>

                    <div class="contact-person bg-transparent">
                        <label for="contact">Contact Person:</label>
                        <input type="text" name="person" placeholder="Surname, Firstname MI." value="<?php echo isset($person) ? $person : ''; ?>">
                    </div>

                    <div class="contact-number bg-transparent">
                        <label for="number">Contact Number:</label>
                        <input type="number" name="co_number" placeholder="Phone number" id="contact-input" value="<?php echo isset($co_number) ? $co_number : ''; ?>" oninput="limitNumberLength(this, 11)">
                    </div>
                    <script>
                      function limitNumberLength(input, maxLength) {
                          if (input.value.length > maxLength) {
                          input.value = input.value.slice(0, maxLength); // Truncate input to max length
                          }
                          }
                  </script>
                    
            </div>

            <div class="victimContainer">
                <h1>VICTIM/PATIENT DETAILS</h1>
                <label for=""
                style="margin-right: 68%; font-weight: bold;">VICTIM 1</label>
                    <div class="victim-ln">
                    <label for="">Lastname:</label>
                    <input type="text" name="victim_ln" oninput="capitalizeFirstLetter(this)" value="<?php echo isset($victim_ln) ? $victim_ln : ''; ?>">
                </div>

                    <div class="victim-fn">
                        <label for="">Firstname:</label>
                        <input type="text" name="victim_fn" oninput="capitalizeFirstLetter(this)" value="<?php echo isset($victim_fn) ? $victim_fn : ''; ?>">
                    </div>

                    <div class="victim-mi">
                        <label for="">Middle Initial:</label>
                        <input type="text" name="victim_mi" oninput="capitalizeFirstLetter(this)" value="<?php echo isset($victim_mi) ? $victim_mi : ''; ?>">
                    </div>

                    <div class="victim-age">
                        <label for="age-input">Age:</label>
                      <input type="number" name="victim_age" id="age-input" value="<?php echo isset($victim_age) ? $victim_age : ''; ?>" oninput="limitNumberLength(this, 2)">
                    </div>
                    <script>
                      function limitNumberLength(input, maxLength) {
                          if (input.value.length > maxLength) {
                          input.value = input.value.slice(0, maxLength); // Truncate input to max length
                          }
                          }
                  </script>

                <div class="victim-gender">
                    <label for="">Gender:</label>
                    <input type="radio" name="victim_gender" id="Male" value="Male" <?php echo isset($victim_gender) && $victim_gender === 'Male' ? 'checked' : ''; ?>>
                    <span>Male</span>
                    <input type="radio" name="victim_gender" id="Female" value="Female" <?php echo isset($victim_gender) && $victim_gender === 'Female' ? 'checked' : ''; ?>>
                    <span>Female</span>
                </div>


                    <div class="victim-address">
                        <label for="">Address:</label>
                        <input type="text" name="victim_address" value="<?php echo isset($victim_address) ? $victim_address : ''; ?>">
                        
                    </div>

                    <div class="victim-status">
                        <label for="">Status:</label>
                        <input type="text" name="victim_status"  value="<?php echo isset($victim_status) ? $victim_status : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="victim-items">
                        <label for="">Personal Item/s<br>Recovered on Site:</label>
                        <input type="text" name="victim_item" value="<?php echo isset($victim_item) ? $victim_item : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>
                    <div class="victim-items2">
                        <label for="">Other Victims</label>
                        <input type="text" name="othervictims1" value="<?php echo isset($othervictims1) ? $othervictims1 : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>
            </div>

            <div class="victimContainer2">
                <h1>VICTIM/PATIENT DETAILS</h1>
                <label for=""
                style="margin-right: 68%; font-weight: bold;">VICTIM 2</label>
                    <div class="victim-ln2">
                        <label for="">Lastname:</label>
                        <input type="text" name="victim_ln2" value="<?php echo isset($victim_ln2) ? $victim_ln2 : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="victim-fn2">
                        <label for="">Firstname:</label>
                        <input type="text" name="victim_fn2" value="<?php echo isset($victim_fn2) ? $victim_fn2 : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="victim-mi2">
                        <label for="">Middle Initial:</label>
                        <input type="text" name="victim_mi2" value="<?php echo isset($victim_mi2) ? $victim_mi2 : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="victim-age2">
                        <label for="">Age:</label>
                        <input type="number" name="victim_age2"id="age-input" value="<?php echo isset($victim_age2) ? $victim_age2 : ''; ?>" oninput="limitNumberLength(this, 2)">
                    </div>
                    <script>
                      function limitNumberLength(input, maxLength) {
                          if (input.value.length > maxLength) {
                          input.value = input.value.slice(0, maxLength);
                          }
                          }
                  </script>

                    <div class="victim-gender2">
                        <label for="">Gender:</label>
                        <input type="radio" name="victim_gender2" id="genderM" value= "Male" <?php echo isset($victim_gender2) && $victim_gender2 ==='Male' ? 'checked' : ''; ?>>
                        <span>Male</span>
                        <input type="radio" name="victim_gender2" id="genderF" value= "Female" <?php echo isset($victim_gender2) && $victim_gender2 === 'Female' ? 'checked' : ''; ?>>
                        <span>Female</span>
                    </div>

                    <div class="victim-address2">
                        <label for="">Address:</label>
                        <input type="text" name="victim_address2" value="<?php echo isset($victim_address2) ? $victim_address2 : ''; ?>" oninput="capitalizeFirstLetter(this)">
                       
                    </div>

                    <div class="victim-status2">
                        <label for="">Status:</label>
                        <input type="text" name="victim_status2" value="<?php echo isset($victim_status2) ? $victim_status2 : ''; ?>">
                    </div>

                    <div class="victim-items2">
                        <label for="">Personal Item/s<br>Recovered on Site:</label>
                        <input type="text" name="victim_item2" value="<?php echo isset($victim_item2) ? $victim_item2 : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="victim-items2">
                        <label for="">Other Victims</label>
                        <input type="text" name="othervictims2" value="<?php echo isset($othervictims2) ? $othervictims2 : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>
            </div>

            <div class="vehicleContainer">
                <h1>VEHICLE AND DRIVER DETAILS</h1>
                    <div class="last-name bg-transparent">
                        <label for="last-name">Owner`s Last Name:</label>
                        <input type="text" name="last" value="<?php echo isset($last) ? $last : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="first-name bg-transparent">
                        <label for="first-name">Owner`s First Name:</label>
                        <input type="text" name="first" value="<?php echo isset($first) ? $first : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="middle-initial bg-transparent">
                        <label for="middle-initial">Owner`s Middle Initial:</label>
                        <input type="text" name="middle" value="<?php echo isset($middle) ? $middle : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="car-brand bg-transparent">
                        <label for="brand">Brand of Car:</label>
                        <input type="text" name="brand" value="<?php echo isset($brand) ? $brand : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="vehicle-type bg-transparent">
                    <label for="vehicle-type">Vehicle Type:</label>
                    <select name="vehicle" id="vehicle-type">
                        <option value="" disabled <?php echo empty($vehicle) ? 'selected' : ''; ?>>Choose Vehicle Type</option>
                        <option value="Car" name="vehicle" <?php echo ($vehicle === 'Car') ? 'selected' : ''; ?>>Car</option>
                        <option value="Jeepney" name="vehicle" <?php echo ($vehicle === 'Jeepney') ? 'selected' : ''; ?>>Jeepney</option>
                        <option value="Van" name="vehicle" <?php echo ($vehicle === 'Van') ? 'selected' : ''; ?>>Van</option>
                        <option value="Pick-Up" name="vehicle" <?php echo ($vehicle === 'Pick-Up') ? 'selected' : ''; ?>>Pick-Up</option>
                        <option value="Motorcycle" name="vehicle" <?php echo ($vehicle === 'Motorcycle') ? 'selected' : ''; ?>>Motorcycle</option>
                        <option value="Bus" name="vehicle" <?php echo ($vehicle === 'Bus') ? 'selected' : ''; ?>>Bus</option>
                        <option value="Truck" name="vehicle" <?php echo ($vehicle === 'Truck') ? 'selected' : ''; ?>>Truck</option>
                        <option value="Large Truck" name="vehicle" <?php echo ($vehicle === 'Large Truck') ? 'selected' : ''; ?>>Large Truck</option>
                        <option value="Large Truck with Traile" name="vehicle" <?php echo ($vehicle === 'Large Truck with Traile') ? 'selected' : ''; ?>>Large Truck with Trailer</option>
                    </select>
                </div>


                    <div class="others bg-transparent">
                        <input type="text" id="others" name="others" placeholder="Other vehicle" value="<?php echo isset($others) ? $others : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="plate-number bg-transparent">
                        <label for="plate-number">Plate Number:</label>
                        <input type="text" id="plate-number"  name="platenumber" value="<?php echo isset($platenumber) ? $platenumber : ''; ?>">
                    </div>

                    <div class="driver-name bg-transparent">
                        <label for="driver-name">Driver`s Name:</label>
                        <!--<input type="radio" id="if" value="if" name="drivername"> //babaguhin else show n hide
                        <span>Same as above</span>
                        <input type="radio" id="else" value="else" name="drivername">
                        <span>Else</span>-->
                    </div>

                    <div class="driver-ln bg-transparent">
                        <label for="driver-ln">Last Name:</label>
                        <input type="text" id="dl-name" name="ln" value="<?php echo isset($ln) ? $ln : ''; ?>"  oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="driver-fn bg-transparent">
                        <label for="driver-fn">First Name:</label>
                        <input type="text" id="df-name" name="fn" value="<?php echo isset($fn) ? $fn : ''; ?>"oninput="capitalizeFirstLetter(this)" >
                    </div>

                    <div class="driver-mn bg-transparent">
                        <label for="driver-mn">Middle Initial:</label>
                        <input type="text" id="dm-name" name="mi" value="<?php echo isset($mi) ? $mi : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>
            </div>

    <div class="operationContainer">
        <h1>OPERATION DETAILS</h1>
            <div class="severity-level bg-transparent">
            <label for="severity-level">Action Taken:</label>
                <input type="radio" id="rescue" value="Rescue Patient" name="severity" <?php echo (isset($severity) && $severity === 'Rescue Patient') ? 'checked' : ''; ?>>
                <span>Rescue Patient</span>
                <input type="radio" id="assess" value="Assess Patient" name="severity" <?php echo (isset($severity) && $severity === 'Assess Patient') ? 'checked' : ''; ?>>
                <span>Assess Patient</span><br>
                <input type="radio" id="transport" value="Transport Patient to" name="severity" <?php echo (isset($severity) && $severity === 'Transport Patient to') ? 'checked' : ''; ?>>
                <span>Transport Patient to</span>
                <input type="text" placeholder="Other Action Taken" id="other" name="other" value="<?php echo isset($other) ? $other : ''; ?>">
        </div>


                    <div class="action-details bg-transparent">
                        <label for="action-details">Action Taken Details:</label>
                        <input type="text" id="action-details" placeholder="ex. First aid"  name="atd" value="<?php echo isset($atd) ? $atd : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                   <!--<div class="dispatch-team bg-transparent">
                        <label for="dispatch-team">Dispatch Team:</label>
                        <input type="radio" id="dispatch-yes" value="yes" name="yesorno">
                        <span>Yes</span>
                        <input type="text" id="yes-placeholder" name="text">
                        <br>
                        <input type="radio" id="dispatch-no" value="no" name="yesorno">
                        <span>No</span>
                     <input name="no" id="no-placeholder" name="text">
                    </div>-->

                    <!--<div class="tl-name bg-transparent">
                        <label for="tl-name">Team Leader`s Name:</label>
                        <input type="text" id="tl-name" name="leadername">
                    </div>-->

                    <div class="upload-file">
                        <label>Pre-Hospital<br>Patient care Report:</label>
                        <input type="file" id="fileInput" name="fileInput" accept=".jpg, .jpeg, .png" onchange="displayFileName('fileInput', 'file-name-1')">
                        <div class="file-name" id="file-name-1"><?php echo isset($fileInput) ? basename($fileInput) : 'No file chosen'; ?></div>
                    </div>

                    <div class="upload-photo">
                        <label for="">Image Incident:</label>
                        <input type="file" id="fileInput2" name="fileInput2" accept=".jpg, .jpeg, .png" onchange="displayFileName('fileInput2', 'file-name-2')">
                        <div class="file-name" id="file-name-2"><?php echo isset($fileInput2) ? basename($fileInput2) : 'No file chosen'; ?></div>
                    </div>

                    <script>
                        function displayFileName(inputId, fileNameContainerId) {
                            var input = document.getElementById(inputId);
                            var fileNameContainer = document.getElementById(fileNameContainerId);

                            if (fileNameContainer) {
                                fileNameContainer.innerText = input.files.length > 0 ? input.files[0].name : fileNameContainer.innerText;
                            }
                        }
                    </script>
                    
            </div>

            <div class="dispatchContainer">
                <h1>DISPATCH TEAM</h1>
                    <div class="dispatchTL">
                        <label for="">Team Leader's Name:</label>
                        <input type="text" name="leader_fullname" placeholder="Surname, Firstname MI." value="<?php echo isset($leader_fullname) ? $leader_fullname: ''; ?>" oninput="capitalizeFirstLetter(this)" >
                    </div>

                    <div class="dispatch-ln">
                        <label for="">Driver's Name:</label>
                        <input type="text" name="driver_fullname" placeholder="Surname, Firstname MI." value="<?php echo isset($driver_fullname) ? $driver_fullname: ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="dispatch-ln">
                    <label for="">Nurse's Name:</label>
                        <input type="text" name="nurse_fullname" placeholder="Surname, Firstname MI." value="<?php echo isset($nurse_fullname) ? $nurse_fullname: ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="dispatch-ln">
                        <label for="">EMT's Name:</label>
                        <input type="text" name="emt_fullname" placeholder="Lastname, Firstname MI." value="<?php echo isset($emt_fullname) ? $emt_fullname : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>

                    <div class="dispatch-ln">
                        <label for="">Other Dispatch:</label>
                        <input type="text" name="other_dispatch" value="<?php echo isset($other_dispatch) ? $other_dispatch : ''; ?>" oninput="capitalizeFirstLetter(this)">
                    </div>
                    
            </div>
            <a id="back-button" href="incident-list.php" class="btn btn-primary">Back</a>
            <button id="submitBtn" type="submit" class="btn btn-primary" name="submit">Submit</button>
             
            <script>
                function confirmSave() {
                    return confirm("Are you sure you want to save this incident report?");
                }
            </script>
            <script>
        function capitalizeFirstLetter(input) {
            input.value = input.value.charAt(0).toUpperCase() + input.value.slice(1);
        }
    </script>
    </form>
</div>


    <style>
        body {
            background-color: #173381;
        }

        .emsContainer {
            background-color: white;
            width: 82%;
            height: 95%;
            position: fixed;
            right: 10px;
            margin-top: 83px;
            border-radius: 15px;
            overflow: scroll;
            padding-bottom: 50px;
        }

        .emsContainer::-webkit-scrollbar {
            display: block;
            width: 10px;
        }

        .emsContainer::-webkit-scrollbar-thumb {
            background: white;
            border-radius: 5px;
        }

        .emsContainer::-webkit-scrollbar-track {
            background: #173381;
        }

        .header {
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

        .printLogo i {
            position: absolute;
            top: 30px;
            right: 10px;
            color: #173381;
            font-size: 25px;
            background-color: transparent;
        }

        .responseContainer {
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

        .responseContainer label {
            background-color: transparent;
            margin-right: 50px;
            margin-top: 10px;
        }

        .incidentIdContainer {
            margin-right: 40%;
            margin-top: 10px;
        }
        
        .responseContainer input {
            background-color: transparent;
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .incidentContainer {
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

        .incidentContainer h1 {
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

        .incidentContainer label,
        .incidentContainer span {
            background-color: transparent;
            margin-top: 10px;
            margin-right: 50px;
        }

        .contact-person input,
        .contact-number input,
        .contact-ln input,
        .contact-fn input {
            background-color: transparent;
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .level label {
            margin-right: 10.8%;
        }

        .level {
            margin-right: 24%;
        }

        .status {
            margin-right: 13%;
        }

        .maleFemale {
            margin-right: 15%;
        }

        .victimContainer {
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

        .victimContainer h1 {
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

        .victimContainer label,
        .victimContainer span {
            background-color: transparent;
            margin-top: 10px;
            margin-right: 50px;
        }

        .victim-age input,
        .victim-address input,
        .victim-ln input,
        .victim-fn input,
        .victim-mi input,
        .victim-status input,
        .victim-items input {
            background-color: transparent;
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .victimContainer label {
            margin-right: 10.8%;
        }

        .victim-gender {
            margin-right: 16%;
        }

        .victimContainer2 {
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

        .victimContainer2 h1 {
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

        .victimContainer2 label,
        .victimContainer2 span {
            background-color: transparent;
            margin-top: 10px;
            margin-right: 50px;
        }

        .victim-age2 input,
        .victim-address2 input,
        .victim-ln2 input,
        .victim-fn2 input,
        .victim-mi2 input,
        .victim-status2 input,
        .victim-items2 input {
            background-color: transparent;
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .victimContainer2 label {
            margin-right: 10.8%;
        }

        .victim-gender2 {
            margin-right: 16%;
        }

        .vehicleContainer {
            background: transparent;
            font-family: 'Mulish', sans-serif;
            margin-top: -1325px;
            margin-right: 3%;
            float: right;
            width: 45%;
            height: fit-content;
            border: #173381 2px solid;
            border-radius: 15px;
            text-align: right;
            padding-bottom: 10px;
        }

        .vehicleContainer h1 {
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

        .vehicleContainer label,
        .vehicleContainer span,
        .vehicleContainer select,
        .vehicleContainer option,
        .vehicleContainer input {
            background-color: transparent;
            margin-top: 10px;
        }

        .vehicleContainer input[type="text"],
        .vehicleContainer select {
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .vehicleContainer input[type="radio"] {
            margin-left: 20px;
        }

        .vehicleContainer label {
            margin-right: 50px;
        }

        .driver-name {
            margin-right: 55%;
        }

        .driver-name input {
            margin-right: 2%;
        }

        .dispatchContainer {
            background: transparent;
            font-family: 'Mulish', sans-serif;
            margin-top: -370px;
            float: right;
            margin-right: 3%;
            width: 45%;
            height: fit-content;
            border: #173381 2px solid;
            border-radius: 15px;
            text-align: right;
            padding-bottom: 10px;
        }

        .dispatchContainer h1 {
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

        .file-name {
            text-align: center;
            margin-left: 60px;
            margin-top: 10px;
        }

        .dispatchContainer label,
        .dispatchContainer span {
            background-color: transparent;
            margin-top: 10px;
            margin-right: 50px;
        }

        .dispatchTL input,
        .dispatch-fn input,
        .dispatch-mi input,
        .dispatch-ln input {
            background-color: transparent;
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .dispatchContainer span {
            margin-top: 20px;
            font-weight: bold;
            margin-right: 65%;
        }
       
        .operationContainer {
            background: transparent;
            font-family: 'Mulish', sans-serif;
            margin-top: -850px;
            margin-right: 3%;
            float: right;
            width: 45%;
            height: fit-content;
            border: #173381 2px solid;
            border-radius: 15px;
            text-align: right;
            padding-bottom: 10px;
        }

        .operationContainer h1 {
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

        .operationContainer label,
        .operationContainer span,
        .operationContainer input {
            background-color: transparent;
            margin-top: 10px;
        }

        .operationContainer label {
            margin-right: 50px;
        }

        .operationContainer input[type="text"] {
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .operationContainer input[type="checkbox"],
        .severity-level {
            text-align: left;
            margin-left: 5%;
        }

        .severity-level label {
            margin-right: 40px;
        }

        #transport {
            margin-left: 42%;
        }

        #other {
            margin-left: 41.8%;
            width: 220px;
        }

        #no-placeholder {
            width: 45%;
            border: rgb(151, 151, 151) solid 2px;
            margin-right: 10%;
            padding-left: 5px;
        }

        .upload-file {
            margin-right: 1.5%;
        }

        .upload-file input {
            cursor: pointer;
            border: 2px black dashed;
            padding: 30px;
            width: 300px;
        }

        .upload-photo {
            margin-right: 1.5%;
        }

        .upload-photo input {
            cursor: pointer;
            border: 2px black dashed;
            padding: 30px;
            width: 300px;
        }

        .dispatch-team label {
            margin-right: 0;
        }

        #back-button {
            margin-top: 10px;
            margin-left: 3%;
            background-color: #173381;
        }

        #submitBtn {
            float: right;
            margin-top: 10px;
            margin-right: 3%;
            background-color: #173381;
        }
        
        
        @media screen and (max-width: 1555px) and (min-width: 320px) {
            .emsContainer {
                width: 98%;
            }
            
            .emsContainer .header img {
                display: block;
            }

            .text1 {
                margin-top: px;
            }

            .incidentContainer .header {
                margin-top: 30px;
            }

            .responseContainer,
            .incidentContainer,
            .victimContainer,
            .victimContainer2,
            .dispatchContainer {
                width: 94%;
            }

            .vehicleContainer,
            .operationContainer {
                width: 94%;
                float: none;
                margin-top: 10px;
                margin-left: 3%;
            }

            .severity-level label {
                margin-left: 20%;
            }

            .upload-file,
            .upload-photo {
                margin-right: 32.5%;
            }

            .dispatchContainer {
                float: none;
                margin-top: 10px;
                margin-left: 3%;
            }
        }

        @media screen and (max-width: 1619px) and (min-width: 1551px) {
            .vehicleContainer {
                margin-top: -1277px;
            }

        }

       @media screen and (max-width: 1950px) and (min-width: 1620px) {
            .emsContainer {
                width: 85.4%;
            }
        
  

            .upload-file,
            .upload-photo {
                margin-right: 13%;
            }

            .severity-level label {
                margin-right: 30px;
                margin-left: 125px;
            }

            .victim-gender {
                margin-right: 25.5%;
            }

            .victim-gender2 {
                margin-right: 25.5%;
            }
        }
    </style>
</body>
</html>