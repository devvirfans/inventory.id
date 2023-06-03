<?php
// Include the database connection file
include 'connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  // Redirect to the sign-in page or any other appropriate action
  header('Location: sign-in.php');
  exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $store_id = $_POST['store_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    // Insert the new item into the database
    $insert_query = "INSERT INTO inventory (store_id, product_id, quantity) VALUES ('$store_id', '$product_name', '$quantity')";
    $insert_result = mysqli_query($connection, $insert_query);

    // Check if the item was inserted successfully
    if ($insert_result) {
        // Redirect to the inventory page or any other appropriate action
        header('Location: inventory.php');
        exit();
    } else {
        // Handle the error, such as displaying an error message
        echo "Failed to add the item. Please try again.";
    }
}
