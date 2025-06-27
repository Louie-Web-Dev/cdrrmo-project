<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'], $_POST['user_id'])) {
    // Handle disable/enable action
    $action = $_POST['action'];
    $userId = $_POST['user_id'];

    if ($action === 'disable') {
        // Perform logic to disable user (update database, etc.)
        // You need to implement this based on your requirements.
        // Add your logic here...

    } elseif ($action === 'enable') {
        // Perform logic to enable user (update database, etc.)
        // You need to implement this based on your requirements.
        // Add your logic here...
    }
}

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDRRMO Sto. Tomas</title>
    <link rel="icon" type="image/x-icon" href="/cdrrmo-project/images/sto_thomas.png">
    <?php include 'nav-header.php'; ?>
    <script src="https://kit.fontawesome.com/971c1cface.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="dashboard-container">
        <h1>User List</h1> <a href="registration.php" class="btn btn-success add-user-button">Add User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['full_name']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['usertype']; ?></td>
                        <td>
                            <a id="edit-button" href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">
                                <i class="fas fa-edit bg-transparent"></i> Edit
                            </a>
                            <button onclick="confirmDelete(<?= $row['id']; ?>)" class="btn btn-danger">
                                <i class="fas fa-trash bg-transparent"></i>
                            </button>
                            <button onclick="toggleUserStatus(<?= $row['id']; ?>, '<?= $row['status']; ?>')"
                                class="btn <?= $row['status'] === 'disabled' ? 'btn-success' : 'btn-danger'; ?>">
                                <?= $row['status'] === 'disabled' ? 'Enable' : 'Disable'; ?>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleUserStatus(userId, status) {
            var confirmationMessage = "Are you sure you want to " + (status === 'disabled' ? 'enable' : 'disable') + " this user?";
            var confirmToggle = confirm(confirmationMessage);
            if (confirmToggle) {
                var form = document.createElement('form');
                form.style.display = 'none';
                form.method = 'post';
                form.action = 'user_action.php';  // Replace with your actual user action PHP script

                var inputAction = document.createElement('input');
                inputAction.type = 'hidden';
                inputAction.name = 'action';
                inputAction.value = status === 'disabled' ? 'enable' : 'disable';
                form.appendChild(inputAction);

                var inputUserId = document.createElement('input');
                inputUserId.type = 'hidden';
                inputUserId.name = 'user_id';
                inputUserId.value = userId;
                form.appendChild(inputUserId);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
<script>
function confirmDelete(userId) {
    var confirmationMessage = "Are you sure you want to remove this user?";
    var confirmDelete = confirm(confirmationMessage);
    if (confirmDelete) {
        // Assuming you have a form with id 'deleteForm' and an input field named 'user_id'
        var form = document.createElement('form');
        form.style.display = 'none';
        form.method = 'post';
        form.action = 'delete_user.php';  // Replace with your actual delete user PHP script

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'user_id';
        input.value = userId;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>
    

        <style>

        body {
            background-color: #173381;
        }

        .dashboard-container {
            background-color: white;
            width: 82%;
            height: 100%;
            position: fixed;
            right: 10px;
            margin-top: 83px;
            border-radius: 15px;
            overflow: auto;
            border: 2px white solid;
            border-radius: 15px;
        }

        .dashboard-container::-webkit-scrollbar {
            width: 8px; /* Set the width of the scrollbar */
        }

        .dashboard-container::-webkit-scro  llbar-track {
            background: #f0f0f0; /* Set the track background color */
        }

        .dashboard-container::-webkit-scrollbar-thumb {
            background: grey; /* Set the thumb color */
        }

        .dashboard-container h1 {
            margin: 0;
            background-color: #173381;
            font-size: 25px;
            font-weight: bold;
            color: white;
            padding: 20px;
            width: 100%;
        }

        .add-user-button {
            float: right;
            margin-top: -55px;
            margin-right: 10px;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 30px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 10px;
            border: 1px solid #888;
            width: 60%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            padding: 5px 5px;
            margin: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ddd;
        }
        
        #edit-button {
            background: #3c63e6;
            color: white;
            padding: 3px;
        }

        table {
            text-align: center;
        }

        @media screen and (max-width: 1555px) and (min-width: 320px) {
            .dashboard-container {
                width: 98%;
            }
        }

        @media screen and (max-width: 1950px) and (min-width: 1610px) {
            .new-reportList {
            min-width: 85.4%;
            }

            .dashboard-container {
                width: 85.4%;
            }
    }
    </style>
</body>
</html>
