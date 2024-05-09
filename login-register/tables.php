<?php

require_once './database.php';
try {

    $userTable = $conn->query(
        "CREATE TABLE users(
    id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100), 
    email VARCHAR(100) UNIQUE, 
    password VARCHAR(100),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)"
    );

    $bookingTable = $conn->query("CREATE TABLE booking(
    id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50),
    city VARCHAR(50),
    area VARCHAR(50),
    date TIMESTAMP,
    time VARCHAR(50),
    available_spot VARCHAR(50)
    )");

    if ($userTable) {
        echo "User Table Created Successfully";
    }

    if ($bookingTable) {
        echo "Booking Table Created Successfully";
    }
} catch (Exception $e) {
    echo  $e->getMessage();
}
