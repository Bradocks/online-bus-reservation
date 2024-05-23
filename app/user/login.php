<?php
// Start a session to manage user
session_start();
//estalish connnection 
require_once("../config/database.php");

$conn = connect_db();

// process  form data from the post request and set the collected data to php variable for use in the php script
$username = $_POST['userName'];

$password = $_POST['password'];

$userRole = $_POST['role'];



//query to the database database to fetch user details
$query = "SELECT * FROM user WHERE email='$username'"; //select from user table where userName column as value $username provided
$result = $conn->query($query); //set the query results to variable $results
$count = mysqli_num_rows($result); // use the mysqli_num_rows function to get the number of rows selected and set it to variable $count

// Check if the query was successful if $ results as some data
if ($result) {


    // Fetch the user details using the php fetch_assoc() function  and set the details to variable $row
    $row = $result->fetch_assoc();


    // Verify password using password_verify function check if $row has data and the provided password resembles the one in the database
    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['userId'] = $row['userId']; //set variable $_session['userid'] to row  value $row['userid']
        $_SESSION['userName'] = $row['userName']; //set variable $_session['userName'] to row  value $row['userName']
        $role = $row['role']; //set variable $role to the value of $row['role'] value
        // Redirect users based on their roles using a switch 

        if ($userRole === $role) {
            switch ($role) {
                case "Passenger":
                    header("Location:./passengerdashboard.php");
                    break;
                case "driver":
                    header("Location:/driver");
                    break;
                case "admin":
                    header("Location:/admin");
                    break;
                default:
                    header("location:home.html");
            }
            exit;
        } else {
            echo "please enter your supposed role at <a href='/user/index.php'> login</a>";
        }
    } else {
        // If password is incorrect, display error message
        echo "login not successful. Try logging in again  or reset password ";
        //redirect for another login try or allow password reset
        echo "<a href='/user'>login</a>";
    }
} else {
    // If the query fails, display the error message query failed and concatenate with the $conn error message
    echo "Query failed: " . $conn->error;
}
//close the connection to the database using the $conn variables used to open the connection by invoking the close() function
$conn->close();
