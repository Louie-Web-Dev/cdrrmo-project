<?php
session_start();  

if (isset($_SESSION["usertype"])) {
    switch ($_SESSION["usertype"]) {
        case "admin":
            header("Location: /cdrrmo-project/admin/dashboard.php");
            exit();
        case "dispatch":
            header("Location: /cdrrmo-project/dispatch/dashboard.php");
            exit();
        case "viewer":
            header("Location: /cdrrmo-project/viewer/dashboard.php");
            exit();
        case "encoder":
            header("Location: /cdrrmo-project/encoder/dashboard.php");
            exit();
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDRRMO Sto. Tomas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href=".\Image\sto_thomas.png">
    <link rel="shortcut icon" type="x-icon" href="Image/sto_thomas.png">
    <script src="https://kit.fontawesome.com/971c1cface.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
        <img src="Image\aksyon.png" alt="Logo 1" class="logo" id="logo" height="240px" width="350px" style="margin-top: 110px; margin-right: 10px; filter: drop-shadow(0 4px 8px white); box-shadow: none;"/>
        <div class="cont-2" >
            <img src="Image/logo.jpg" alt="Logo 2" id="logo2" height="100px" width="100px"  >
            <img src="Image\aksyon.png" alt="" id="logo3" style="height: 75px; width: 150px;">
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
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "database.php";

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        if ($user['status'] === 'disabled') {
            $_SESSION["error_message"] = "User account is disabled";
            header("Location: login.php");
            exit();
        }

        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = "yes";
            $_SESSION["username"] = $user["email"];
            $_SESSION["usertype"] = $user["usertype"];
            $_SESSION["fullName"] = $user["full_name"];

            switch ($_SESSION["usertype"]) {
                case "dispatch":
                    header("Location: /cdrrmo-project/dispatch/dashboard.php");
                    exit();
                case "encoder":
                    header("Location: /cdrrmo-project/encoder/dashboard.php");
                    exit();
                case "admin":
                    header("Location: /cdrrmo-project/admin/dashboard.php");
                    exit();
            }
        } else {
            $_SESSION["error_message"] = "Password does not match";
        }
    } else {
        $_SESSION["error_message"] = "Email does not match";
    }

    header("Location: login.php");
    exit();
}

if (isset($_SESSION["error_message"])) {
    echo "<div class='alert alert-danger'>" . $_SESSION["error_message"] . "</div>";
    unset($_SESSION["error_message"]);
}
?>

        <div class="form-btn">
        <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
      </form>
      <div>
    <p>Don't have an account? Contact Admin</p>
  </div>

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