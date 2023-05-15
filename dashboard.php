<?php
session_start();

// Check if the session variable exists and display the username
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      display: flex;
      justify-content: space-between;
    }

    .sidebar {
      width: 200px;
      background: #f2f2f2;
      padding: 20px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar li {
      margin-bottom: 10px;
    }

    .sidebar li a {
      text-decoration: none;
      font-weight: bold;
    }

    .content {

?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      display: flex;
      justify-content: space-between;
    }

    .sidebar {
      width: 200px;
      background: #f2f2f2;
      padding: 20px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar li {
      margin-bottom: 10px;
    }

    .sidebar li a {
      text-decoration: none;
      font-weight: bold;
    }

    .content {
      flex: 1;
      padding: 20px;
    }

    .top-right {
      text-align: right;
    }

    .top-right a {
      text-decoration: none;
      background-color: #f2f2f2;
      color: #333;
      padding: 5px 10px;
      border-radius: 4px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <ul>
      <li><a href="#" style="font-weight: bold;">Dashboard</a></li>
      <li><a href="#">Inventory</a></li>
      <li><a href="#">Profile</a></li>
    </ul>
  </div>
  <div class="content">
    <div class="top-right">
      <a href="#"><?php echo $_SESSION['username']; ?></a>
    </div>
    <h2>Welcome to the Dashboard</h2>
    <!-- Add your dashboard content here -->
  </div>
</body>
</html>
