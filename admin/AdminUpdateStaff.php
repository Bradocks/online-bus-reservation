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
   $staffId=$_POST['staffId'];
   $phoneNo=$_POST['phoneNo'];
   $email=$_POST['email'];
   $state=$_POST['state'];
   $modeOfEmployment=$_POST['modeOfEmployment'];
    
   //ensure the staff exist
   $confimStaff="select staffId from staff where staffId=$staffId";
   $confimresult=$conn->query($confimStaff);
    
   if( $confimresult->num_rows>0){  
      

$sqlAssign="UPDATE staff SET  phoneNO=?,email=?,state=?,modeOfEmployment=?
 where  staffId=?";

    /* a query that inserts values using placholders in prepare function
     using conn object ? */
$updateStaff=$conn->prepare($sqlAssign);
//The bind_param() method binds variables to the placeholders in the SQL query.
$updateStaff->bind_param("isssi",$phoneNo,$email,$state,$modeOfEmployment,$staffId);
 
$modeOfEmployment=$_POST['modeOfEmployment'];
/* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
$updateStaff->execute();
 
 if($updateStaff) {
        
   echo  "   updated sucessfuly, update another  : <a href= 
   'AdminUpdateStaff.html'>add again</a>". "<br>";
   echo  "   or back to the Dashboard: <a href='adminDashboard.php'>
   DashBoard</a>". "<br>";
      }
else{
      echo " not updated. go and update again : <a href= 
      'AdminUpdateStaff.html'>add again</a>";
} 
 }else{
      echo"Staff Does Not exist: <a href= 
      'AdminUpdateStaff.html'>Update another staff</a>";
 }
 

 $conn->close();
