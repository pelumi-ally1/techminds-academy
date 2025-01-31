<?php
$host = "localhost"; // Change if necessary
$user = "root"; // Your database username
$password = ""; // Your database password
$dbname = "farmers_market"; // Your database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>