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
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login Page</title>
      <link href="signinStyle.css" rel="stylesheet" />
  
      </head>
        <body>
        <div class="logopict">

        </div>

        <span class="logoname">Inventory.id</span>

        <div class="box">

        </div>

          <div class="lineUsn">

          </div>
          <span class="usn">Username</span>
      
          <div class="linePw">

          </div>
          <span class="pw">Password</span>
      
          <span class="signinA">Sign in</span>
          <div class="boxsigninB">

          </div>
          <span class="signinB">Sign in</span>
          

          <span class="switch">Don't have an account? </span>
          <span class="switch2">Sign up</span>
                  
        </body>
</html>