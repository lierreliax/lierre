<?php
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "personal_web_log_register";

// Create connection
$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
