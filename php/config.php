<?php
$servername = "localhost"; // Change if using a remote database
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "chat"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
