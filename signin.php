<?php
// Include the database connection file
include 'connection.php';

// Define variables for feedback messages
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have collected the user's information in variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password
        if ($password == $user['password']) {
            // Password is correct, redirect to the desired page
            header("Location: dashboard.php"); // Replace "dashboard.php" with the actual dashboard page
            exit();
        } else {
            // Password is incorrect
            $errorMessage = "Invalid password. Please try again.";
        }
    } else {
        // User does not exist
        $errorMessage = "User not found. Please check your username.";
    }

    // Close the statement
    $stmt->close();
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
    <link href="path/to/roboto.css" rel="stylesheet">
    <script>
        // Function to display error messages as pop-up alerts
        function showError(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="Signup">
            <form action="signin.php" method="POST"> <!-- Specify the PHP file and method -->
                <h1> Inventory.id</h1>
                <hr>
                <p>Login</p>
                <label for="">Username</label>
                <input type="text" name="username" placeholder="Username">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password">
                
                <button type="submit">Login</button> <!-- Added the submit type -->
                <p>Don't have an account?</p>
                <p>
                    <a href="signup.php">Sign Up</a>
                </p>

                <!-- Display error message as pop-up alert -->
                <?php if (!empty($errorMessage)) { ?>
                    <script>showError('<?php echo $errorMessage; ?>');</script>
                <?php } ?>
            </form>
        </div>
        <div class="right">
            <img src="assets/inventory.jpg" alt="inventory.jpg">
        </div>
    </div>
</body>

</html>
