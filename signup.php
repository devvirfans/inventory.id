<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];

  $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // User or email already exists, display error message
    $error = "Username or email already exists.";
  } else {
    // Insert the new user data into the database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
      // User registration successful, redirect to login page
      header("Location: login.php");
      exit;
    } else {
      // Error occurred while inserting data, display error message
      $error = "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Page</title>
        <link href="signupStyle.css" rel="stylesheet" />
    </head>
    <body>
          <div class="logopict">

          </div>

            <span class="logoname">Inventory.id</span>

            <div class="box">

            </div>
           
                <div class="lineEmail">

                </div>
                <span class="email">Email</span>
            
          
                <div class="lineUsn">

                </div>
                <span class="usn">Username</span>
            
                <div class="linePw">

                </div>
                <span class="pw">Password</span>
            
                <span class="signupA">Sign up</span>
                <div class="boxsignupB">

                </div>
                <span class="signupB">Sign up</span>
                

                <span class="switch">Already have an account? </span>
                <span class="switch2">Sign in</span>
</body>
</html>
