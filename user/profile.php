<?php
// Start a session to manage the user
session_start(); 
//estalish connnection 
$servername="localhost";
$username="root";
$password="root";
$dbname="busreservation";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful using connect_error if there is an connect_error the error will be 
displayed and execution will be terminated by the die function. */
 if ($conn->connect_error)  {
       die ("connection failed:". $conn->connect_error); // Terminate script execution if the connection fails
        
}  

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
      $IdNo=$row['IdNo'];
      $DOB=$row['DOB'];
      $gender=$row['gender'];
       
 
 $conn->close(); //close database connection
