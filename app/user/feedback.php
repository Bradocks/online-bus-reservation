<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

$conn = connect_db();
$session = new Auth($conn);

$feedback_model = new BaseModel('feedback', $conn);
$feedback = $_POST['Feedback'];

$row = $session->user();
$role = $row->role;
if ($role) {

    $stmt = $feedback_model->create([
        "dateTime" => date('y-m-d h:i:s'),
        "source" => $row->name,
        "feedBack" => $feedback
    ], 'feedBackId');

    if ($stmt) {
        switch ($role) {
            case "client":
                /* header() function in PHP is used to send raw HTTP headers to the client,allowing 
    you to perform various tasks such as redirecting the user to anotherpage.  */
                header("location:passengerDashboard.php");
                break;
            case "driver":
                header("location:driverDashboard.php");
                break;
            case "admin":
                header("location:AdminDashboard.php");
                break;
        }
    }
} else {
    echo "role not found";
}
$conn->close(); //close database connection
