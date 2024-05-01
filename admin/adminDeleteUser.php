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

$UserId=$_POST['userId'];

$check="select * from user where  userId=$UserId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
 $checkResult=$conn->query($check);
if($checkResult->num_rows>0) { 

$sql= "DELETE FROM user  WHERE  userId=?";
// a  query that deletes values using placholders ?
$stmt=$conn->prepare($sql);
//The bind_param() method binds variables to the placeholders in the SQL query.
$stmt->bind_param("i",$UserId);
/* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
$stmt->execute();
if($stmt){
    echo" deleted sucessfully... delete another one: <a href='AdmindeleteUser.html'>delete another</a>" . "<br>";
      
    echo" or go back to dashBoard: <a href='AdminDashboard.php'>Dashboard</a>". "<br>";
}
else{
    echo"Not deleted: <a href='AdmindeleteUser.html'>delete again</a>". "<br>";
}
}else {
    echo" user not available for delete..go back to DashBoard: <a href='AdminDashboard.php'>Dashboard</a>". "<br>";
}
$conn->close();