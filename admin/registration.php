<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../admin\Image\sto_thomas.png">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <?php include 'nav-header.php'; ?>
</head>
<body>
    <div class="reg-container">
        
        <form action="registration.php" method="post">
            <img src="..\admin\Image\sto_thomas.png" alt="" width="75" height="75">
            <h1>CREATE USER</h1>
            <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $usertype = $_POST["usertype"];
           $status = $_POST["status"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($usertype) OR empty($status)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 characters long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           } else {
            
            $sql = "INSERT INTO users (full_name, email, password, usertype, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            
            if ($stmt && mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssss", $fullName, $email, $passwordHash, $usertype, $status);
                mysqli_stmt_execute($stmt);
                echo "You are registered successfully.";
            } else {
                echo "Something went wrong with the database.";
            }

            mysqli_stmt_close($stmt);
           }
           mysqli_close($conn);
        }
        ?>
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Surname, Firstname MI">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div>
            <div class="form-group">
                <label for="usertype">User Type:</label>
                <select class="form-control" name="usertype" style="border: 1px grey solid;">
                    <option value="admin">Admin</option>
                    <option value="dispatch">Dispatch</option>
                    <option value="viewer">Viewer</option>
                    <option value="encoder">Encoder</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" style="border: 1px grey solid;">
                    <option value="enable">Enable</option>
                    <option value="disable">Disable</option>
                </select>
            </div>
            <div class="form-btn">
                <a href="userlist.php" class="btn btn-success">Back</a>
                <input type="submit" class="btn btn-primary" value="Create" name="submit">
            </div>
        </form>
    </div>

    <style>
        body {
            background-color: #173381;
        }

        .bg-color {
            display: none;
        }

        .reg-container {
            background-color: white;
            min-width: 85.5%;
            position: fixed;
            right: 10px;
            height: 100%;
            margin-top: 35px;
            border-radius: 15px;
        }

        .alert-danger {
            background-color:transparent;
            color: #721c24;
            border: transparent;
            text-align: center;
            padding: 1px;
            margin-bottom: 1px;
        }
        .navbar {
            margin: -40px;
        }

        .container {
            margin-top: -40px;
            width: 85.5%;
            padding: 0;
            padding-left: 10px;
        }

        .reg-container h1 {
            text-align: center;
            display: block;
            color: black;
            margin-top: 5px;
            padding-bottom: 5px;
            font-size: 30px;
            font-weight: bold;
        }

        form {
            margin-top: 50px;
        }

        form img {
            margin: auto;
            padding-top: 15px;
        }

        .form-group {
            margin-top: -5px;
            width: 50%;
            margin: 15px auto;
        }

        .form-group input {
            border: 1px grey solid;
        }

        .btn-success {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 30px;
    text-decoration: none;
    border-radius: 4px;
    margin-left: 100px;
    margin-top: 100px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 30px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 100px;
    margin-left: 1250px;
    position: absolute;
}


        .form-btn input {
            background-color: #173381;

        }
    </style>
</body>
</html>
