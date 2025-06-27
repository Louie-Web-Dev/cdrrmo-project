<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
    <form method="post">
    <div class="response-container">
    <h1>RESPONSE DETAILS</h1>

    <div class="response-date">
        <label for="date">Response Date:</label>
        <input type="date" name="response">
    </div>

    <div class="departure">
        <label for="departure">Departure from Base:</label>
        <input type="time" name="departure">
    </div>

    <div class="arrival">
        <label for="arrival">Arrival at Destination:</label>
        <input type="time" name="arrival">
    </div>

    <div class="departure-des">
        <label for="dept">Departure from Destination:</label>
        <input type="time" name="dept">
    </div>

    <div class="arrival-base">
        <label for="base">Arrival at Base:</label>
        <input type="time" name="base">
    </div>
</div>

    <div class="incident-container">
    <h1>INCIDENT DETAILS</h1>

    <div class="level">
        <label for="level">Incident Severity Level: </label>
            <input type="checkbox" id="Minor" name="level" value="Minor">
            <span>Minor</span>
            <input type="checkbox" id="Major" name="level" value="Major">
            <span>Major</span>
    </div>

    <div class="contact-person">
        <label for="contact">Contact Person:</label>
        <input type="text" name="person">
    </div>

    <div class="contact-number">
        <label for="number">Contact Number:</label>
        <input type="number" name="number">
    </div>

    <h1>Enter Victim Information</h1>
    <div class="contact-person">
        <label for="lastname">Lastname:</label>
        <input type="text" name="lastname">
    </div>

    <div class="contact-number">
        <label for="firstname">Firstname:</label>
        <input type="text" name="firstname">
    </div>
    <div class="level">
        <label for="level">Incident Severity Level: </label>
            <input type="radio" id="active" name="svl" value="active">
            <span>=active</span>
            <input type="radio"id="inactive" name="svl" value="inactive ">
            <span>inactive</span>
    </div>
    <label for="gender">Gender:</label>
                <input type="radio" id="male" name="gender" value="Male"><span class="male">Male</span>
                <input type="radio" id="female" name="gender" value="Female"><span class="female">Female</span><br><br>

                <h1>VEHICLE & DRIVER DETAILS</h1>

<div class="last-name">
    <label for="last-name">Owner`s Last Name:</label>
    <input type="text" name="last">
</div>

<div class="first-name">
    <label for="first-name">Owner`s First Name:</label>
    <input type="text" name="first">
</div>

<div class="middle-initial">
    <label for="middle-initial">Owner`s Middle Initial:</label>
    <input type="text" name="middle">
</div>

<div class="car-brand">
    <label for="brand">Brand of Car:</label>
    <input type="text" name="brand">
</div>

<div class="vehicle-type">
    <label for="vehicle-type">Vehicle Type:</label>   
    <select name="vehicle" id="vehicle-type">
        <option value="Car" name="vehicle">Car</option>
        <option value="Jeepney" name="vehicle">Jeepney</option>
        <option value="Van" name="vehicle">Van</option>
        <option value="Pick-Up" name="vehicle">Pick-Up</option>
        <option value="Motorcycle" name="vehicle">Motorcycle</option>
        <option value="Bus" name="vehicle">Bus</option>
        <option value="Truck" name="vehicle">Truck</option>
        <option value="Large Truch" name="vehicle">Large Truch</option>
        <option value="Large Truck with Trailer" name="vehicle">Large Truck with Trailer</option>
    </select>

    <div class="others">
        <input type="text" id="others" name="others" placeholder="Others">
    </div>
</div>

<div class="plate-number">
    <label for="plate-number">Plate Number:</label>
    <input type="text" id="plate-number" name="platenumber">
</div>

<div class="driver-name">
    <label for="driver-name">Driver`s Name:</label>

    <input type="radio" id="if" value="if" name="drivername">
    <span>Same as above</span>

    <input type="radio" id="else" value="else" name="drivername">
    <span>Else</span>

    <div class="dl-name">
        <label for="dl-name">Last Name:</label>
        <input type="text" id="dl-name" name="ln">
    </div>

    <div class="df-name">
        <label for="df-name">First Name:</label>
        <input type="text" id="df-name" name="fn">
    </div>

    <div class="dm-name">
        <label for="dm-name">Middle Initial:</label>
        <input type="text" id="dm-name" name="mi">
    </div>
</div>

</div> 
<h1>OPERATION DETAILS</h1>

        <div class="severity-level">
            <label for="severity-level">Incident Severity Level:</label>

            <input type="checkbox" id="rescue" value="Rescue Patient" name="severity">
            <span>Rescue Patient</span>
            <input type="checkbox" id="assess" value="Assess Patient" name="severity">
            <span>Assess Patient</span>
            <input type="checkbox" id="transport"value="Transport Patient to"  name="severity">
            <span>Transport Patient to</span>
            <input type="checkbox" id="other-actions" value="Other Actions" name="severity">
            <span>Other Actions</span>
            <input type="text" placeholder="Other" id="other" name="other">
        </div>
        <div class="action-details">
            <label for="action-details">Action Taken Details:</label>
            <input type="text" id="action-details" name="atd">
        </div>
        <div class="dispatch-team">
            <label for="dispatch-team">Dispatch Team:</label>

            <input type="radio" id="dispatch-yes" value="yes" name="yesorno">
            <span>Yes</span>
            <input type="text" id="yes-placeholder" name="text">
            <br>
            <input type="radio" id="dispatch-no" value="no" name="yesorno">
            <span>No</span>
            <input name="no" id="no-placeholder" name="text">
              
        </div>
        <div class="tl-name">
            <label for="tl-name">Team Leader`s Name:</label>
            <input type="text" id="tl-name" name="leadername">
        </div>
    </div>

</div>
<button type="submit" class="btn btn-primary" name="submit">Submit</button>


  
</form>
    </div>

<?php
 include 'connect.php';
 if(isset($_POST['submit'])){
    $response=$_POST['response'];
    $departure=$_POST['departure'];
    $arrival=$_POST['arrival'];
    $dept=$_POST['dept'];
    $base=$_POST['base'];
    $level=$_POST['level'];
    $person=$_POST['person'];
    $number=$_POST['number'];
    $lastname=$_POST['lastname'];
    $firstname=$_POST['firstname'];
    $svl=$_POST['svl'];
    $gender=$_POST['gender'];
    $last=$_POST['last'];
    $first=$_POST['first'];
    $middle=$_POST['middle'];
    $brand=$_POST['brand'];
    $vehicle=$_POST['vehicle'];
    $others=$_POST['others'];
    $platenumber=$_POST['platenumber'];
    $drivername=$_POST['drivername'];
    $ln=$_POST['ln'];
    $fn=$_POST['fn'];
    $mi=$_POST['mi'];
    $severity=$_POST['severity'];
    $other=$_POST['other'];
    $atd=$_POST['atd'];   
    $yesorno=$_POST['yesorno'];
    $text=$_POST['text'];  
    $leadername=$_POST['leadername'];  


      $sql="insert into `spot report:ems` (response, departure, arrival, dept, base, level, person, 
      number, lastname, firstname, svl, gender, last, first, middle, brand, vehicle, others, platenumber, drivername, ln,
      fn, mi, severity, other, atd, yesorno, text, leadername)
      values('$response','$departure','$arrival','$dept','$base','$level','$person','$number','$lastname',
      '$firstname','$svl','$gender', '$last', '$first', '$middle', '$brand', '$vehicle', '$others', '$platenumber', '$drivername', '$ln',
      '$fn', '$mi', '$severity', '$other', '$atd', '$yesorno', '$text', '$leadername' )";
      $result=mysqli_query($con,$sql);
      if($result){
        echo "Data inserted success";
      }else{
        die(mysqli_error($con));
      }
  }
?>
 </body>
</html>






