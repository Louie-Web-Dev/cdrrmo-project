<?php
session_start(); //for the admin-only page here
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
    <title>CDRRMO Sto. Tomas</title>
    <?php include 'nav-header.php'; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="dashboardContainer">
        <div class="displayCount bg-transparent">
            <h1>DISPLAY COUNT OF INCIDENT REPORTED</h1>

            <div id="dashboardContent"></div>
                
                <script>
                // get_counts.php  
                // Function to update incident counts
                function updateDashboard() {
                    // Use jQuery to make an AJAX request to get_counts.php
                    $.ajax({
                        url: 'get_counts.php',
                        type: 'GET',
                        success: function (data) {
                            // Update the content of the dashboard
                            $('#dashboardContent').html(data);
                        },
                        error: function (error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                }

                // Update the dashboard every second
                setInterval(updateDashboard, 1000);

                // Initial update when the page loads
                updateDashboard();
                </script>

        </div>
        
        <img src=".\Image\line.png" alt="" style="width: 99%; height: 15px; margin: 10px auto;"
        class="bg-transparent">

        <div class="secondContainer bg-transparent">
        <?php
$selectedMonth = isset($_POST['months']) ? $_POST['months'] : date("n");
$selectedYear = isset($_POST['year']) ? $_POST['year'] : date("Y");
?>

<div class="rankingBoard bg-transparent">
    <i class="fa-solid fa-ranking-star bg-transparent" style="margin-left: 20px; font-size: 30px;"></i>
    <label class="rankingLabel">Display Count of Incident Type</label><br>
    <form id="searchForm" method="post" action="ajax_handler.php" style="background: transparent;">
        <label for="months">Select Month:</label>
        <select name="months" id="months">
            <option value="all" <?php echo ($selectedMonth == 'all') ? 'selected' : ''; ?>>All Time</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value='$i' " . (($selectedMonth == $i) ? 'selected' : '') . ">" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="year">Select Year:</label>
        <select name="year" id="year">
            <option value="all" <?php echo ($selectedYear == 'all') ? 'selected' : ''; ?>>All Time</option>
            <?php
            $currentYear = date("Y");
            for ($i = $currentYear; $i <= $currentYear + 5; $i++) {
                echo "<option value='$i' " . (($selectedYear == $i) ? 'selected' : '') . ">$i</option>";
            }
            ?>
        </select>
        <br>
        <button type="button" onclick="search()"><i class="fa-solid fa-magnifying-glass bg-transparent"
                                style="font-size: 15px;"></i></button>
    </form>

    <!--<div class="printTable">
        <button onclick="printTable()"><i class="fa-solid fa-print"></i></button>
    </div>-->

    <script>
        function search() {
            var form = document.getElementById('searchForm');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'dashboard_table.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.querySelector('.table').innerHTML = xhr.responseText;
                }
            };
            xhr.send(formData);
        }

        function printTable() {
            var printContents = document.querySelector('.table').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
                            <div class="table">
                            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cdrrmo_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define incident types
$incidentTypes = ["Medical", "Trauma", "Extrication", "Cond-trans", "Stanby", "Pedestrian", "Missing-person", "Power-outage", "Self-accident", "Vehicular-accident", "Wound-care", "Crime", "Damaged-property", "Fire", "Telco-outage", "Flooding"];

// Define statuses
$statuses = ["Archived", "Verified", "Resolved"];

// Initialize default values
$selectedMonth = date("n"); // Set to the current month
$selectedYear = date("Y"); // Set to the current year

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if values are set, otherwise, use default values
    $selectedMonth = isset($_POST['months']) ? $_POST['months'] : date("n");
    $selectedYear = isset($_POST['year']) ? $_POST['year'] : $selectedYear;
}

echo '<table border="1">';
echo '<tr><th>Incident Type</th>'; // Empty cell for the top-left corner

// Display statuses in the first row
foreach ($statuses as $status) {
    echo "<th>$status</th>";
}
echo '</tr>';

// Display incident types and counts
foreach ($incidentTypes as $incidentType) {
    echo "<tr><td>$incidentType</td>";

    foreach ($statuses as $status) {
        $escapedIncidentType = str_replace('-', '_', $incidentType); // Replace hyphen with underscore
        $sql = "SELECT COUNT(*) AS count FROM incidents WHERE incident_type LIKE '%$incidentType%' AND status = '$status'";

        // Add filters for selected month and year
        if (!empty($selectedMonth) && $selectedMonth != 'all') {
            $sql .= " AND MONTH(date) = " . intval($selectedMonth);
        }
        if ($selectedYear !== 'all') {
            $sql .= " AND YEAR(date) = $selectedYear";
        }

        $result = $conn->query($sql);
        if ($result === false) {
            die("Error in SQL query: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        echo '<td>' . $row['count'] . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
                            </table>
                        </div>
            </div>

            <div class="mapping bg-transparent">
                <i class="fa-solid fa-map-location-dot bg-transparent"></i>
                <label for="">INCIDENT MAPPING</label>
                


                <div id="map">
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var map = L.map('map');
                
                            // Use Nominatim to get the coordinates for Sto. Tomas, Batangas
                            fetch('https://nominatim.openstreetmap.org/search?format=json&q=Sto. Tomas, Batangas')
                                .then(response => response.json())
                                .then(data => {
                                    const lat = parseFloat(data[0].lat);
                                    const lon = parseFloat(data[0].lon);
                
                                    map.setView([lat, lon], 13); // Centered around Sto. Tomas, Batangas
                
                                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19,
                                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                    }).addTo(map);
                
                                    // Array of marker coordinates in Sto. Tomas, Batangas
                                    var markerData = [
                                    { coordinates: [14.0653, 121.1925], name: 'Brgy San Ana' },
                                        { coordinates: [14.1108, 121.1414], name: 'Brgy I' },
                                        { coordinates: [14.1099, 121.1460], name: 'Brgy II' },
                                        { coordinates: [14.1055, 121.1382], name: 'Brgy III' },
                                        { coordinates: [14.1030, 121.1418], name: 'Brgy IV' },
                                        { coordinates: [14.0662, 121.2058], name: 'Brgy San Agustin' },
                                        { coordinates: [14.1185, 121.1561], name: 'Brgy San Antonio' },
                                        { coordinates: [14.1094, 121.1664], name: 'Brgy San Bartolome' },
                                        { coordinates: [14.0789, 121.1914], name: 'Brgy San Felix' },
                                        { coordinates: [14.0311, 121.2064], name: 'Brgy San Fernando' },
                                        { coordinates: [14.0411, 121.1898], name: 'Brgy San Francisco' },
                                        { coordinates: [14.0728, 121.1782], name: 'Brgy San Isidro Norte' },
                                        { coordinates: [14.0587, 121.1808], name: 'Brgy San Isidro Sur' },
                                        { coordinates: [14.0536, 121.1996], name: 'Brgy San Joaquin' },
                                        { coordinates: [14.0735, 121.1982], name: 'Brgy San Jose' },
                                        { coordinates: [14.0690, 121.2030], name: 'Brgy San Juan' },
                                        { coordinates: [14.0235, 121.1963], name: 'Brgy San Luis' },
                                        { coordinates: [14.0982, 121.1604], name: 'Brgy San Miguel' },
                                        { coordinates: [14.0823, 121.1865], name: 'Brgy San Pablo Nayon' },
                                        { coordinates: [14.0875, 121.1776], name: 'Brgy San Pedro' },
                                        { coordinates: [14.1246, 121.1388], name: 'Brgy San Rafael' },
                                        { coordinates: [14.0986, 121.1474], name: 'Brgy San Roque' },
                                        { coordinates: [14.0904, 121.1723], name: 'Brgy San Vicente' },
                                        { coordinates: [14.0675, 121.1945], name: 'Brgy Santa Ana' },
                                        { coordinates: [14.1357, 121.1358], name: 'Brgy Santa Anastacia' },
                                        { coordinates: [14.0265, 121.2037], name: 'Brgy Santa Clara' },
                                        { coordinates: [13.9863, 121.2123], name: 'Brgy Santa Cruz' },
                                        { coordinates: [14.1003, 121.1994], name: 'Brgy Santa Elena' },
                                        { coordinates: [14.0714, 121.1684], name: 'Brgy Santa Maria' },
                                        { coordinates: [14.0129, 121.1941], name: 'Brgy Santa Teresita' },
                                        { coordinates: [14.1168, 121.1415], name: 'Brgy Santiago' },
                                    ];
                
                                    // Load saved incidents data from local storage
                                    var savedIncidents = JSON.parse(localStorage.getItem('incidents')) || {};
                
                                    // Add markers for each coordinate with respective colors and names
                                    markerData.forEach(data => {
                                        var marker = L.marker(data.coordinates, { icon: createMarkerIcon(data.name, savedIncidents[data.name]) }).addTo(map);
                                        var incidentsCount = savedIncidents[data.name] || 0;
                                        var popupContent = `<b>${data.name}</b><br>Number of incidents: <span id="${data.name}-count">${incidentsCount}</span><br>
                                    <button class="popup-button" onclick="updateIncidents('${data.name}', 1)">+</button>
                                    <button class="popup-button" onclick="updateIncidents('${data.name}', -1)">-</button>
                                    <button class="popup-button" onclick="submitIncidents()">Save</button>`;
                                
                                        marker.bindPopup(popupContent, {
                                            className: 'custom-popup' // Add a class for further customization
                                        });
                                    });
                
                                    // Function to create custom marker icons
                                    function createMarkerIcon(name, incidentsCount) {
                                        // Determine color based on the incident count
                                        var color;
                                        if (incidentsCount >= 1 && incidentsCount <= 5) {
                                            color = 'green';
                                        } else if (incidentsCount >= 6 && incidentsCount <= 10) {
                                            color = 'yellow';
                                        } else if (incidentsCount >= 11 && incidentsCount <= 1000) {
                                            color = 'red';
                                        } else {
                                            color = 'blue'; // Default color if count is out of range
                                        }
                
                                        return L.icon({
                                            iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${color}.png`,
                                            iconSize: [20, 31],
                                            iconAnchor: [12, 41],
                                            popupAnchor: [1, -34],
                                            tooltipAnchor: [16, -28],
                                            shadowSize: [41, 41]
                                        });
                                    }
                
                                    // Function to increment or decrement incidents count
                                    window.updateIncidents = function (markerName, increment) {
                                        var countElement = document.getElementById(`${markerName}-count`);
                                        var currentCount = parseInt(countElement.innerText);
                                        var newCount = currentCount + increment;
                
                                        // Update local storage with the new count
                                        savedIncidents[markerName] = newCount;
                                        localStorage.setItem('incidents', JSON.stringify(savedIncidents));
                
                                        // Update marker color
                                        var marker = map._layers[Object.keys(map._layers).find(key => map._layers[key].feature && map._layers[key].feature.properties.name === markerName)];
                                        if (marker) {
                                            marker.setIcon(createMarkerIcon(markerName, newCount));
                                        }
                
                                        // Update count in the popup
                                        countElement.innerText = newCount;
                                    };
                
                                    // Function to reset incidents
                                    window.resetIncidents = function () {
                                        // Clear local storage
                                        localStorage.removeItem('incidents');
                
                                        // Reload the page
                                        location.reload();
                                    };
                
                                    // Function to submit incidents
                                    window.submitIncidents = function () {
                                        // Reload the page
                                        location.reload();
                                    };
                                })
                                .catch(error => console.error('Error:', error));
                        });
                    </script>
                </div>
            </div>
        </div>



        <img src=".\Image\line.png" alt="" style="width: 99%; height: 15px; margin: 10px auto;"
        class="bg-transparent">

        <div class="fbPlugins">
            <div class="sto-tomas-fb">
                    <h1>City of Sto. Tomas, Batangas</h1>
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" nonce="PaeF0Pcy"></script>
                    <div class="fb-page" data-href="https://www.facebook.com/STOTOMASLGU" data-tabs="timeline" data-width="500" data-height="700" data-small-header="false" 
                    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/STOTOMASLGU" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/STOTOMASLGU">The City of Sto.Tomas, Batangas</a></blockquote></div>
            </div>

            <div class="dost-fb">
                <h1>DOST PAGASA</h1>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" nonce="rPzmKPbd"></script>
                <div class="fb-page" data-href="https://www.facebook.com/PAGASA.DOST.GOV.PH" data-tabs="timeline" data-width="500" data-height="700" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/PAGASA.DOST.GOV.PH" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/PAGASA.DOST.GOV.PH">Dost_pagasa</a></blockquote></div>        
            </div>

            <div class="civil-def-fb">
                <h1>Civil Defense CALABARZON</h1>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" nonce="9F0QorYx"></script>
                <div class="fb-page" data-href="https://www.facebook.com/civildefense4a" data-tabs="timeline" data-width="500" data-height="700" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/civildefense4a" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/civildefense4a">Civil Defense CALABARZON</a></blockquote></div>
            </div>
        </div>

        <img src=".\Image\line.png" alt="" style="width: 99%; height: 15px; margin: 10px auto;"
        class="bg-transparent">

        <div class="widgetH1">
            <h1>WEATHER AND TRAFFIC UPDATE</h1>
        </div>
        <div class="widgetsContainer">
                <div class="row bg-transparent">
                    <div class="iframe-container bg-transparent">
                    <iframe class="iframe1" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;" src="https://embed.windy.com/embed2.html?lat=14.029&lon=121.158&detailLat=14.089&detailLon=121.154&width=400&height=500&zoom=11&level=surface&overlay=wind&product=ecmwf&menu=&message=&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=km%2Fh&metricTemp=%C2%B0C&radarRange=-1" frameborder="0"></iframe>
                </div>
            </div>
            <div class="row bg-transparent">
                    <div class="iframe-container bg-transparent">
                    <iframe class="iframe2" src="https://embed.waze.com/iframe?zoom=15&lat=14.125897&lon=121.136187&ct=livemap" allowfullscreen></iframe>
                </div>
            </div>
            <div class="row bg-transparent">
                    <div class="iframe-container bg-transparent">
                    <iframe class="iframe3" style="border-top-right-radius: 15px; border-bottom-right-radius: 15px;" src="https://www.meteoblue.com/en/weather/widget/three/quezon-city_philippines_1692192?geoloc=fixed&nocurrent=0&noforecast=0&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&layout=image"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox"></iframe>
                </div>
            </div>
        </div>

    </div>

    <style>
        body {
            background-color: #173381;
        }
        
        .dashboardContainer {
            display: flex;
            flex-direction: column;
            background-color: white;
            width: 82%;
            height: 95%;
            position: fixed;
            right: 10px;
            margin-top: 83px;
            border: 2px white solid;
            border-radius: 15px;
            overflow: scroll;
            padding-bottom: 20px;
        }

        .dashboardContainer::-webkit-scrollbar {
            display: block;
            width: 5px;
        }

        .dashboardContainer::-webkit-scrollbar-thumb {
            background: white;
            border-radius: 15px;
        }

        .dashboardContainer::-webkit-scrollbar-track {
            background: #173381;
        }
        
        .displayCount h1 {
            color: #173381;
            font-family: 'Mulish', sans-serif;
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }

        .numbersContainer {   
            background-color: #e7e7e7;
            width: 70%;
            height: fit-content;
            margin: 10px auto;
            text-align: center;
            font-family: 'Mulish', sans-serif;
            border-radius: 15px;
            font-weight: bold;
            display: grid;
            grid-template-columns: repeat(3, auto);
            z-index: 1;
       }

       .numbersContainer label {
            background-color: transparent;
            color: #173381;
            margin: 10px 5%;
       }

       .numbersContainer span {
            background-color: #e7e7e7;
            margin-top: -30px;
            color: #173381;
            font-size: 70px;
       }

       .secondContainer {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
           
       }



       

    /*simula dtio yung sa table*/
       form {
        padding-bottom: 5px;
        display: flex;
        margin-left: 20px;
    }

    label, select, input {
        font-size: 15px;
        color: #173381; 
        background-color: transparent;
        margin-left: 10px;
        
    }  

    label {
        margin-top: 6px;
        font-size: 15px;
        color: black; /* White text color */
        background-color: transparent;
    }  
    label.rankingLabel {
        
        color: black;
        background-color: transparent;
        color: black;
        background-color: transparent;
        font-family: 'Mulish', sans-serif;
        font-size: 25px;
        font-weight: bold;
        }

    select, input[type="submit"] {
        
        padding: 2px;
        border: none;
        border-radius: 4px;
        background-color: #173381; /* Dark blue background color for the select and submit button */
        color: #fff; 
        cursor: pointer;
    }

    .printTable button {
        float: right;
        margin-top: -50px;
        font-size: 30px;
        margin-right: 10px;
    }

    table {
        border: 1px black solid;
        width: 98%;
        color: #001f3f; 
        margin-left: 15px;
    }

    th {
        
        border-bottom: 1px black solid;
        padding: 8px;
        text-align: center;
        color: white;
        background-color: white;
        
    }

    td {
        border-bottom: 1px black solid;
        padding: 8px;
        text-align: center;
        border-width: 0;
        border-bottom: 1px black solid;
        background: transparent;
    }

    th {
        background-color: #173381; /* Updated color for table header */
        
        border-width: 0;
        border-bottom: 1px black solid;
    }

    tr:nth-child(even) {
        background-color: #bfd2ff; /* Alternate color for even rows */
        border-right: none;
        font-weight: 500;
    }

    tr:nth-child(odd) {
        background-color: #fff; /* Default color for odd rows */
        border-right: none;
        font-weight: 500;
    }

        .mapping label {
            color: black;
            background-color: transparent;
            font-family: 'Mulish', sans-serif;
            font-size: 25px;
            font-weight: bold;
        }

        .mapping i {
            margin-top: 5px;
            font-size: 40px;
        }

        .mapping select {
            color: white;
            width: 95%;
            height: 30px;
            margin: 3px 20px;
            padding-left: 7px;
            border-radius: 7px;
            font-size: 20px;
            font-weight: bold;
            border: none;
        }

        #map {
            margin: 7px auto;
            width: 95%;
            height: 90.4%;
            border: 1px solid black;
        }

        .fbPlugins {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
            padding-bottom: 10px;
        }

        .fbPlugins h1 {
            color: black;
            text-align: center;
            font-size: 25px;
            font-weight: 400;
            margin: 0;
            font-family: 'Mulish', sans-serif;
            background-color: #173381;
            width: 99%;
            color: white;
            border-top-right-radius: 15px;
            border-top-left-radius: 15px;
            margin-left: 1.5%;
        }

        .fb-page {
            min-width: 100%;
            margin-left: 1.5%;
        }

        .widgetH1 {
            background-color: white;
            width: 99%;
            height: fit-content;
            margin: 15px auto;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
       }

       .widgetH1 h1 {
            color: black;
            text-align: center;
            font-family: 'Mulish', sans-serif;
            font-weight: bold;
            font-size: 25px;
            margin-top: -10px;
       }

       .widgetsContainer {
            background-color: white;
            width: 99%;
            height: fit-content;
            margin: 10px auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-top: -20px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
       }

       .widgetsContainer h1 {
            color: black;
       }

        .iframe-container {
            position: inherit;
            margin: 5px;
            overflow: hidden;
        }   

        iframe {
            width: 97%;
            height: 550px;
        }

        .leaflet-touch .leaflet-control-layers, .leaflet-touch .leaflet-bar {
            border: 2px solid rgba(0,0,0,0.2);
            background-clip: padding-box;
            background: transparent;
        }

        @media screen and (max-width: 1555px) and (min-width: 320px) {
            .dashboardContainer {
                width: 98%;
            }
        }

        @media screen and (max-width: 1950px) and (min-width: 1610px) {
            .dashboardContainer {
                min-width: 85.4%;
            }

            .fb-page {
                min-width: 100%;
            }

            .fbPlugins h1 {
                width: 95.3%;
            }
        }

        @media print {
            body {
                text-align: center;
            }

            table {
                text-align: center;
            }
        }
    </style>
</body>
</html> 