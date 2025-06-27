<!-- create_user.php -->
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $email = $_POST["email"];

    // Insert the new user into the database
    $sql = "INSERT INTO users (full_name, email) VALUES ('$full_name', '$email')";
    mysqli_query($conn, $sql);

    // Redirect back to the user list after creating a user
    header("Location: userlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
</head>
<body>
    <div class="container">
        <h1>Create User</h1>
        <form method="POST">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Create User</button>
        </form>
        <a href="userlist.php" class="btn btn-primary">Back to User List</a>
    </div>

    <style>
        
    </style>
</body>
</html>
