<!DOCTYPE html>
<html>
  <head>
    <title>user account</title>
    <link rel="stylesheet" href="../form.css" />
  </head>
  <body>
    <div
      id="form"
      style="background-color: #f3e8eb; width: 1000px; height: auto; border-radius: 30px;"
      class="profile-container"
    >
      <h5 class="profile-title">profile</h5>
      <p>
        Name :
        <?php echo $name; ?>
      </p>

      <p>
        MobileNumber:
        <?php echo $mobileNumber; ?>
      </p>

      <p>
        Email :<?php echo  $email ; ?>
      </p>

      <p>Username :<?php echo $userName; ?></p>

      <p>National ID :<?php echo $IdNO; ?></p>

      <p>Date of Birth :<?php echo $DOB; ?></p>

      <p>Gender :<?php echo $gender; ?></p>

      <div class="profile-buttons">
        <button class="edit-button">
          <a style="color: white;" href="/app/editProfile.php">Edit profile</a>
        </button>
        <button class="back-button"><a style="color: white;" href="/app/user/profileBack.php">Back</a></button>
      </div>
    </div>
  </body>
</html>
