<?php
//establish connection to the database
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';


$conn = connect_db();
$session = new Auth($conn);
$user = $session->user();
?>


<!DOCTYPE html>
<html>

<head>
    <title>user account </title>
    <link rel="stylesheet" href="formms.css">
</head>

<body>
    <div>
        <form method="POST" action="editProfileProcessing.php" onsubmit="return editProfileVAlidate ()">
            <p>Edit profile by entering new desired values</p>
            <label>Full Name : <?php echo $user->name; ?><br></label>
            <input type="text" id="name" name="name" value="<?php echo $user->name; ?>"><br>
            <label>MobileNumber: <?php echo $user->mobileNumber; ?><br></label>
            <input type="text" id="mobileNumber" name="mobileNumber" value="<?php echo $user->mobileNumber; ?>"><br>
            <label> Email :<?php echo $user->email; ?> <br></label>
            <input type="text" id="email" name="email" value="<?php echo $user->email; ?>"><br>
            <label>Address :<?php echo $user->address; ?><br></label>
            <input type="text" id="address" name="address" value="<?php echo $user->address; ?>"><br>
            <label>IDNo :<?php echo $user->IdNo; ?><br></label>
            <input type="text" id="IdNO" name="IdNO" value="<?php echo $user->IdNo; ?>"><br>
            <label>Date of Birth :<?php echo $user->DOB; ?><br></label>
            <input type="text" id="DOB" name="DOB" value="<?php echo $user->DOB; ?>"><br>
            <label>Gender :<?php echo $user->gender; ?></label>
            <select name="gender" id="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <button type="submit">submit</button>
            <br>
            <h5><a href="profile.php">Back</a></h5><br>
        </form>
    </div>
    <script src="registration.js"></script>
</body>

</html>