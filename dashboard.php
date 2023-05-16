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
  <link rel="stylesheet" type="text/css" href="dashboard.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
</head>
<body>
<div class="sidebar">
  <ul>
    <li><div class="logo"><img src="Elements/logo.png" alt="Logo"></div></li>
    <li><a href="#" style="font-size: 32px">Inventory.id</a></li>
    <li><a href="#" class="dashboard">Dashboard</a></li>
    <li><a href="#" class="inventory">Inventory</a></li>
    <li><a href="#" class="profile">Profile</a></li>
  </ul>
</div>


  
  <div class="content">
    <div class="top-right">
      <a href="#"><?php echo $_SESSION['username'];?></a>
    </div>
    <div class="middle">
      <div class="box box-1"></div>
      <div class="box box-2"></div>
      <div class="box box-3"></div>
      <div class="box box-4"></div>
    </div>
  </div>
</body>
</html>

