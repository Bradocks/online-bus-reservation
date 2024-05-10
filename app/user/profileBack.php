<?php
// Start a session to manage user
session_start(); 
//estalish connnection 
$servername="localhost";
$username="root";
$password="root";
$dbname="busreservation";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful usinh connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
       die ("connection failled:". $conn->connect_error); // Terminate script execution if the connection fails
        
}  
 
$userId=$_SESSION['userId']; 
       
   //query to the database database to fetch user details
   $query="SELECT role FROM user WHERE userId=$userId"; //select from user table where userName column as value $userId
   /*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
   $result= $conn->query($query); 
   //the fetch_assoc() method retrieves a single row as an associative array
   $row = $result->fetch_assoc();
 
     $role = $row['role'];//set variable $role to the value of $row['role'] value
           // Redirect users based on their roles using a switch 
          switch ($role){
          case "passenger":
          header("location:passengerDashboard.php");
          break;
          case "driver":
          header("location:driverDashboard.php");
          break;
          case "admin":
          header("location:AdminDashboard.php");
          break;  
          default:
          header("location:home.html");
          }       
      
         //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

