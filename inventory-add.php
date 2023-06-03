<?php
// Include the database connection file
include 'connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  // Redirect to the sign-in page or any other appropriate action
  header('Location: sign-in.php');
  exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Retrieve user information from the database
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
  // Fetch user data
  $row = mysqli_fetch_assoc($result);
  $userID = $row['user_id'];
  $email = $row['email'];
  $fullName = $row['full_name'];
  $address = $row['address'];
  $profile_picture = $row['profile_picture'];
  
} else {
  // Handle the case where user data is not found
  // Redirect to an appropriate page or display an error message
  header('Location: error.php');
  exit();
}

// Update user information if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the new values from the form
  $newUsername = $_POST['username'];
  $newEmail = $_POST['email'];
  $newFullName = $_POST['full_name'];
  $newAddress = $_POST['address'];
  $newPassword = $_POST['password'];

  if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    // Retrieve the uploaded file details
    $tmpFilePath = $_FILES['profile_picture']['tmp_name'];
    $fileSize = $_FILES['profile_picture']['size'];
    $fileType = $_FILES['profile_picture']['type'];

    // Check the file type (assuming it should be an image)
    if (strpos($fileType, 'image') !== false) {
      // Read the contents of the uploaded file
      $uploadedImage = file_get_contents($tmpFilePath);

      // Update the user's profile picture in the database
      $updateQuery .= ", profile_picture='" . mysqli_real_escape_string($connection, $uploadedImage) . "'";
    } else {
      // Handle the case where the uploaded file is not an image
      header('Location: error.php');
      exit();
    }
  }

  // Check if username and email are not empty
  if (!empty($newUsername) && !empty($newEmail)) {
    // Update the user's information in the database
    $updateQuery = "UPDATE users SET username='$newUsername', email='$newEmail', full_name='$newFullName', address='$newAddress'";

    // Update the password if provided
    if (!empty($newPassword)) {
      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $updateQuery .= ", password='$hashedPassword'";
    }

    // Append the profile picture update query if a new picture was uploaded
    if (isset($uploadedImage)) {
      $updateQuery .= ", profile_picture='" . mysqli_real_escape_string($connection, $uploadedImage) . "'";
    }

    $updateQuery .= " WHERE user_id='$userID'";

    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
      // Update successful, redirect to profile page or any other appropriate action
      header('Location: profile.php');
      exit();
    } else {
      // Update failed, handle the error accordingly
      header('Location: error.php');
      exit();
    }
  }
}

// Close the database connection
mysqli_close($connection);
?>




<!DOCTYPE html>
<html lang="english">
  <head>
    <title>Profile - exported project</title>
    <meta property="og:title" content="Profile - exported project" />
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <div>
      <link href="./inventory-add.css" rel="stylesheet" />

      <div class="profile-container">
        <div class="profile-profile">
          <div class="profile-heading">
            <img
              alt="logo3161"
              src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/bea0eae2-270e-4b27-8ba7-395b97056ecc?org_if_sml=14475"
              class="profile-logo"
            />
            <a href="home.php" class="profile-text"><span>Home</span></a>
            <span class="profile-text02"><span>Inventory</span></span>
            <span class="profile-text04"><span>Profile</span></span>
            <a href="sign-in.php" class="profile-text06">
              <span>Log Out</span>
            </a>
          </div>
          <div class="profile-profile-settings">
            <img
              alt="Rectangle453161"
              src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/10ccb3b7-3b33-4ee5-9324-2abec5d49d10?org_if_sml=18126"
              class="profile-rectangle45"
            />
            <div class="profile-background">
              <img
                alt="Smallone3221"
                src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/e4a232ac-fff9-4ddc-8d60-aebcedd8c675?org_if_sml=13184"
                class="profile-smallone"
              />
              <img
                alt="Bigone3221"
                src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/adfa4b39-bd95-457d-9d2c-7a3fcf8e5522?org_if_sml=15728"
                class="profile-bigone"
              />
              <img
                alt="Wave3224"
                src="public/external/wave3224-u3rg.svg"
                class="profile-wave"
              />
            </div>
            <form method="POST" action="profile.php" enctype="multipart/form-data">
            <div class="profile-userdetails">
              <div class="profile-username">
                <img
                  alt="Rectangle83161"
                  src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/b80e550e-16a6-4d75-89a8-6cf82b438a4f?org_if_sml=1127"
                  class="profile-rectangle8"
                />
                <span class="profile-text08">
                  <span>Username</span>
                  <span class="profile-text10">*</span>
                </span>
                <input
                  type="text"
                  name="username"
                  placeholder="Username"
                  value="<?php echo $username; ?>"
                  class="profile-textinput input"
                />
              </div>
              <div class="profile-email">
                <img
                  alt="Rectangle83161"
                  src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/fb967156-50b3-49ee-9d59-ad56ce1640e5?org_if_sml=1127"
                  class="profile-rectangle81"
                />
                <span class="profile-text11">
                  <span>Email</span>
                  <span class="profile-text13">*</span>
                </span>
                <input
                  type="email"
                  name="email"
                  placeholder="Email"
                  value="<?php echo $email; ?>"
                  class="profile-textinput1 input"
                />
              </div>
              <div class="profile-fullname">
                <img
                  alt="Rectangle83161"
                  src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/6d6d1eb3-ef32-49d6-9b93-e390c89d2b23?org_if_sml=1127"
                  class="profile-rectangle82"
                />
                <span class="profile-text14"><span>Full Name</span></span>
                <input
                  type="text"
                  name="full_name"
                  placeholder="Full Name"
                  value="<?php echo $fullName; ?>"
                  class="profile-textinput2 input"
                />
              </div>
              <div class="profile-address">
                <img
                  alt="Rectangle83161"
                  src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/394ee450-deb4-4660-91be-9d5411d73c65?org_if_sml=1127"
                  class="profile-rectangle83"
                />
                <span class="profile-text16"><span>Address</span></span>
                <input
                  type="text"
                  name="address"
                  placeholder="Address"
                  value="<?php echo $address; ?>"
                  class="profile-textinput3 input"
                />
              </div>
              <div class="profile-password">
                <img
                  alt="Rectangle83221"
                  src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/de1801c8-30ec-4643-add5-eb37dd864c38?org_if_sml=1127"
                  class="profile-rectangle84"
                />
                <span class="profile-text18"><span>Password</span></span>
                <input
                  type="password"
                  name="password"
                  placeholder="Password"
                  class="profile-textinput4 input"
                />
              </div>
            </div>
            <div class="profile-apply-changes button" onclick="submitForm()">
              <span class="profile-text20">Apply changes</span>
            </div>
            <div class="profile-revert-changes button" onclick="location.reload()">
              <span class="profile-text21"><span>Revert Changes</span></span>
            </div>
            <!-- ...existing HTML code... -->
            <div class="profile2-profile-picture">
              <div class="profile2-frame">
             
                <div class="profile2-image-container">
                  <?php if ($profile_picture): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($profile_picture); ?>" alt="custom1.png" class="profile2-image" />               
                    <?php else: ?>
                      <img src="public\external\default.jpg" alt="default.png" class="profile2-image" />
                    <?php endif; ?>
                  <div class="pluss">
                    <img src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/b1f1eff7-bd0f-4eca-9cd1-6ef9fbe99587?org_if_sml=11910" class="profile-plus12" id="profile-image">
                    <input type="file" name="profile_picture" accept=".jpg, .jpeg, .png" placeholder="placeholder" class="profile2-textinput5 input" id="profile-input" style="display: none;">
                  </div>

                </div>
               

          
              <!-- <input
                  type="file"
                  name="profile_picture"
                  placeholder="placeholder"
                  class="profile2-textinput5 input"
                />
              </div> -->
              
          </div>
            <!-- ...existing HTML code... -->
            <script>
                function submitForm() {
                  // Get the form element
                  var form = document.querySelector('form');
                  // Submit the form
                  form.submit();
                }
            </script>

            <script>
              const profileImage = document.getElementById('profile-image');
              const profileInput = document.getElementById('profile-input');
              profileImage.addEventListener('click', () => {
                profileInput.click();
              });
            </script>


            </form>
            <div class="profile-color-change">
              <img
                alt="Ellipse83221"
                src="https://aheioqhobo.cloudimg.io/v7/_playground-bucket-v2.teleporthq.io_/900bc753-2190-48f9-8ce1-59acc129f87b/739e413e-f259-469f-b407-da8f2607662b?org_if_sml=11123"
                class="profile-ellipse8"
              />
              <img
                alt="Ellipse73221"
                src="public/external/ellipse73221-a74e.svg"
                class="profile-ellipse7"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
