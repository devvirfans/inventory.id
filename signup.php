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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link rel="stylesheet" href="signupStyle.css">
</head>

<body>
    <div class="container">
        <div class="Signup">
            <form action="">
                <h1> Inventory.id</h1>
                <hr>
                <p>Sign Up</p>
                <label for="">Username</label>
                <input type="usn" placeholder="Username">
                <label for="">Email</label>
                <input type="email" placeholder="email@gmail.com">
                <label for="">Password</label>
                <input type="password" placeholder="Password">
                
                <button>Sign Up</button>
                <p>Already have an account?</p>
                <p>
                    <a href="#">Login</a>
                </p>
            </form>
        </div>
        <div class="right">
            <img src="inventory.jpg" alt="">
        </div>
    </div>
</body>

</html>