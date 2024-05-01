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
   $vehicleId=$_POST['vehicleId'];
   $driverId=$_POST['driverId'];
   $state=$_POST['state'];
   //ensure the vehicle exist
   $confirVehicle="select vehicleId from vehicle where vehicleId=$vehicleId";
   $confirresult=$conn->query($confirVehicle);
   $confirrow=$confirresult->fetch_assoc();
   if($confirrow){ 
     //ensure the driver exist
     $checkifdriverexist="select role from user where userId=$driverId";
     $chekresult=$conn->query($checkifdriverexist);
     $checkrow=$chekresult->fetch_assoc();
     if($checkrow){
     $role=$checkrow['role'];
     
     if($role==='driver'){
      //ensure driver is not assigned another vehicle
 $check="select driverId from vehicle where driverid=$driverId and
  vehicleId !=$vehicleId" ;
 /*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
 $checkResult=$conn->query($check);
 if(!$checkResult->num_rows>0){ 

$sqlAssign="UPDATE vehicle SET driverid=?, state=? where vehicleid=?";

    /* a query that inserts values using placholders in prepare function
     using conn object ? */
$updatevehicle=$conn->prepare($sqlAssign);
//The bind_param() method binds variables to the placeholders in the SQL query.
$updatevehicle->bind_param("isi",$driverId,$state,$vehicleId);
/* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
$updatevehicle->execute();
 
 if($updatevehicle) {
       echo "updated sucessfuly". "<br>";
   echo  "   updated sucessfuly, update another driver: <a href= 
   'adminAsignDriverAVehicle.html'>add again</a>". "<br>";
   echo  "   or back to the Dashboard: <a href='adminDashboard.php'>
   DashBoard</a>". "<br>";
      }
else{
      echo " not updated. go and update again : <a href= 
      'adminAsignDriverAVehicle.html'>add again</a>";
} 
 }else{
      echo" driver has a vehicle assigned : <a href= 
      'adminAsignDriverAVehicle.html'>assign another driver</a>";
 }
}else{
      echo"driver doesn't exist";
   }
  }else{
         echo"driver doesn't exist";
      }
}else{
      echo"vehichle doesn't exist";
}

 $conn->close();
