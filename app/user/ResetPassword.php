<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();
// process  form data from the post request and set the collected data to php variable for use in the php script
$userName=$_POST['userName'];
$Password=$_POST['newPassword'];
$newPassword= password_hash($Password,PASSWORD_BCRYPT); /* Hash the password for using the password_hass function by passing the password variable
and  PASSWORD_BCRYPT as arguments */
//chek if the username  exists in the database

      $sql_UserName="select * from user where userName='$userName'"; /*sql query to select from user where the  user name is 
      the username used for registartion */ 
      $result_userName=$conn->query($sql_UserName); // set the result of the query to $result_userName variable
      $count=mysqli_num_rows($result_userName); // use mysqli_num_rows function to check the number of rows picked

      /* if the number of rows exeed 0 the user name exists thus and the passord can be changed*/
      if($count>0){
//query to the database to change pasword 
$sql="UPDATE user SET password=? WHERE userName=? ";
$updateUserCredentials=$conn->prepare($sql);
//The bind_param() method binds variables to the placeholders in the SQL query.
$updateUserCredentials->bind_param("ss",$newPassword,$userName);
   /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
$updateUserCredentials->execute();
//check if the sql query was succesfful by checking if it is equivalent to TRUE
if($updateUserCredentials)
{
     // echo '<script> alert("updated")</script>';
//redirect to login page
header("location:index.php");
}
else{
      //if the query was not sucessful display the meassage and allow the user to the user to redu the reset
      echo"Not updated";
      echo"<a href=' resetPassword.html'>try again to resert password</a>";
}
      }
else{
      //if the query was not sucessful display the meassage and allow the user to the user to redu the reset
      echo"userName does not exist please create an account "."</br>".'';
      echo"<a href='userRegistrationForm.html'>create an account </a>"."</br>".'';
      echo"<a href='resetPassword.html'>try again to resert password</a>"."</br>".'';
}
 //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
$conn->close();