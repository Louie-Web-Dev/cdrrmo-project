<?php
session_start(); // for the admin-only page here
if (!isset($_SESSION["user"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: /cdrrmo-project/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
    <?php include 'nav-header.php'; ?>
</head>
<body>
    <div class="dashboard-container">
    <img src="..\admin\Image\sto_thomas.png" alt="" width="75" height="75">
        <h1>Edit User</h1>
        <?php
        require_once "database.php";

        // Check if ID is provided
        if (!isset($_GET['id'])) {
            header("Location: dashboard.php");
            exit();
        }

        $user_id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = $user_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            echo "User not found.";
            mysqli_close($conn);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $reenter_password = $_POST['reenter_password'];

            // Check if a new password is provided
            if (!empty(trim($password))) {
                // Check if passwords match
                if ($password === $reenter_password) {
                    // Check if the password meets the minimum length requirement
                    if (strlen($password) >= 8) {
                        // Hash the new password before updating
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $update_sql = "UPDATE users SET full_name = '$full_name', email = '$email', password = '$hashed_password' WHERE id = $user_id";

                        if (mysqli_query($conn, $update_sql)) {
                            echo "Successfully Saved";
                        } else {
                            echo "Error updating user: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Password must be at least 8 characters long.";
                    }
                } else {
                    echo "Passwords do not match.";
                }
            } else {
                // Keep the existing password in the database
                $update_sql = "UPDATE users SET full_name = '$full_name', email = '$email' WHERE id = $user_id";

                if (mysqli_query($conn, $update_sql)) {
                    echo "Successfully Saved";
                } else {
                    echo "Error updating user: " . mysqli_error($conn);
                }
            }
        }

        mysqli_close($conn);
        ?>
        <form method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>

            <!--<label for="email">User Type:</label>
                <select class="form-control" name="usertype" style="border: 1px grey solid;">
                    <option value="admin">Admin</option>
                    <option value="dispatch">Dispatch</option>
                    <option value="viewer">Viewer</option>
                    <option value="encoder">Encoder</option>
                </select>-->

            <label for="password">Enter New Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="reenter_password">Re-enter Password:</label>
            <input type="password" id="reenter_password" name="reenter_password" required><br>

            <button type="submit">Save Changes</button>
        </form>
        <a href="userlist.php" class="btn btn-primary">Back to User List</a>
    </div>

    <style>
        body {
            background-color: #173381;
        }

        .navbar, .color-bg {
            display: none;
        }
        

        .container {
            margin-top: -90px;
            min-width: 98%;
            margin-right: 1.2%;
        }

        .dashboard-container {
            margin-top: 100px;
            border-radius: 15px;
        }

        .dashboard-container h1 {
            text-align: center;
            display: block;
            color: black;
            margin-top: 5px;
            padding-bottom: 5px;
            font-size: 30px;
            font-weight: bold;
        }

        .dashboard-container img {
            margin: auto;
            padding-top: 0;
        }

        form {
            text-align: right;
            margin-right: 25%;
        }

        form label {
            margin-right: 50px;
            margin-top: 15px;
        }

        form input {
            width: 50%;
            height: 35px;
            border: 1px solid grey;
            margin-right: auto;
            border-radius: 7px;
            padding-left: 5px;
        }

        .dashboard-container a {
            background-color: #208454;
            margin-top: 10px;
            margin-left: 20px;
            height: 40px;
            border: none;
        }

        .dashboard-container a:hover {
            background-color: #187444;
            transition-duration: 0.4s;
        }

        .dashboard-container button {
            margin-top: 10px;
            background-color: #173381;
            width: 23%;
            color: white;
            height: 40px;
            border-radius: 7px;
            float: right;
            margin-right: -30%;
        }

        .dashboard-container button:hover {
            transition-duration: 0.4s;
            background-color: #105cd4;
        }
    </style>
</body>
</html>