<?php
// Include the database connection file
include 'connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  // Redirect to the sign-in page or any other appropriate action
  header('Location: sign-in.php');
  exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="english">
  <head>
    <title>Home - exported project</title>
    <meta property="og:title" content="Home - exported project" />
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
      <link href="./home.css" rel="stylesheet" />

      <div class="home-container">
        <div class="home-home">
          <div class="home-home-text">
            <img
              alt="image33144"
              src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/e555b7d9-e5d1-4b1d-bc7d-db0edffae49c?org_if_sml=194"
              class="home-image3"
            />
            <div class="home-home-user">
              <span class="home-text">
                <span class="home-text01">Welcome,</span>
                <span class="home-text02"></span>
                <span class="home-text03"><?php echo $username; ?>!</span>
              </span>
            </div>
            <div class="home-home-title">
              <span class="home-text04">
                <span class="home-text05">"</span>
                <span class="home-text06">An</span>
                <span class="home-text07">Optimized</span>
                <span class="home-text08">Business is a</span>
                <span class="home-text09">Successful</span>
                <span class="home-text10">Business!</span>
                <span class="home-text05">"</span>
              </span>
            </div>
          </div>
          <div class="home-home-heading">
            <img
              alt="logo3144"
              src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/90db2a84-5445-482c-8cfe-8391747403bb?org_if_sml=14475"
              class="home-logo"
            />
            <span class="home-text11"><span>Home</span></span>
            <p class="home-text13"><a href="inventory.php">Inventory</a></p>
            <a href="profile.php" class="home-text15"><span>Profile</span></a>
            <a href="sign-in.php" class="home-text17"><span>Log Out</span></a>
          </div>
          <img
            alt="Wave3145"
            src="public/external/wave3145-wveg.svg"
            class="home-wave"
          />
          <img
            alt="POSmachine3193"
            src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/4ff2d9f3-ea45-4600-9eb2-cd24f15d0256?org_if_sml=1152096"
            class="home-p-smachine"
          />
          <img
            alt="POSmachine3214"
            src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/cc324f9c-d49d-4e1d-90f5-421098ed5bc3?org_if_sml=1155615"
            class="home-p-smachine1"
          />
        </div>
        <div class="home-frame7">
          <span class="home-text19">
            <span>
              Copyright © 2023 Inventory.id. All rights reserved. | Privacy
              Policy | Terms of Service
            </span>
          </span>
          <div class="home-group61">
            <div class="home-group60">
              <img
                alt="logo3123"
                src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/bb4fd9d6-1676-4fd3-8240-4d91e1db165a?org_if_sml=17270"
                class="home-logo1"
              />
              <span class="home-text21">
                <span>
                  Simplify Your Inventory Management Today with Inventory.id
                </span>
              </span>
            </div>
            <span class="home-text23">
              <span>
                Unlock the full potential of your business with our intuitive
                inventory management solution. Say goodbye to manual tracking
                and embrace the convenience of Inventory.id. Join our growing
                community of satisfied customers and experience the difference.
              </span>
            </span>
          </div>
          <img
            alt="Line163123"
            src="public/external/line163123-9l05.svg"
            class="home-line16"
          />
        </div>
      </div>
    </div>
  </body>
</html>
