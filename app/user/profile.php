<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();

$userId=$_SESSION['userId'];

//get user details
$user="select  name,mobileNumber,email,userName,IdNo,DOB,gender
from user  where  userId=$userId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
$result=$conn->query($user);
 //the fetch_assoc() method retrieves a single row as an associative array
      $row=$result->fetch_assoc ();
    
      $name=$row['name'];
      $mobileNumber=$row['mobileNumber'];
      $email=$row['email'];
      $userName=$row['userName'];
      $IdNO=$row['IdNO'];
      $DOB=$row['DOB'];
      $gender=$row['gender'];
       
 
 $conn->close(); //close database connection
