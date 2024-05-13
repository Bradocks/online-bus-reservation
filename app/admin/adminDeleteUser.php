<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();

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
      
    echo" Back to dashBoard: <a href='index.php'>Dashboard</a>". "<br>";
}
else{
    echo"Failed!: <a href='AdmindeleteUser.html'>Delete user</a>". "<br>";
}
}else {
    echo" User not found <a href='index.php'>Dashboard</a>". "<br>";
}
$conn->close();
