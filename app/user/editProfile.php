<?php
//establish connection to the database
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';


$conn = connect_db();
$session = new Auth($conn);
$user = $session->user();


// $userId = $_SESSION['userId'];

// //get user details
// $user = "select  name,mobileNumber,email,address,userName,IdNo,DOB,gender
// from user  where  userId=$userId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
// $result = $conn->query($user);
// //the fetch_assoc() method retrieves a single row as an associative array
// $row = $result->fetch_assoc();

// $name = $row['name'];
// $mobileNumber = $row['mobileNumber'];
// $email = $row['email'];
// $address = $row['address'];
// $userName = $row['userName'];
// $IdNO = $row['IdN0'];
// $DOB = $row['DOB'];
// $gender = $row['gender'];


// $conn->close();
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