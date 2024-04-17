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

$userId=$_SESSION['userId'];
 

//query to the database database to fetch user details
$query="SELECT * FROM user WHERE userId='$userId'"; //select from user table where userName column as value $username provided
$result= $conn->query($query); //set the query results to variable $results
 
// Fetch the user details using the php fetch_assoc() function  and set the details to variable $row
$row = $result->fetch_assoc();

    $role = $row['role'];//set variable $role to the value of $row['role'] value
    // get history based on their roles using a switch 
   switch ($role){
   case "client":
      $history="select itemid, vehicleId,customerCareId,source,destination,deliveryState,
      charges,PaymentMethod,paymentDetail,receiverName,receiverEmail
      from item  
      join sender ON  itemid= orderNo
      where item.senderId=$userId";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
      $result=$conn->query($history);
      
      if($result->num_rows>0) {
         // setting table with a border attribute of '1'
         echo '<a href="profileBack.php">back</a>'; 
                  echo"<table border='1'>";
                  //table header row
            echo"<tr><th>orderId</th><th>vehicleId</th><th> customerCareId</th><th>source
            </th><th>destination</th><th>deliveryState</th><th>charges</th>
            <th>PaymentMethod</th><th>paymentDetail</th><th>receiver</th><th>receiverEmail</th></tr>";
            /*fetch_assoc() method is a function used in PHP to fetch a single row of 
            result set from a MySQL database query as an associative array*/
            while($row=$result->fetch_assoc()){
         echo "<tr><td>" . $row['itemid']."</td><td>". $row['vehicleId']. "</td><td>". $row['customerCareId'].
         "</td><td>". $row['source']. "</td><td>". $row['destination']."</td><td>". $row['deliveryState']. 
          " </td><td>". $row['charges']. " </td><td>". $row['PaymentMethod']." </td><td>". $row['paymentDetail'].
           "</td><td>". $row['receiverName']."</td><td>". $row['receiverEmail']."</td></tr>".
          "<br>";
            }
      }else{
            echo " you have not made any order. you can make order at : <a href='order.html'>order</a>";
      }
       
   break;
   case "driver":
      $sql="select vehicleId from vehicle where driverId=$userId";
      $result=$conn->query($sql);
      $row=$result->fetch_assoc();
      $vehicle=$row['vehicleId'];
       

      $history="select itemid, vehicleId,customerCareId,source,destination,deliveryState,receiverName,receiverEmail,senderName,senderEmail 
      from item  
      join sender ON itemid= orderNo
      where vehicleId=$vehicle and deliveryState='sucessfull'";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
      $result=$conn->query($history);
      
      if($result->num_rows>0) {
         // setting table with a border attribute of '1'
         echo '<a href="profileBack.php">back</a>'; 
            echo "<table border='1'>";
            //table header row
            echo "<tr><th>orderId</th><th>vehicleId</th><th>customerCareId</th> <th>source</th> <th>destination</th><th>deliveryState</th>
            <th>receiver</th> <th>receiverEmail</th> <th>senderName</th> <th> senderEmail</th></tr>";  
             /*fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query 
             as an associative array*/
            while($row=$result->fetch_assoc()){
           echo "<tr><td>" . $row['itemid']. " </td><td>". $row['vehicleId'].  "</td><td>". $row['customerCareId'].
           "</td><td>". $row['source']."</td><td>". $row['destination'].  "</td><td>". $row['deliveryState']."</td><td>". $row['receiverName'].
           "</td><td>". $row['receiverEmail']. "</td><td>". $row['senderName']. "</td><td>". $row['senderEmail']."</td></tr>"."<br>";
                  }
                  echo '<br>';
                   
      }
      else{
            echo " you have not made any delivery.back home ";
      }
      
   break;
   case "customerCare":
      $history="select itemid, vehicleId,senderId,source,destination,deliveryState,charges  
      from item where customerCareId=$userId";
        /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
      $result=$conn->query($history);
      
      if($result->num_rows>0) {
         // setting table with a border attribute of '1'
         echo '<a href="profileBack.php">back</a>'; 
            echo "<table border='1'>";
            //table header row
          echo "<tr><th>orderId</th><th>vehicleId</th><th>senderId</th> <th>source</th> <th>destination</th><th>deliveryState</th>
          <th>charges</th></tr>";  
          
            while($row=$result->fetch_assoc()){
         echo "<tr><td>".$row['itemid']."</td><td>". $row['vehicleId']."</td><td>".$row['senderId'] ."</td><td>"
         .$row['source']."</td><td>".$row['destination']."</td><td>".$row['deliveryState']."</td><td>".$row['charges']."<br>";
            }
      
      }else{
            echo " you have not sorted any order. sort order at : <a href= 'customercare_handle_orders.php'>sort orders</a>";
      } 
       
           
   break;
 
   default:
   header("location:home.html");
   } 
 $conn->close(); //close database connection
