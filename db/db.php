<?php 
$servername = "localhost";
$username = "u810920872_ahttc";
$password = "Admin@ahttc12";
$dbname = "u810920872_ahttc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
