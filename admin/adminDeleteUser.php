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

$UserId=$_POST['userId'];

$check="select * from user where  userId=$UserId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
 $checkResult=$conn->query($check);
if($checkResult->num_rows>0) { 

$sql= "DELETE FROM user  WHERE  userId=?";
// a  query that deletes values using placeholders?
$stmt=$conn->prepare($sql);
//The bind_param() method binds variables to the placeholders in the SQL query.
$stmt->bind_param("i",$UserId);
/* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
$stmt->execute();
if($stmt){
    echo" User deleted<a href='AdmindeleteUser.html'>Delete user</a>" . "<br>";
      
    echo" Back to dashBoard: <a href='AdminDashboard.php'>Dashboard</a>". "<br>";
}
else{
    echo"Failed!: <a href='AdmindeleteUser.html'>Delete user</a>". "<br>";
}
}else {
    echo" User not found <a href='AdminDashboard.php'>Dashboard</a>". "<br>";
}
$conn->close();
