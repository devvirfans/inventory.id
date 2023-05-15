<?php
require 'connection.php';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];

  // Perform any necessary validation or sanitization on the form data

  // Check if the username or email already exists
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
<html>
<head>
  <title>Sign Up Page</title>
</head>
<body>
  <h2>Sign Up</h2>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <input type="submit" value="Sign Up">
  </form>
  
  <p>Already have an account? <a href="login.php">Sign In</a></p>
  
  <?php
  if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
  }
  ?>
</body>
</html>
