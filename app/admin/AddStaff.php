<?php
//establish connection to the database
require_once("../config/database.php");
require_once __DIR__ . '/../utils/orm/BaseModel.php';


$conn = connect_db($db_config);
$user_model = new BaseModel('user', $conn);
$staff_model = new BaseModel('staff', $conn);


// process  form data from the post request and set the collected data to php variable for use in the php script
$name = $_POST['name'] . " " . $_POST['lname'];
$mobileNumber = $_POST['mobileNumber'];
$email = $_POST['email'];
$IdNO = $_POST['IdNO'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];
$role = $_POST['role'];
$userName = $_POST['userName'];


//check if the username is already used in the database
$sql_chekUserName = " select * from staff where userName='$userName'"; /*sql query to select from user where the  user name is 
   the username used for registration */
$result_userName = $conn->query($sql_chekUserName); // set the result of the query to $result_userName variable
$count = mysqli_num_rows($result_userName); // use mysqli_num_rows function to check the number of rows picked

/* if the number of rows exceeds 0 the user name is  used */
if ($count > 0) {
    echo "user name taken";
    echo "<p><a href='Addstaff.html'>Pick another name</a></P>";
} else {
    $password = password_hash($IdNO, PASSWORD_BCRYPT);

    $staff = $staff_model->create([
        'name' => $name,
        'userName' => $userName,
        'IdNO' => $IdNO,
        'phoneNO' => $mobileNumber,  
        'email' => $email,
        'role' => $role,
        'gender' => $gender,
        'DOB' => $DOB
    ], "staffId");

    $user = $user_model->create([
        'name' => $name,
        'mobileNumber' => $mobileNumber,
        'email' => $email,
        'role' => $role,
        'userName' => $userName,
        'password' => $password,    
        'IdNO' => $IdNO,
        'DOB' => $DOB,
        'gender' => $gender,
        'staff_id' => $staff->staffId    
    ], "userId");

    //check if the sql query was successful by checking if it is equivalent to TRUE
    if ($staff) {
        // If the insertion is successful
        echo "Staff Added <a href='Addstaff.html'>Add staff</a>" . "<br>";
        echo "Back to dashBoard <a href='/admin/index.php'>Add staff</a>" . "<br>";
    } else {
        // If there's an error during insertion, display the error message by concatenating $sql variable that is the query, and the error message
        echo " Failed!: <a href='Addstaff.html'>Add staff</a>" . "<br>";
    }
}


//close the connection to the database using the $conn variables used to open the connection by using the close() function
$conn->close();
