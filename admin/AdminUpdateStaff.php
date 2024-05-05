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
   $staffId=$_POST['staffId'];
   $phoneNo=$_POST['phoneNo'];
   $email=$_POST['email'];
   $state=$_POST['state'];
  
    
   //ensure the staff exist
   $confimStaff=" select staffId from staff where staffId=$staffId";
   $confimresult=$conn->query($confimStaff);
    
   if( $confimresult->num_rows>0){  
      

$sqlAssign="UPDATE staff SET  phoneNO=?,email=?,state=?,
 where  staffId=?";

    /* a query that inserts values using placeholders in the prepare function
     using conn object? */
$updateStaff=$conn->prepare($sqlAssign);
//The bind_param() method binds variables to the placeholders in the SQL query.
$updateStaff->bind_param("issi",$phoneNo,$email,$state,$staffId);
    
$updateStaff->execute();
 
 if($updateStaff) {
        
   echo  "   updated <a href= 
   'AdminUpdateStaff.html'>Update</a>". "<br>";
   echo  "   Back to the Dashboard: <a href='adminDashboard.php'>
   Dashboard</a>". "<br>";
      }
else{
      echo " Not updated: <a href= 
      'AdminUpdateStaff.html'>Update</a>";
} 
 }else{
      echo"Does Not exist! : <a href= 
      'AdminUpdateStaff.html'>Update</a>";
 }
 

 $conn->close();
