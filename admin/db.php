<?php
// Database configuration
$servername = "localhost";
$username   = "root";       // change if needed
$password   = "";           // change if needed
$dbname     = "greenfieldweb";
$port       = 3306;         // MySQL default port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
?>

