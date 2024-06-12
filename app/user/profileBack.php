<?php
// Start a session to manage user
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';


$session = new Auth($conn);

$userId = $session->user()->userId;

//query to the database database to fetch user details
$query = "SELECT role FROM user WHERE userId=$userId"; //select from user table where userName column as value $userId
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
$result = $conn->query($query);
//the fetch_assoc() method retrieves a single row as an associative array
$row = $result->fetch_assoc();

$role = $row['role']; //set variable $role to the value of $row['role'] value
// Redirect users based on their roles using a switch 
switch ($role) {
    case "passenger":
        header("location:passengerDashboard.php");
        break;
    case "driver":
        header("location:driverDashboard.php");
        break;
    case "admin":
        header("location:AdminDashboard.php");
        break;
    default:
        header("location:home.html");
}

//close the connection to the database using the $conn variables used to open the connection by invoking the close() function
$conn->close();
