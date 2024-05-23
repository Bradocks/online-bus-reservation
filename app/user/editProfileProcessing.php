<?php

//establish connection to the database
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/orm/BaseModel.php';
require_once __DIR__ . '/../utils/auth/Auth.php';


$conn = connect_db();
$user_model = new BaseModel('user', $conn);
$session = new Auth($conn);
$user = $session->user();

// process  form data from the post request and set the collected data to php variable for use in the php script
$name = $_POST['name'];
$mobileNumber = $_POST['mobileNumber'];
$email = $_POST['email'];
$IdNo = $_POST['IdNO'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];


$stmt = $user_model->update($user->userId, [
    'name' => $name,
    'mobileNumber' => $mobileNumber,
    'email' => $email,
    'IdNO' => $IdNo,
    'DOB' => $DOB,
    'gender' => $gender
], 'userId');

//check if the sql query was successful by checking if it is equivalent to TRUE
if ($stmt) {
    // If the update is successful, redirect the user to the profile view page using php header function        
    header("location:ProfileUI.php");
} else {
    /*If there's an error in the update, display the error message by concatenating $sql variable that is the query 
   and the error message */
    echo "update unsuccessful. redo at <a href='ProfileUI.php'>Back</a>" . "<br>";
}
