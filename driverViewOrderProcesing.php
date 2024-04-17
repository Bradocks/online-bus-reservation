<?php
// Start a session to manage user
session_start(); 
//estalish connnection 
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful using connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
       die ("connection failled:". $conn->connect_error); // Terminate script execution if the connection fails
        
}  

$userId=$_SESSION['userId'];
//get vehicleId from vehicle
$sqlGetVehicleId="select vehicleId from vehicle where driverId=$userId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
$resultVehicleId=$conn->query($sqlGetVehicleId);
if ($resultVehicleId->num_rows > 0) {
  // fetch_assoc() method retrieves a single row as an associative array
    $rowVehicleId= $resultVehicleId->fetch_assoc();
    $vehicleId= $rowVehicleId['vehicleId'];
 
//get order detail 
    
   $item="select itemid,source,destination,quantity,description,category,orderTimeDate,
   senderName,senderPhoneNo,receiverName,receiverPhoneNo
   from item 
   join sender ON itemid= orderNo  
   where vehicleId=$vehicleId and  paymentDetail='paid' and deliveryState is NULL";
         $result=$conn->query($item);
      $row=$result->fetch_assoc();
                  
     if($result->num_rows>0) {
      // setting table with a border attribute of '1'
         echo"<table border='1'>";
         //table header row
         echo" <tr> 
         <th>itemid</th> <th>sender Name</th> <th>sender phone number</th> 
         <th>reciver Name</th> <th>receiver phone number</th>  
         <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th> 
          <th>category</th> <th>time orderd</th> 
           </tr> ";
            
            
           /*fetch_assoc() method is a function used in PHP to fetch a single row of 
            result set from a MySQL database query as an associative array*/ 
                while($row=$result->fetch_assoc()){ 
                   
                      
             echo "<tr>
             <td>". $row['itemid']."</td>
             <td>". $row['senderName']."</td>
             <td>".$row['senderPhoneNo']."</td>
             <td>". $row['receiverName'].
             "</td><td>". $row['receiverPhoneNo']."</td><td>". $row['source']. "</td><td>". 
             $row['destination']. "</td><td>".$row['quantity']."</td><td>". 
             $row['description']. "</td><td>".$row['category']."</td><td>"
             .$row['orderTimeDate']. "</td></tr>".
            "<br>";
                                     
            }
            echo"</table";

            "<br>";
       echo "<a href='driversDashboard.php'>Back</a> ";
                 
         }
      else{
           echo"no orders available.'<br>'";
       echo "go back to dashBoard : <a href='driversDashboard.php'>Dashboard</a> ";
         }         
   
}else{
 echo "you are yet to be assigned a vehicle";
}
 $conn->close();
