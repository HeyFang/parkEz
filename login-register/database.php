<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";

$dbName = "login_register";

$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



