<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory.id";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die('Failed to connect to the database: ' . mysqli_connect_error());
}
?>
