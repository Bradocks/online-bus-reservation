<?php
// Start a session to manage the user
session_start(); 
//estalish connnection 
$servername="localhost";
$username="root";
$password="root";
$dbname="busreservation";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful using connect_error if there is a connect_error the error will be 
displayed and execution will be terminated by the die function. */
 if ($conn->connect_error)  {
       die ("connection failed:". $conn->connect_error); // Terminate script execution if the connection fails
        
}  

$userId=$_SESSION['userId'];
 

//query to the database database to fetch user details
$query="SELECT * FROM user WHERE userId='$userId'"; //select from user table where userName column as value $username provided
$result= $conn->query($query); //set the query results to variable $results
 
// Fetch the user details using the php fetch_assoc() function  and set the details to variable $row
$row = $result->fetch_assoc();

    
