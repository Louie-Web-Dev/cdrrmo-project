<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="Image/logo.jpg">
    <title>CDRRMO Sto. Tomas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/971c1cface.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
        <img src="Image/logo1.png" alt="Logo 1" id="logo" height="380px" width="340px" />
        <div class="cont-2" >
            <img src="Image/logo.jpg" alt="Logo 2" id="logo2" height="100px" width="100px"  >
            <img src="..\images\aksyon-bilis.png" alt="" id="logo3" style="height: 75px; width: 150px;">
            <h1>CDRRMO Incident<br>Management System</h1>
            <h4>City of Sto. Tomas, Batangas</h4>
   
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control" required autocomplete="off" >
            <div class="icon">
                  <i class="fa-solid fa-user bg-transparent"></i>
                </div>
        </div>
        <div class="form-group ">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control" required autocomplete="off">
            <div class="icon2">
                  <i class="fa-solid fa-lock bg-transparent"></i>
                </div>
        </div>
        <?php
// Check if the form has been submitted
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connect to the database
    require_once "database.php";

    // Query the database for the user information
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // If the user exists
    if ($user) {
        // Check if the user is disabled
        if ($user['status'] === 'disabled') {
            $_SESSION["error_message"] = "User account is disabled"; // Set the error message in the session
            header("Location: login.php");
            die();
        }

        // Verify the password
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user"] = "yes";
            $_SESSION["username"] = $user["email"];
            $_SESSION["usertype"] = $user["usertype"];

            // Store the full name in the session
            $_SESSION["fullName"] = $user["full_name"];

            // Redirect to the appropriate home page based on the user type
            if ($_SESSION["usertype"] == "user") {
                header("Location: Dispatch_Team_Module/dashboard.php");
            } elseif ($_SESSION["usertype"] == "admin") {
                header("Location: dashboard.php");
            }

            die();
        } else {
            $_SESSION["error_message"] = "Password does not match"; // Set the error message in the session
            header("Location: login.php");
            die();
        }
    } else {
        $_SESSION["error_message"] = "Email does not match"; // Set the error message in the session
        header("Location: login.php");
        die();
    }
}

// Check for and display the error message if it exists
if (isset($_SESSION["error_message"])) {
    echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
    unset($_SESSION["error_message"]); // Remove the error message from the session
}
?>

        <div class="form-btn">
        <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
      <div>
    <p>Don't have an account? <a href="https://mail.google.com/mail/u/0/?view=cm&to=bsit.villanueva.sannyboy@gmail.com&subject=Request%20for%20Account%20Creation" target="_blank" onclick="openEmailClient()">Contact Admin</a></p>
  </div>
  <!--<div> // use this if users is not using email software
    <p>Don't have an account? <a href="https://mail.google.com/mail/u/0/?view=cm&to=bsit.villanueva.sannyboy@gmail.com&subject=Contacting%20Admin" target="_blank">Contact Admin</a></p>
    </div>-->

  <script>
    function openEmailClient() {
      const subject = encodeURIComponent("Request for Account Creation");
      const body = encodeURIComponent(`Dear [Admin's Name or Team],

I hope this email finds you in good health and high spirits. I am writing to formally request the creation of a new account within our organization's system.

Below are the details for the account to be created:

1. Full Name of Account Holder: [Your Full Name]
2. Position/Role: [Your Position/Role]
3. Department: [Your Department]
4. Preferred Username: [Desired Username]
5. Contact Information:

Email: [Your Email Address]
Phone: [Your Phone Number]
Reason for Account Creation:

[Provide a brief explanation of why you need this account, its intended use, and how it will contribute to your role and the organization's objectives.]

Access and Permissions:

[Specify the access and permissions you require for this account, ensuring it aligns with your role and responsibilities.]

Additional Information (if any):

[Include any additional information or requirements related to the account setup, if applicable.]

I appreciate your prompt attention to this matter and kindly request that you confirm receipt of this request. If any further information or clarification is needed, please feel free to reach out to me.

Thank you for your assistance.

Best regards,

[Your Full Name]
[Your Position/Role]
[Your Contact Information]`);

      const mailtoLink = `mailto:bsit.villanueva.sannyboy@gmail.com?subject=${subject}&body=${body}`;
      const newTab = window.open(mailtoLink, '_blank');
      newTab.focus();
    }
  </script>

    <style>
      .container {
          margin: 10% auto;
        }

        #logo3 {
          display: none;
        }

        @media screen and (max-width: 1024px) and (min-width: 320px) {
          #logo {
            display: none;
          }

          .cont-2 {
            margin: auto;
          }

          #logo2 {
            height: 75px;
            width: 75px;
            margin-left: 100px;
          }

          #logo3 {
            background-color: transparent;
            display: block;
            margin-top: 10px;
            float: right;
            margin-right: 100px;
          }

          h1 {
            float: none;
            display: block;
            text-align: center;
            padding: 0;
            margin-right: 45px;
          }

          h4 {
            margin-right: 40px;
            float: none;
            text-align: right;
          }

          p {
            background-color: transparent;
            margin-top: 20px;
          }

          .icon, .icon2 {
            margin-top: 40px;
          }
        }
    </style>
</body>
</html>