<?php

$hostName = "localhost";
$dbUser = "u178921235_cdrrmo";
$dbPassword = "Cdrrmo2023@";
$dbName = "u178921235_cdrrmo_db";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>