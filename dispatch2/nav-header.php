<?php
ob_start(); // Start output buffering


// Rest of your code...
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CDRRMO Sto. Tomas</title>
  <link rel="icon" type="image/x-icon" href="../admin\Image\sto_thomas.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/971c1cface.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
  
  <script>
    function logout() {
        var confirmationMessage = "Are you sure you want to logout?";
        var confirmLogout = confirm(confirmationMessage);
        if (confirmLogout) {
            window.location.href = "logout.php";
        }
    }
  </script>

  
</head>
<body>

    <div class="container">

    <label for="title" id="text-one">CDRRMO Incident Management System, City of Sto. Tomas, Batangas   |</label>
    
    
        <h1 id="datetime"></h1>

        <script>
            function updateDateTime() {
                const datetimeElement = document.getElementById("datetime");
                const currentDate = new Date();
                datetimeElement.textContent = currentDate.toLocaleString(); // Update with the current date and time
            }
        
            // Update every second (1000 milliseconds)
            setInterval(updateDateTime, 1000);
        </script>

    <div class="navigation">
    <div class="dropdown">
                <div class="dropdown-content" id="notificationContent">
                    <!-- Database items will be displayed here -->
                </div>
            </div>
            <i class="fa fa-bell" aria-hidden="true" id="noti_number" onclick="toggleDropdown()"></i>

            
<script type="text/javascript">
    function loadDoc() {
        setInterval(function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("noti_number").innerHTML = this.responseText;
                    updateNotificationContent(); // Update the dropdown content
                }
            };
            xhttp.open("GET", "data.php", true);
            xhttp.send();
        }, 1000);
    }

    function toggleDropdown() {
        var dropdown = document.querySelector('.dropdown');
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
    }

    function updateNotificationContent() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("notificationContent").innerHTML = this.responseText;
                addClickEventToNotifications(); // Add click event to each notification
            }
        };
        xhttp.open("GET", "get_notification_content.php", true);
        xhttp.send();
    }

    function addClickEventToNotifications() {
        var notifications = document.querySelectorAll('.notification-item');
        notifications.forEach(function(notification) {
            notification.addEventListener('click', function() {
                // Redirect to the incident-list page or perform other actions
                window.location.href = 'incident-list.php';
            });
        });
    }

    loadDoc();
</script>
  <a class="button" onclick="logout()">
  
    <i class="fa-solid fa-user-tie"></i>
    <div class="logout">LOGOUT</div>
  </a>
    </div>

</div>

<div class="navbar">
    <div class="header">
        <a href="dashboard.php">
            
<img src=".\Image\logo.jpg" alt="" style="background-color: transparent; width: 150px; height: 150px;">

            <hr>
            
        </a>
    </div>

    <div class="nav">
        <div class="dashboard bg-transparent">
            <a href="dashboard.php" class="bg-transparent">
            <i class="fa-solid fa-table-columns bg-transparent" style="padding-right: 3px;"></i>
            <span class="bg-transparent no-underline">DASHBOARD</span> 
            </a>
        </div>


        <!--<div class="add-report bg-transparent">
            <a href="#" class="bg-transparent toggle-button">
                <i class="fa-solid fa-file-circle-plus bg-transparent"></i>
                REPORT
            </a>
            <div class="reports">
            <a href="incident-report.php" class="bg-transparent">Incident Details</a><br>
           <a href="ar-report.php" class="bg-transparent">Spot Report: AR</a>
            </div>
            
        </div>-->

        
    <div class="report-list bg-transparent">
        <a href="#" class="bg-transparent report-toggle-button">
            <i class="fa-solid fa-list bg-transparent" style="padding-right: 3px;"></i>
            REPORT LIST
        </a>
        <div class="reportList">
            <a href="incident-list.php" class="bg-transparent toggle-report" data-target="newReports">New Incident</a><br>
            <a href="resolved_incident.php" class="bg-transparent toggle-report" data-target="archives">Resolved Incident</a>
            <a href="archive_list.php" class="bg-transparent toggle-report" data-target="archives">Archived</a>
        </div>
    </div>

        <!--<div class="user bg-transparent">
            <a href="userlist.php" class="bg-transparent">
                <i class="fa-solid fa-user-tie bg-transparent" style="padding-right: 7px;"></i>
                USERS
            </a>
        </div>-->
    </div>
    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get references to all toggle buttons with the class .report-toggle-button
            const toggleButtons = document.querySelectorAll('.report-toggle-button');

            // Add click event listeners to toggle buttons
            toggleButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default behavior of the anchor element

                    // Find the reportList associated with the clicked button
                    const reportList = this.nextElementSibling;

                    // Toggle the visibility of the reportList
                    reportList.style.display = (reportList.style.display === 'none' || reportList.style.display === '') ? 'block' : 'none';

                    // Store the state in sessionStorage
                    sessionStorage.setItem('reportListState', reportList.style.display);

                    // Hide other report lists
                    toggleButtons.forEach(otherButton => {
                        if (otherButton !== this) {
                            otherButton.nextElementSibling.style.display = 'none';
                        }
                    });
                });

                // Retrieve the state from sessionStorage and apply it
                const storedState = sessionStorage.getItem('reportListState');
                if (storedState) {
                    button.nextElementSibling.style.display = storedState;
                }
            });
        });
        </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get references to all toggle buttons with the class .toggle-button
            const toggleButtons = document.querySelectorAll('.toggle-button');

            // Add click event listeners to toggle buttons
            toggleButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default behavior of the anchor element

                    // Find the reports associated with the clicked button
                    const reports = this.nextElementSibling;

                    // Toggle the visibility of the reports
                    reports.style.display = (reports.style.display === 'none' || reports.style.display === '') ? 'block' : 'none';

                    // Store the state in sessionStorage
                    sessionStorage.setItem('reportsState', reports.style.display);

                    // Hide other report sections
                    toggleButtons.forEach(otherButton => {
                        if (otherButton !== this) {
                            otherButton.nextElementSibling.style.display = 'none';
                        }
                    });
                });

                // Retrieve the state from sessionStorage and apply it
                const storedState = sessionStorage.getItem('reportsState');
                if (storedState) {
                    button.nextElementSibling.style.display = storedState;
                }
            });
        });
    </script>

<div class="togglebtn">
    <button id="toggleNavButton" class="toggle-nav-button bg-transparent">
        <i class="fa-solid fa-grip"></i>
    </button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get references to the toggle button and the nav content
        const toggleNavButton = document.getElementById('toggleNavButton');
        const navContent = document.querySelector('.navbar .nav');

        // Retrieve the state from sessionStorage and apply it
        const storedNavState = sessionStorage.getItem('navState');
        if (storedNavState) {
            navContent.style.display = storedNavState;
        }

        // Add click event listener to toggle button
        toggleNavButton.addEventListener('click', function () {
            // Toggle the visibility of the nav content
            if (navContent.style.display === 'none' || navContent.style.display === '') {
                navContent.style.display = 'block';
            } else {
                navContent.style.display = 'none';
            }

            // Store the state in sessionStorage
            sessionStorage.setItem('navState', navContent.style.display);
        });
    });
</script>




    <div class="aksyon-bilis bg-transparent">
        <img src=".\Image\aksyon.png" alt="" class="bg-transparent">
    </div>

</div>

<style>
    @import url(https://fonts.googleapis.com/css?family=Oswald:400);

.color-bg {
    position: fixed;
    height: 80px;
    width: 82%;
    background-color: #173381;
    right: 0;
    z-index: 0;
}

.container {
    border: 1px white solid;
    position: fixed;
    margin: 0.7%;
    right: 0;
    height: 65px;
    min-width: 82%;
    margin-left: 100px;
    background-color: #173381;
    border-radius: 15px;
    box-shadow: white 2px 2px 2px;
    display: flex;
    z-index: 1;
}

h1 {
    margin: 3.5px;
    margin-top: 22px;
    margin-left: 10px;
    color: white;
    background-color: transparent;
    font-family: 'Mulish', sans-serif;
}

#text-one {
    margin-top: 18px;
    font-size: 20px;
}


#datetime {
    color: white;
    font-size: 20px;
}

.navigation {
    position: absolute;
    margin-top: -7px;
    right: 5px;
    background-color: transparent;
}

.navigation i {
    color: white;
    margin-left: -2px;
    font-size: 25px;
    background-color: transparent;
    margin-top: -1px;
}

.logout {
    padding-left: 25px;
    margin-top: -35px;
    background-color: transparent;
    color: white;
    font-size: 15px;
    font-family: 'Oswald', sans-serif;
    position: relative;
    overflow: hidden;
    letter-spacing: 1px;
    opacity: 0;
    transition: opacity .45s;
    -webkit-transition: opacity .35s;
}

.button {
    text-decoration: none;
    float: right;
    padding: 12px;
    margin: 15px;
    width: 50px;
    background-color: transparent;
    transition: width .35s;
    -webkit-transition: width .35s;
    overflow: hidden;
}

.navigation a:hover {
    border-radius: 15px;
    background-color: #4970da;
    width: 100px;
}

.navigation a:hover .logout{
    opacity: .9;
}

.navigation a {
    text-decoration: none;
}


/* end of navbar */

@import url('https://fonts.googleapis.com/css2?family=Crimson+Text&family=Oswald:wght@300&family=Tiro+Tamil&display=swap');


.navbar {
    position: fixed;
    width: 250px;
    height: 100%;
    background-color: #ffffff;
    font-family: 'Mulish', sans-serif;
    font-weight: 600;
    margin: 0.4%;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    box-shadow: 5px 5px 5px;
    border-bottom-left-radius: 14px;
    border-bottom-right-radius: 14px;
}

.header {
    background-color: transparent;
}

a {
    color: black;
    cursor: pointer;
}

.header img {
    position: absolute;
    top: 10px;
    left: 21%;
    
}

.container label {
    color: white;
    text-align: left;
    margin: 3.5px;
    margin-top: 12px;
    font-family: 'Mulish', sans-serif;
    font-weight: light;
    font-size: 25px;
}

#text-two {
    margin-left: -286px;
    background-color: transparent;
}


.nav {
    position: absolute;
    font-size: 22px;
    top: 9.5rem;
    margin: 20px;
    background-color: white;
    display: flex;
    flex-direction: column;
}

.nav a, i{
    color: black; 
    text-decoration: none;
    margin: 10px;
}

.reports {
    display: none;
}

.toggle-button {
    cursor: pointer;
}

.nav a {
    font-family: 'oswald', sans-serif;
    font-weight: bold;
    color: black;
    background-color: white;
}
.nav a:after {
    content: "";
    position: absolute;
    background-color: blue;
    height: 3px;
    width: 0;
    left: 0;
    bottom: -10px;
    transition: 0.4s;
}
.aksyon-bilis img {
    position: absolute;
    left: 15px;
    bottom: 4%;
    height: 140px;
    width: 240px;
}

.reports {
    background-color: transparent;
    margin-left: 50px;
    font-size: 17px;
}

.reportList {
    display: none;
}

.reportList {
    background-color: transparent;
    margin-left: 50px;
    font-size: 17px;
}


.nav a:hover {
    color: grey;
    background-color: white;
    transition-duration: 0.4s;

}

.dropdown {
        display: none;
        position: fixed;
        background-color: #f9f9f9;
        min-width: 200px; /* Adjust the width as needed */
        max-height: 300px; /* Adjust the max height as needed */
        overflow-y: auto; /* Enable vertical scroll if content exceeds max height */
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 100;
        color: black;
        top: 1.5%;
        right: 9%;
        margin-top: 10px;
        border-radius: 7px;
    }

    .dropdown::-webkit-scrollbar {
            display: block;
            width: 5px;
        }

        .dropdown::-webkit-scrollbar-thumb {
            background: white;
            border-radius: 15px;
        }

        .dropdown::-webkit-scrollbar-track {
            background: #173381;
            border-radius: 7px;
        }

    .notification-item {
            display: flex;
            flex-direction: column;
            padding: 12px;
            border-bottom: 1px solid #ddd; /* Add a border between notifications */
            cursor: pointer; /* Add cursor pointer */
            transition: background-color 0.3s; /* Add smooth transition for background color */
            background-color: white;
        }

        .notification-item:hover {
            background-color: #f0f0f0; /* Add the background color you want on hover */
        }

        .detail-label, .detail-value {
            font-weight: 400;
            margin-bottom: 4px;
            background-color: white;
            transition: background-color 0.3s; /* Add smooth transition for background color */
        }

        .notification-item:hover .detail-label, .notification-item:hover .detail-value {
            background-color: #f0f0f0; /* Add the background color you want on hover */
        }

    .detail-label {
        font-weight: 400;
        margin-bottom: 4px;
        background-color: white;
    }

    .detail-value {
        margin-bottom: 8px;
        background-color: white;
    }
    .notification-item .detail-label {
        font-weight: 400;
        margin-bottom: 4px;
        background-color: white;
    }

    .notification-item .detail-value {
        margin-bottom: 8px;
        background-color: white;
    }

    #noti_number {
        margin-top: 25px;
        font-weight: 400;
        font-size: 23px;
    }

    .fa-bell {
        font-size: 25px;
    }

    #noti_number:hover {
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        .togglebtn {
            display: none;
        }

        .nav {
             display: block;
        }


    @media screen and (max-width: 1555px) and (min-width: 320px) {
        .nav, .header img,
        .aksyon-bilis, .container label {
            display: none;
        }

        .container {
            max-width: 90%;
        }

        .toggle-nav-button,
        .togglebtn {
            display: block;
        }

        .navbar {
            width: 7%;
            height: 65px;
            border-radius: 15px;
            z-index: 1;
            border-radius: 7px;
        }

        .togglebtn {
            background-color: transparent;
            margin: auto;
            margin-top: 0%;
            text-align: center;
            font-size: 25px;
        }

        .togglebtn:hover {
            background-color: transparent;
            font-size: 32px;
            transition-duration: 0.3s;
            padding: 0;
        }

        .nav {
            top: 25px;
            left: 25px;
        }

        .nav {
            width: 200px;
            border-radius: 7px;
            padding-top: 10px;
            padding-bottom: 10px;
            background-color: #f2f1ed;
        }
    }

    @media screen and (max-width: 1950px) and (min-width: 1620px) {
        .container {
        max-width: 85.4%;
        }
    }
</style>
  
  
</body>
</html>
