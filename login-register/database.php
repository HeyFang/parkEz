<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login_register";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>