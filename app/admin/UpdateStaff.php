<?php
//establish connection to the database
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

$conn = connect_db();
$session = new Auth($conn);

$staff_model = new BaseModel('staff', $conn);

$staffId = $_POST['staffId'];
$phoneNo = $_POST['phoneNo'];
$email = $_POST['email'];
$state = $_POST['state'];

$staff = $staff_model->update($staffId, [
    'phoneNO' => $phoneNo,
    'email' => $email,
    'state' => $state
], 'staffId');


if ($staff) {
    echo  "updated <a href= 
   'UpdateStaff.html'>Update</a>" . "<br>";
    echo  "Back to the Dashboard: <a href='index.php'>
   Dashboard</a>" . "<br>";
} else {
    echo " Not updated: <a href= 
      'UpdateStaff.html'>Update</a>";
}


$conn->close();
