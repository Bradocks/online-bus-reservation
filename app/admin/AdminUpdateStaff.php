<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();

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
