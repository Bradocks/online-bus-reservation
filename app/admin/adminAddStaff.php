<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();
// process  form data from the post request and set the collected data to php variable for use in the php script
$name = $_POST['name'] . " " . $_POST['lname'];
$mobileNumber = $_POST['mobileNumber'];
$email = $_POST['email'];
$IdNO = $_POST['IdNO'];
$DtOfBth = $_POST['DOB'];
$gender = $_POST['gender'];
$role = $_POST['role'];
$userName = $_POST['userName'];


//check if the username is already used in the database
$sql_chekUserName = " select * from staff where userName='$userName'"; /*sql query to select from user where the  user name is 
   the username used for registration */
$result_userName = $conn->query($sql_chekUserName); // set the result of the query to $result_userName variable
$count = mysqli_num_rows($result_userName); // use mysqli_num_rows function to check the number of rows picked

/* if the number of rows exceeds 0 the user name is  used, requesting the client to use another username to create an account 
   else if there is no row picked the user name is not used, creating the account in the database*/
if ($count > 0) {
    echo "user name taken";
    echo "<p><a href='adminAddstaff.html'> choose another name</a></P>"; /* DisplayLink to direct the
       user to create an account with a different userName */
} else {
    //insert data about staff into database 
    $sqladd = "INSERT INTO staff (name,userName,IdNO,phoneNO,email,role,gender,DOB)
      VALUES (?,?,?,?,?,?,?,?)"; //QL query to insert user data into the database */
    // a  query that inserts values using placholders ?
    $stmt = $conn->prepare($sqladd);
    //The bind_param() method binds variables to the placeholders in the SQL query.
    $stmt->bind_param("ssiissss", $name, $userName, $IdNO, $mobileNumber, $email, $role, $gender, $DOB);
    /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
    $stmt->execute();
    //check if the sql query was successful by checking if it is equivalent to TRUE
    if ($stmt) {
        // If the insertion is successful
        echo "Staff Added <a href='adminAddstaff.html'>Add staff</a>" . "<br>";
        echo "Back to dashBoard <a href='AdminDashboard.php'>Add staff</a>" . "<br>";
    } else {
        // If there's an error during insertion, display the error message by concatenating $sql variable that is the query, and the error message
        echo " Failed!: <a href='adminAddstaff.html'>Add staff</a>" . "<br>";
    }
}


//close the connection to the database using the $conn variables used to open the connection by invoking the close() function
$conn->close();
