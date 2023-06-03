<?php

include 'connection.php';

session_start();

// Get the user's updated information from the request
$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];
$full_name = $_POST['full_name'];
$address = $_POST['address'];

// Perform any necessary data validation or sanitization here

// Prepare the update query
$query = "UPDATE users SET username = '$username', email = '$email', full_name = '$full_name', address = '$address' WHERE user_id = $user_id";

// Execute the update query
$result = mysqli_query($connection, $query);

// Check if the update was successful
if ($result) {
    // Update successful
    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
} else {
    // Update failed
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
}

// Close the database connection
mysqli_close($connection);
?>
