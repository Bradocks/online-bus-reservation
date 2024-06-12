<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';


$session = new Auth($conn);

$feedback_model = new BaseModel('feedback', $conn);
$feedback = $_POST['Feedback'];

$row = $userId = $_SESSION['userId'];
$userQuery = "SELECT * FROM user WHERE userId = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$driver = $stmt->get_result()->fetch_object();

$role = $row->role;
if ($role) {

    $stmt = $feedback_model->create([
        "dateTime" => date('y-m-d h:i:s'),
        "source" => $row->name,
        "feedBack" => $feedback
    ], 'feedBackId');

    if ($stmt) {
        switch ($role) {
            case "Passenger":
                /* header() function in PHP is used to send raw HTTP headers to the client,allowing 
    you to perform various tasks such as redirecting the user to anotherpage.  */
                header("location:/../passengerdashboard.php");
                break;
            case "driver":
                header("location:./../../driver/index.php");
                break;
            case "admin":
                header("location:./../../admin/index.php");
                break;
        }
    }
} else {
    echo "role not found";
}
$conn->close(); //close database connection
