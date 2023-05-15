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
<html>
<head>
  <title>Login Page</title>
</head>
<body>
  <h2>Login</h2>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <input type="submit" value="Login">
  </form>
  
  <p>Don't have an account? <a href="signup.php">Sign up</a></p>
  
  <?php
  if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
  }
  ?>
</body>
</html>
