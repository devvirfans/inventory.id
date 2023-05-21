<?php
// Include the connection file
include('connection.php');

// Define initial profile information
$current_username = '';
$current_email = '';
$current_password = '';
$current_fullname = '';
$current_address = '';
$current_profilepic = '';

// Retrieve the current profile information from the database
$query = "SELECT username, email, password, full_name, address, profile_picture FROM users LIMIT 1";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $current_username = $row['username'];
        $current_email = $row['email'];
        $current_password = $row['password'];
        $current_fullname = $row['full_name'];
        $current_address = $row['address'];
        $current_profilepic = $row['profile_picture'];
    }
    $result->free();
} else {
    die("Error retrieving profile information: " . $conn->error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];

    // Update the profile information if the "Apply Changes" button is clicked
    if (isset($_POST['submit'])) {
        // Perform validation and update the profile information in the database
        $updateQuery = "UPDATE users SET username = '$username', email = '$email', password = '$password', full_name = '$fullname', address = '$address' LIMIT 1";
        if ($conn->query($updateQuery)) {
            // Update the current profile information
            $current_username = $username;
            $current_email = $email;
            $current_password = $password;
            $current_fullname = $fullname;
            $current_address = $address;
        } else {
            die("Error updating profile information: " . $conn->error);
        }
    }
    // Revert the profile information if the "Revert Changes" button is clicked
    elseif (isset($_POST['revert'])) {
        // Retrieve the original profile information from the database
        $revertQuery = "SELECT username, email, password, full_name, address, profile_picture FROM users LIMIT 1";
        $revertResult = $conn->query($revertQuery);
        if ($revertResult) {
            $revertRow = $revertResult->fetch_assoc();
            if ($revertRow) {
                $username = $revertRow['username'];
                $email = $revertRow['email'];
                $password = $revertRow['password'];
                $fullname = $revertRow['full_name'];
                $address = $revertRow['address'];
                $current_profilepic = $revertRow['profile_picture'];
            }
            $revertResult->free();
        } else {
            die("Error reverting profile information: " . $conn->error);
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Account Profile</title>
  <link rel="stylesheet" type="text/css" href="profile.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
</head>
<body>
  <div class="sidebar">
    <ul>
      <li>
        <div class="logo">
          <img src="Elements/logo.png" alt="Logo">
        </div>
      </li>
      <li><a href="#" style="font-size: 32px; font-weight: bold;">Inventory.id</a></li>
      <li><a href="#" class="dashboard">Dashboard</a></li>
      <li><a href="#" class="inventory">Inventory</a></li>
      <li><a href="#" class="profile">Profile</a></li>
    </ul>
  </div>

  <div class="profile-container">
    <h1>Account Profile</h1>
  
    <div class="profile-picture"></div>
  
    <div class="profile-info">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $current_username; ?>" />
    
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $current_email; ?>" />
    
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $current_password; ?>" />
    
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" value="<?php echo $current_fullname; ?>" />
    
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $current_address; ?>" />
    
        <div class="submit-btn">
          <button type="submit" name="submit">Apply Changes</button>
          <button type="submit" name="revert">Revert Changes</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
