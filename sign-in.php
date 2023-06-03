<?php
// Include the database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form data is present
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Retrieve form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if any field is blank
        if (empty($username) || empty($password)) {
            echo 'Please fill in all the required fields.';
        } else {
            // Perform the database query to check if the user exists
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($connection, $query);

            // Check if the query was successful
            if ($result && mysqli_num_rows($result) > 0) {
                // User exists, do something (e.g., log in the user)
                echo 'Sign in successful!';

                // Start the session
                session_start();

                // Store user information in session variables
                $_SESSION['username'] = $username;

                // Redirect to a different page
                header('Location: home.php');
                exit(); // Make sure to exit after redirecting
            } else {
                // User does not exist or incorrect credentials, display an error message
                echo 'Invalid username or password.';
            }
        }
    } else {
        // Form data is missing
        echo 'Please fill in all the required fields.';
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="english">
  <head>
    <title>Sign-in - exported project</title>
    <meta property="og:title" content="Sign-in - exported project" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div>
      <link href="./sign-in.css" rel="stylesheet" />
      <div class="sign-in-container">
        <div class="sign-in-sign-in">
          <div class="sign-in-sign-inlogo">
            <div class="sign-in-logo">
              <img
                alt="Group522744"
                src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/daf7dc61-5006-4218-b68f-904fa2e93d32?org_if_sml=1852"
                class="sign-in-group52"
              />
              <span class="sign-in-text"><span>Inventory.id</span></span>
            </div>
            <div class="sign-in-wave">
              <img
                alt="Rectangle352747"
                src="public/external/rectangle352747-8gv.svg"
                class="sign-in-rectangle35"
              />
              <img
                alt="Rectangle322747"
                src="public/external/rectangle322747-9e5o.svg"
                class="sign-in-rectangle32"
              />
              <img
                alt="Rectangle342747"
                src="public/external/rectangle342747-ezh.svg"
                class="sign-in-rectangle34"
              />
              <img
                alt="Rectangle292747"
                src="public/external/rectangle292747-bngr.svg"
                class="sign-in-rectangle29"
              />
              <img
                alt="Rectangle312747"
                src="public/external/rectangle312747-edq.svg"
                class="sign-in-rectangle31"
              />
              <img
                alt="Rectangle332747"
                src="public/external/rectangle332747-xcmq.svg"
                class="sign-in-rectangle33"
              />
            </div>
          </div>
          <div class="sign-in-sign-insection">
            <img
              alt="SignInframe2743"
              src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/9fa5a065-0980-48e8-b1e3-2a11dd6733fb?org_if_sml=15234"
              class="sign-in-sign-inframe"
            />
            <form method="POST" action="sign-in.php">
            <div class="sign-in-sign-infill">
              <div class="sign-in-username">
                <img
                  alt="Rectangle82747"
                  src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/5f94341a-f9f7-456b-9d3c-67e416398496?org_if_sml=1124"
                  class="sign-in-rectangle8"
                />
                <span class="sign-in-text02"><span>Username</span></span>
                <input
                  type="text"
                  name="username"
                  required=""
                  placeholder="ex. johndoe"
                  class="sign-in-username-input input"
                />
              </div>
              <div class="sign-in-password">
                <img
                  alt="Rectangle82741"
                  src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/796ce57e-e31b-4aef-a2dd-27bd402f22dc?org_if_sml=1124"
                  class="sign-in-rectangle81"
                />
                <span class="sign-in-text04"><span>Password</span></span>
                <input
                  type="password"
                  name="password"
                  required=""
                  placeholder="password"
                  class="sign-in-password-input input"
                />
              </div>
              <span class="sign-in-text06"><span>Sign in</span></span>
              <div class="sign-in-group11">
                <div class="sign-in-sign-in-button button">
                  <img
                    alt="Rectangle92741"
                    src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/792314eb-a16b-476d-b799-c315719d213f?org_if_sml=1697"
                    class="sign-in-rectangle9"
                  />
                  <span class="sign-in-text08" onclick="submitForm()">Sign in</span>
                </div>
                </form>
                <script>
                function submitForm() {
                  // Get the form element
                  var form = document.querySelector('form');
                  // Submit the form
                  form.submit();
                }
                </script>
                <span class="sign-in-text09">Don't have an account?</span>
                <a href="sign-up.php" class="sign-in-text10">Sign up</a>
              </div>
            </div>
            <span class="sign-in-text11">
              <span>
                Copyright © 2023 Inventory.id. All rights reserved. | Privacy
                Policy | Terms of Service
              </span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
