

<?php
$host = "localhost"; // Database host
$username = "razvan"; // Database username
$password = "password1"; // Database password
$database = "phpmuzike"; // Database name

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
