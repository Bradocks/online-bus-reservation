<?php
//establish connection to the database
//estalish connnection 
require_once("../config/database.php");

$conn = connect_db();
// process  form data from the post request and set the collected data to php variable for use in the php script
$name = $_POST['name'] . " " . $_POST['lname'];
$mobileNumber = $_POST['mobileNumber'];
$email = $_POST['email'];
$address = $_POST['Address'];
$pass = $_POST['password'];
$role = $_POST['role'];
$password = password_hash($pass, PASSWORD_BCRYPT); /* Hash the password for using the password_hass function by passing the password variable
      and  PASSWORD_BCRYPT as arguments */
$IdNO = $_POST['IdNO'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];


/* 
* Initialize variables to store form data and error messages
*/

if ($pass) {
    // Retrieve form data
    $confirm_password = $_POST['confirmPassword'];
    // Check if password and confirm password match
    if ($pass !== $confirm_password) {
        $error = "Passwords do not match!";
        echo $error;
        return;
    }
}

//check if the username is already used in the database
$sql_chekUserName = " select * from user where email='$email'"; /*SQL query to select from user where the  user name is 
      the username used for registration */
$result_userName = $conn->query($sql_chekUserName); // set the result of the query to $result_userName variable
$count = mysqli_num_rows($result_userName); // use mysqli_num_rows function to check the number of rows picked

/* if the number of rows exceeds 0 the user name is  used thus requesting the passenger to use another user to create an account 
      else if there is no row picked the user name is not used thus creating the account in the database*/
if ($count > 0) {
    echo "user name already TAKEN set another userName";
    echo "<p><a href='userRegistrationform.html'> use another userName to register</a></P>"; 
} else {
    if ($role != 'Passenger') {
        $sql = "select * from staff where email='$email' and position='$role' ";
        $user = $conn->query($sql);

        $cout = mysqli_num_rows($user);

        if ($cout > 0 || $role === 'Passenger') {
            addUser($conn);
        } else {
            echo "NOT registered .";
            echo "<br>";
            echo "register as a passenger <a href='userRegistrationForm.html'>register</a>";
        }
    } else {
        // if ($role === 'Passenger') {
        addUser($conn);
        // }
    }
}





function addUser($conn)
{
    // process  form data from the post request and set the collected data to php variable for use in the php script
    $name = $_POST['name'] . " " . $_POST['lname'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['userName'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
    $password = password_hash($pass, PASSWORD_BCRYPT); /* Hash the password for using the password_hash function by passing the password variable
     and  PASSWORD_BCRYPT as arguments */
    $IdNO = $_POST['IdNO'];
    $DOB = $_POST['DOB'];
    $gender = $_POST['gender'];

    //insert data into the database  since the user name is not used, thus creating an account for the new client, 
    // a query that inserts values using placeholders in the prepare function using conn object?
    $sql = "INSERT INTO user (name, mobileNumber, email, role, password,  IdNO, DOB, gender, userName) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $insertuserdetails = $conn->prepare($sql);

    //var_dump($insertuserdetails);

    //The bind_param() method binds variables to the placeholders in the SQL query.
    $insertuserdetails->bind_param(
        'sisssisss',  
        $name,
        $mobileNumber,
        $email,
        $role,
        $password,
        $IdNO,       
        $DOB,
        $gender,
        $username
    );
    /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */

    //check if the sql query was successful by checking if it is equivalent to TRUE
    if ($insertuserdetails->execute()) {
        // If the insertion is successful, redirect the user to the login page using php header function   

        header("location:/user");
    } else {
        // If there's an error during insertion, display the error message by concatenating $sql variable that is the query, and the error message
        echo "error:" . $sql . "<br>" . $conn->error;
    }
}
//close the connection to the database using the $conn variables used to open the connection by invoking the close() function
$conn->close();
