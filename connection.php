<?php
$servername = "localhost";  // replace with your server name if different
$username = "root";         // replace with your MySQL username
$password = "";             // replace with your MySQL password
$database = "inventory.id";  // replace with the name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
