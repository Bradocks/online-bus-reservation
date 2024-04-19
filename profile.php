<?php
// Start a session to manage user
session_start(); 
//estalish connnection 
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful usinh connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
       die ("connection failled:". $conn->connect_error); // Terminate script execution if the connection fails
        
}  

$userId=$_SESSION['userId'];

//get user details
$user="select  name,mobileNumber,email,address,userName,IDNO,DtOfBth,gender
from user  where  userId=$userId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
$result=$conn->query($user);
 //the fetch_assoc() method retrieves a single row as an associative array
      $row=$result->fetch_assoc ();
    
      $name=$row['name'];
      $mobileNumber=$row['mobileNumber'];
      $email=$row['email'];
      $address=$row['address'];
      $userName=$row['userName'];
      $IDNO=$row['IDNO'];
      $DtOfBth=$row['DtOfBth'];
      $gender=$row['gender'];
       
 
 $conn->close(); //close database connection