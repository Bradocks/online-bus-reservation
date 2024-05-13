<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();

$staffId=$_POST['staffId'];

$check=" select staffId from staff where staffId=$staffId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
 $checkResult=$conn->query($check);
if($checkResult->num_rows>0) { 

$sql= "DELETE FROM staff WHERE staffId=?";
// a  query that deletes values using placeholders?
$stmt=$conn->prepare($sql);
//The bind_param() method binds variables to the placeholders in the SQL query.
$stmt->bind_param("i",$staffId);
/* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
$stmt->execute();
if($stmt){
    echo" Staff deleted<a href='AdmindeleteStaff.html'>delete staff</a>" . "<br>";
      
    echo" Back to dashBoard: <a href='AdminDashboard.php'>Dashboard</a>". "<br>";
}
else{
    echo"Failed: <a href='AdmindeleteStaff.html'>delete again</a>". "<br>";
}
}else {
    echo" Staff not found <a href='AdminDashboard.php'>Dashboard</a>". "<br>";
}
$conn->close();
