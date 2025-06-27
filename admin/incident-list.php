<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "save.php";

$sql = "SELECT * FROM incidents ORDER BY id DESC";
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    
</head>

<body>    
<div class="new-reportList">
    <h1>New Incident List</h1>
    <div class="searchBar bg-transparent">
    <i class="fa-solid fa-magnifying-glass bg-transparent"></i>
    <input type="text" name="search" id="search" placeholder="Search Incident">
    <button id="search-btn">Search</button>
    <button id="clear-btn">Clear</button>
</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            
    <div class="showEntries bg-transparent">
        <span>Show</span>
        <input type="number" name="entries" id="entries" >
        <span>entries</span>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
$(document).ready(function () {
    
    if (!sessionStorage.getItem('entries_default')) {
     
        sessionStorage.setItem('entries_default', '50');
    }

    
    var defaultEntries = sessionStorage.getItem('entries_default');
    $('#entries').val(defaultEntries);

   
    $('#entries').on('change', function () {
        var entries = $(this).val();

        entries = entries.trim() === '' || isNaN(entries) ? defaultEntries : entries;

        $.ajax({
            type: 'GET',
            url: 'Get_Entries.php',
            data: { entries: entries },
            success: function () {

                updateTable();
            },
            error: function () {

                console.error('Failed to update entries. Please try again.');
            }
        });
    });

    $('#clear-btn').on('click', function () {
        // Clear the search input
        $('#search').val('');

        // Reset the entries to the default value
        $('#entries').val(defaultEntries);

        // Call the PHP script to update the entries dynamically
        $.ajax({
            type: 'GET',
            url: 'Get_Entries.php',
            data: { entries: defaultEntries },
            success: function () {
                // Reload the table or perform any other necessary updates
                updateTable();
            },
            error: function () {
                // Handle errors
                console.error('Failed to update entries. Please try again.');
            }
        });
    });


    function updateTable() {
        $.ajax({
            type: 'GET',
            url: 'get_new_incident.php',
            success: function (response) {
                $('#incident-table-body').html(response);

                // Update the #entries input value based on the number of rows in the table
                var rowCount = $('#incident-table-body tr').length;
                $('#entries').val(rowCount);
            },
            error: function () {
                // Handle errors
            }
        });
    }

    updateTable();
});
    </script>

    <div class="dashboard-container">
        <table class="new-report-table">
            <thead>
                <tr>
                    <th>Incident ID</th>
                    <th>Date and Time of Incident<br>(Reported)<br>(YYYY-MM-DD-TIME)</th>
                    <th>Type of Incident</th>
                    <th>Location of Incident<br>(Barangay)</th>
                    <th>Status<br>(Accepted By)</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody id="incident-table-body">

            <div id="successModal" class="modal">
            <div class="modal-content">
                <span id="closeSuccessBtn" class="close">&times;</span>
                <p>Incident Resolved Successfully!</p>
            </div>
        </div>
        
        <div id="confirmationModal" class="modal">
            <div class="modal-content1">
                <span id="closeConfirmationBtn" class="close1">&times;</span>
                <p>Are you sure you want to resolve this incident?</p>
                <button id="confirmResolveBtn">Yes, Check it</button>
                <button id="cancelResolveBtn">Cancel</button>
            </div>
        </div>

        <div id="inspectModal" class="modal">
            <div class="modal-content">
                <span id="closeInspectBtn" class="close">&times;</span>
                    <p>Choose an option:</p>
                <button id="incidentDetailsBtn" target="_blank">Incident Details</button>
                <button id="FullIncidentDetailsBtn" target="_blank"> Full Incident Details</button>
            </div>
        </div>

        <div id="editReportModal" class="modal">
            <div class="modal-content">
                <span id="closeEditReportBtn" class="close">&times;</span>
                    <p>Choose an option:</p>
                <button id="editReportDetailsBtn" target="_blank">Edit Incident Details</button>
                <button id="emsReportBtn" target="_blank">Make EMS Report</button>
            </div>
        </div>
               
            </tbody>
        </table>
    </div>

    <script>
       var confirmationShown = false;
var lastConfirmedIncidentId = null;

var confirmationShown = false;
var lastConfirmedIncidentId = null;

function changeStatusButton(incidentId, currentStatus) {
    console.log('changeStatusButton invoked');
    var newStatus = (currentStatus === 'Verified') ? 'Resolved' : 'Verified';

    // Show the confirmation modal
    $('#confirmationModal').css('display', 'block');

    // Set up event handlers for the buttons in the confirmation modal
    $('#confirmResolveBtn').on('click', function () {
        // Close the confirmation modal
        $('#confirmationModal').css('display', 'none');

        // Redirect to resolve_incident_details.php with the incidentId parameter
        var url = 'resolve_incident_details.php?id=' + incidentId;
        window.location.href = url;
    });

    $('#cancelResolveBtn').on('click', function () {
        // Close the confirmation modal
        $('#confirmationModal').css('display', 'none');
    });

    // Set up event handler for closing the modal when clicking the close button
    $('#closeConfirmationBtn').on('click', function () {
        $('#confirmationModal').css('display', 'none');
    });
}


    


        function changeStatus(incidentId, newStatus) {
            if (newStatus === 'Archived' && !confirm('Are you sure you want to archive this incident?')) {
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        updateStatusAndButton(incidentId, newStatus);
                    } else {
                        console.error('Failed to update status. Please try again.');
                    }
                }
            };

            xhr.open('POST', 'Update_Resolved.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('incident_id=' + incidentId + '&new_status=' + newStatus);
        }

        function updateStatusAndButton(incidentId, newStatus) {
            // Update the status cell
            var statusCell = $('.status-cell[data-incident-id="' + incidentId + '"]');
            if (statusCell) {
                statusCell.text(newStatus);
            }

            // Update the button
            var button = $('#status-button-' + incidentId);
            if (button) {
                button.text((newStatus === 'Verified') ? 'Resolve' : 'Verify');
                button.removeClass('btn-success btn-warning').addClass((newStatus === 'Verified') ? 'btn-success' : 'btn-warning');

                // Remove all existing click event handlers
                button.off('click');

                // Add a new click event handler
                button.on('click', function () {
                    changeStatusButton(incidentId, newStatus);
                });
                
                //success notification modal
                if (newStatus === 'Resolved') {
                    // Display the success modal
                    $('#successModal').css('display', 'block');

                    // Set a timeout to close the success modal after 3 seconds (adjust as needed)
                    setTimeout(function () {
                        $('#successModal').css('display', 'none');
                    }, 3000);
                }
            }

            // Update the 'Archive' button visibility
            var deleteButton = $('#delete-button');
            deleteButton.show();

            // Toggle visibility based on status
            var row = statusCell.closest('tr');
            if (newStatus === 'Resolved' || newStatus === 'Archived') {
                row.addClass('marked-for-hide');
            } else {
                row.removeClass('marked-for-hide');
            }
        }

        function updateTable() {
            // Fetch and update the table dynamically using AJAX
            $.ajax({
                type: 'GET',
                url: 'get_new_incident.php',
                success: function (response) {
                    $('#incident-table-body').html(response);
                },
                error: function () {
                    // Handle errors
                }
            });
        }

        // Initial table update
        updateTable();


        
        // Periodically update the status and button every second
        $(document).ready(function () {
    var intervalId; // Variable to store the interval ID
    var searchInProgress = false; // Variable to track whether a search is in progress

    function updateTableWithSearchResults() {
        if (searchInProgress) {

            return;
        }

        clearInterval(intervalId);

        searchInProgress = true;

        var searchQuery = $('#search').val();
        var url = 'Get_Search_New.php?search=' + encodeURIComponent(searchQuery);

        $.ajax({
            type: 'GET',
            url: url,
            success: function (response) {
                console.log('Response from server:', response);
                $('#incident-table-body').html(response);
            },
            error: function () {
                console.error('Error fetching search results');
            },
            complete: function () {
                searchInProgress = false;
                
                var intervalDuration = searchQuery.trim() === '' ? 500 : 60000;
                intervalId = setInterval(updateTable, intervalDuration);
            }
        });
    }

    
    $('#search-btn').on('click', function () {
        updateTableWithSearchResults();
    });


    $('#clear-btn').on('click', function () {

        $('#search').val('');

        updateTableWithSearchResults();
    });

    updateTable();

    intervalId = setInterval(updateTable, 500);
});


document.addEventListener('DOMContentLoaded', function () {
    var inspectModal = document.getElementById('inspectModal');
    var editReportModal = document.getElementById('editReportModal');
    var incidentDetailsBtn = document.getElementById('incidentDetailsBtn');
    var fullIncidentDetailsBtn = document.getElementById('FullIncidentDetailsBtn'); // Fix ID here
    var editReportDetailsBtn = document.getElementById('editReportDetailsBtn');
    var emsReportBtn = document.getElementById('emsReportBtn');
    var selectedIncidentId;

    window.openInspectModal = function (incidentId) {
        selectedIncidentId = incidentId;
        inspectModal.style.display = 'block';
    };

    window.openEditReport = function (incidentId) {
        selectedIncidentId = incidentId;
        editReportModal.style.display = 'block';
    };

    incidentDetailsBtn.onclick = function () {
        var url = 'incident_details.php?id=' + selectedIncidentId;
        window.open(url, '_blank'); // Open in a new tab
        inspectModal.style.display = 'none';
    };

    fullIncidentDetailsBtn.onclick = function () {
        var url = 'full_incident_details.php?id=' + selectedIncidentId;
        window.open(url, '_blank'); // Open in a new tab
        inspectModal.style.display = 'none';
    };

    editReportDetailsBtn.onclick = function () {
        var url = 'edit_incident_details.php?id=' + selectedIncidentId;
        window.open(url, '_blank'); // Open in a new tab
        editReportModal.style.display = 'none';
    };

    emsReportBtn.onclick = function () {
        var url = 'ems-report.php?id=' + selectedIncidentId;
        window.open(url, '_blank'); // Open in a new tab
        editReportModal.style.display = 'none';
    };

    var closeInspectBtn = document.getElementById('closeInspectBtn');
    var closeEditReportBtn = document.getElementById('closeEditReportBtn');

    window.onclick = function (event) {
        if (event.target == inspectModal || event.target == closeInspectBtn) {
            inspectModal.style.display = 'none';
        } else if (event.target == editReportModal || event.target == closeEditReportBtn) {
            editReportModal.style.display = 'none';
        }
    };
});



    </script>


</div>

    <style>
        

        body {
            background-color: #173381;
        }
        .marked-for-hide {
        display: none;
        }
        .d-none {
        display: none !important;
        }

        .new-report-table thead th {
        position: sticky;

        }
        #successModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #successModal p {
            margin: 0;
        }

        #closeSuccessBtn {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }


        
        #confirmationModal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content1 {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
}

.modal-content1 p {
    margin-top: 0px;
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
    font-weight: 500;
}

.close1 {
    margin-top: -15px;
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close1:hover {
    color: black;
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
            background-color: rgba(0, 0, 0, 0.7);
        }


        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }
        .modal-content p {
            position: flex;
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            margin-top: -30px;
            margin-right: 50px;
            font-weight: 500;
        }

        .close {
            color: #aaa;
            margin-left: 95%;
            margin-top: -2%;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
 
        #incidentDetailsBtn,
        #FullIncidentDetailsBtn,
        #editReportDetailsBtn,
        #emsReportBtn,
        #confirmResolveBtn,
        #cancelResolveBtn
        {
            background-color: #94b4ff;
            color: black;
            border: none;
            font-weight: 500;
        }

        #incidentDetailsBtn:hover,
        #FullIncidentDetailsBtn:hover,
        #editReportDetailsBtn:hover,
        #emsReportBtn:hover,
        #confirmResolveBtn:hover,
        #cancelResolveBtn:hover
        {
            background-color: #7c9ff6;

        }

        .edit-report-button {
            background-color: #7c9ff6; 
            color: white;
            padding: 3px;
            border-radius: 10px; 
            margin-right: 7px;
        }

        .edit-report-button:hover {
            background-color: #5983f4;
            border-radius: 10px; 
        }

        .inspect-button {
            background-color: #7c9ff6; 
            padding: 3px;
            border-radius: 10px; 
            margin-right: 4px;
        }

        .inspect-button:hover {
            background-color: #5983f4;
            border-radius: 10px; 
        }

        .custom-button {
            background-color: #7c9ff6; 
            padding: 3px;
            border-radius: 10px; 
           
        }

        .custom-button:hover {
            background-color: #5983f4;
            border-radius: 10px;  
        }



        .dashboard-container {
            background-color: transparent;
            width: 81.7%;
            max-height: 75vh;
            position: fixed;
            overflow: auto; 
            border: 2px white solid;
            border-radius: 15px;
            scrollbar-width: thin; 
            scrollbar-color: #333 #f0f0f0; 
        }

        
        .dashboard-container::-webkit-scrollbar {
            width: 8px; 
        }

        .dashboard-container::-webkit-scro  llbar-track {
            background: #f0f0f0; 
        }

        .dashboard-container::-webkit-scrollbar-thumb {
            background: grey; 
        }

        .add-user-button {
            margin-bottom: 20px;
        }
        


        button {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            
        }

        button:hover {
            background-color: #ddd;
        }

        .new-reportList {
            background-color: white;
            width: 82%;
            height: 95%;
            position: fixed;
            right: 10px;
            margin-top: 83px;
            border-radius: 15px;
        }

        .new-reportList h1 {
            background-color: #173381;
            width: 99.8%;
            margin: 1px;
            padding: 15px;
            font-size: 25px;
            border-top-left-radius: 15px;
            font-family: 'Mulish', sans-serif;
            font-weight: bolder;
        }

        .searchBar input {
            background-color: transparent;
            background-color: #94b4ff;
            width: 25%;
            height: 35px;
            margin: 15px;
            border-radius: 7px;
            padding-left: 30px;
        }

        .searchBar input::placeholder {
            color: #173381;
            font-weight: 100;
            font-family: 'Mulish', sans-serif;
        }

        .searchBar i {
            position: absolute;
            top: 77px;
            left: 11px;
            color: #173381;
        }

        .searchBar #filterIcon {
            margin-left: 23%;
            cursor: pointer;
        }

        .filterContent {
            display: none;
            position: absolute;
            left: 23%;
            background-color: white;
            max-width: 160px;
            border: 1px grey solid;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0; 
        }

        .filterContent a {
            padding: 12px 16px;
            border: 1px #173381;
            text-decoration: none;
            display: block;
            text-align: center;
            color: #333;
        }

        .filterContent a:hover {
            background-color: #ddd;
            color: white;
            background-color: #173381;
        }

        .showEntries {
            position: absolute;
            top: 80px;
            right: -8%;
        }

        .showEntries span {
            background-color: transparent;
            color: #173381;
            font-weight: 600;
        }

        .showEntries input {
            text-align: center;
            background-color: #94b4ff;
            width: 15%;
            border-radius: 7px;
            height: 35px;
        }

        .showEntries input[type="number"]::-webkit-inner-spin-button,
        .showEntries input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }

        #clear-btn, #search-btn {
            background-color: #173381;
            color: white;
            border-radius: 7px;
        }

        .new-report-table {
            width: 100%;
            height: fit-content;
            border-collapse: collapse;
            margin: auto;
            text-align: center;
        }
        
        .new-report-table tr,
        .new-report-table td {
            background-color: transparent;
            border-bottom: 1px black solid;
        }

        .new-report-table tbody {
            overflow-y: auto;
            font-weight: 500;
        }

        .new-report-table thead {
            position: sticky;
            top: 0;
    
        }

        .new-report-table th, .incident-table td {
            padding: 8px;
            text-align: center;
        }

        .new-report-table th {
            background-color: #173381;
            color: white;
        }

        .new-report-table tr {
            margin-top: 10px;
        }

        .new-report-table td {
            padding: 10px;
        }

        .new-report-table tr:nth-child(even) {
            background-color: #bfd2ff;
            color: black;
        }

        .new-report-table tr:nth-child(odd) {
            background-color: #ffffff;
            color: black;
        }

        .new-report-table .edit {
            background-color: #ddd;
            margin-right: 10px;
            width: 60px;
            height: 35px;
            border-radius: 7px;
        }

        .new-report-table .view {
            background-color: #173381;
            margin-right: 10px;
            width: 60px;
            height: 35px;
            border-radius: 7px;
            color: white;
        }

        #resolved-button {
            background-color: #68B984;
            color: black;
            font-weight: bolder;
        }

        #verified-button {
            background-color: #5FBDFF;
            color: black;
            font-weight: bolder;
        }

        #edit-report {
            background-color: #f9f9f9;
            padding: 0;
        }

        #delete-button {
            margin-left: 5px;
            background-color: #BE3144;
            padding: 0;
            color: white;
        }

        #inspect-button i {
            margin-top: 5px;
            margin-left: 0;
            padding: 1px;
        }

        .buttons:hover {
            padding: 1px;
        }

        @media screen and (max-width: 1555px) and (min-width: 320px) {
            .new-reportList {
                width: 98%;
            }


            .dashboard-container {
                width: 98%;
                margin: auto;
            }
        }

        @media screen and (max-width: 1950px) and (min-width: 1620px) {
            .new-reportList {
            min-width: 85.4%;
            }

            .dashboard-container {
                width: 85.3%;
            }
    }

    </style>
</body>
</html>