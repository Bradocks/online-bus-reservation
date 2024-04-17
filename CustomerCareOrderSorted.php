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
//queryto the database database
$query="SELECT * FROM orders where orderstate='processing'";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
$result= $conn->query($query);
/* mysqli_num_rows()function is used to retrieve the number of rows returned by 
a SELECT query executed against a MySQL database using the MySQLi extension.*/
$count=mysqli_num_rows($result);
if ($count> 0) {
    
    //the fetch_assoc() method retrieves a single row as an associative array
    $row = $result->fetch_assoc();
    $orderId = $row['orderId'];
    $senderId=$row['sender_id'];
    $source=$row['source'];
    $destination=$row['destination'];
    $quantity=$row['quantity'];
    $description=$row['description'];
    $category=$row['category'];   
    $name=$row['receiverName'];
    $IdNo=$row['receiverIDNO']; 
    $mobileNumber=$row['receiverPhoneNO'];
    $email=$row['receiverEmail'];
    $Location=$row['receiverLocation'];
    $dOfBth=$row['receiverDtOfBth'];
    $gender=$row['receiverGender'];
    $orderstate='sorted';

    //data from the  sort orderform 
    $customerCareId=$_SESSION['userId'];
    $vehicleId=$_POST['VehicleId'];
    
    $charges=$_POST['charges'];

    $sqlCheckVehicle="select * from vehicle where vehicleId=$vehicleId";
    $result=$conn->query($sqlCheckVehicle);
    $row=$result->fetch_assoc();
 if($row){
    $vehicleplateNumber=$row['plateNo'];
    $vehicleType=$row['type'];
    $vehiclestate=$row['state'];
    $DriverId=$row['driverId'];
    if($DriverId){
        //set driver details
        $getDriverdetails="select mobileNumber,name from user where userId=$DriverId";
        $details=$conn->query($getDriverdetails);
        $detailsResult=$details->fetch_assoc();
    
        $driverPhoneNO=$detailsResult['mobileNumber'];
        $driverName=$detailsResult['name'];

        if($vehiclestate==='Oky'){ 


     //ENTER THE DATA IN THE SORTED ORDERS TABLE

     $sql="update orders set vehicleId=?,plateNumber=?,vehicleType=?,
     driverPhoneNO=?,driverName=?,charges=?,customerCareId=?,orderstate=?
      where orderId=?";
     /* a query that inserts values using placholders in prepare function
     using conn object ? */
     $insertIntoOrders=$conn->prepare($sql);
     //The bind_param() method binds variables to the placeholders in the SQL query.
     $insertIntoOrders->bind_param("issisiisi",$vehicleId, 
     $vehicleplateNumber,$vehicleType,$driverPhoneNO,$driverName,$charges,
     $customerCareId,$orderstate,$orderId);
        /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */

       $insertIntoOrders->execute();

   if($insertIntoOrders) {
          
    header("location:customerCareManageOrders.php");
    }else{
        echo"not sucessfull. <a href='customerCareManageOrders.php'>redo</a>";
    }
}else{
    echo "vehicle is currentry down";
}
}else{
    echo "vehicle Not yet allocated a driver";
}
}else{
    echo "vehicle does not exist";

}
}   
 else{
    echo "sort un succesful";
    header("customerCareManageOrders.php");
}
      
$conn->close(); //close connection to database