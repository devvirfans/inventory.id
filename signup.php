<?php
// Include the database connection file
include 'connection.php';

// Define variables for feedback messages
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have collected the user's information in variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullName = ""; // Modify this if you have a field for full name in your HTML form
    $address = ""; // Modify this if you have a field for address in your HTML form

    // Check if the username already exists
    $checkUsernameStmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUsernameStmt->bind_param("s", $username);
    $checkUsernameStmt->execute();
    $checkUsernameResult = $checkUsernameStmt->get_result();

    // Check if the email already exists
    $checkEmailStmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkUsernameResult->num_rows > 0) {
        // Username already exists
        $errorMessage = "Username already exists. Please choose a different username.";
    } elseif ($checkEmailResult->num_rows > 0) {
        // Email already exists
        $errorMessage = "Email already exists. Please use a different email address.";
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, full_name, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $password, $fullName, $address);

        // Execute the statement
        if ($stmt->execute()) {
            // User inserted successfully
            $successMessage = "User inserted successfully.";
            
            // Redirect to the dashboard page
            header("Location: dashboard.php");
            exit();
        } else {
            // Failed to insert user
            $errorMessage = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the check username statement
    $checkUsernameStmt->close();

    // Close the check email statement
    $checkEmailStmt->close();
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
    <script>
        // Function to display success or error messages as pop-up alerts
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="Signup">
            <form action="signup.php" method="POST"> <!-- Specify the PHP file and method -->
                <h1> Inventory.id</h1>
                <hr></hr>
                <p>Sign Up</p>
                <label for="">Username</label>
                <input type="text" name="username" placeholder="Username">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="email@gmail.com">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password">
                
                <button type="submit">Sign Up</button> <!-- Added the submit type -->
                <p>Already have an account?</p>

                <!-- Display error or success messages as pop-up alerts -->
                <?php if (!empty($errorMessage)) { ?>
                    <script>showAlert('<?php echo $errorMessage; ?>');</script>
                <?php } elseif (!empty($successMessage)) { ?>
                    <script>showAlert('<?php echo $successMessage; ?>');</script>
                <?php } ?>

                <p>
                    <a href="signin.php">Login</a>
                </p>
            </form>
        </div>
        <div class="right">
            <img src="assets/inventory.jpg" alt="inventory.jpg">
        </div>
    </div>
</body>

</html>
