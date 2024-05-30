<?php
// Start a session to manage the user
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';

$conn = connect_db();
$session = new Auth($conn);
$user = $session->user();
?>


<!DOCTYPE html>
<html>

<head>
    <title>user account</title>
    <link rel="stylesheet" href="../form.css" />
</head>

<body>

<style>
        body {
          background-image: url('/photo1.jpeg');
        }
        </style>


    <div id="form" style="background-color: #f3e8eb; width: 400px; height: auto; border-radius: 30px; color: black;" class="profile-container">
        <h5 class="profile-title" style="text-align: center;">profile</h5>
        <p>
            Name :
            <?php echo $user->name; ?>
        </p>

        <p>
            MobileNumber:
            <?php echo $user->mobileNumber; ?>
        </p>

        <p>
            Email : <?php echo $user->email; ?>
        </p>

        <p>Username : <?php echo $user->userName; ?></p>

        <p>National ID : <?php echo $user->IdNO; ?></p>

        <p>Date of Birth : <?php echo $user->DOB; ?></p>

        <p>Gender : <?php echo $user->gender; ?></p>

        <div class="profile-buttons">
            <button class="edit-button">
                <a style="color: white;" href="editProfile.php">Edit profile</a>
            </button>
            <button class="back-button"><a style="color: white;" href="/user">Back</a></button>
        </div>
    </div>
</body>

</html>