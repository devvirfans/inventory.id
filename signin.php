<?php
session_start();
require 'connection.php';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Perform any necessary validation or sanitization on the form data

  // Check if the user credentials are valid
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // User credentials are valid
    $_SESSION["username"] = $username; // Set the session variable
    header("Location: dashboard.php");
    exit;
  } else {
    // Invalid user credentials, display error message
    $error = "Invalid username or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="signinStyle.css">
</head>

<body>
    <div class="container">
        <div class="Signup">
            <form action="">
                <h1> Inventory.id</h1>
                <hr>
                <p>Login</p>
                <label for="">Username</label>
                <input type="usn" placeholder="Username">
                <label for="">Password</label>
                <input type="password" placeholder="Password">
                
                <button>Login</button>
                <p>Don't have an account?</p>
                <p>
                    <a href="#">Sign Up</a>
                </p>
            </form>
        </div>
        <div class="right">
            <img src="inventory.jpg" alt="">
        </div>
    </div>
</body>

</html>