<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();
   // process  form data from the post request and set the collected data to php variable for use in the php script
      $name=$_POST['name'];
      $mobileNumber=$_POST['mobileNumber'];
      $email=$_POST['email'];
      $address=$_POST['address'];
      $IdNo=$_POST['IdNo'];
      $DOB=$_POST['DOB'];
      $gender=$_POST['gender'];

      $userId=$_SESSION['userId'];
       
      $sqlupdate="UPDATE user SET name=?, mobileNumber=?, email=?, address=?,  IdNo=? ,DOB=?,gender=?
      where userId=?";
      // an update query that inserts values using placeholders in the prepare function using conn object? 
    $stmt=$conn->prepare($sqlupdate);
    //The bind_param() method binds variables to the placeholders in the SQL query.
    $stmt->bind_param("sississi",$name,$mobileNumber,$email,$address,$IdNo,$DOB,$gender,$userId);
     /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
    $stmt->execute();
        
   //check if the sql query was successful by checking if it is equivalent to TRUE
      if($stmt){ 
       // If the update is successful, redirect the user to the profile view page using php header function        
      header("location:profile.php");

      } 
      else {
   /*If there's an error in the update, display the error message by concatenating $sql variable that is the query 
   and the error message */
      echo"update unsuccessful. redo at<a href='profile.php'>Back</a>"."<br>" ;
      }
  

  //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

