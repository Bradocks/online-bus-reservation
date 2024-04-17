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
$customercare=$_SESSION['userId'];
//query to the database database
$query="SELECT itemid,vehicleId,quantity,description,charges,PaymentMethod,
PaymentStatement,senderName,senderIDNo,senderPhoneNo,senderEmail,senderGender,
receiverName,receiverIDNO,receiverPhoneNO,receiverEmail,receiverGender
FROM item
join  sender ON  itemid=orderNo
where paymentDetail is NULL and customerCareId=4";
/*executes the SQL query using the query() method of the database connection 
object $conn. it sends the SQL query to the database server for execution.*/
$result= $conn->query($query);
$count=mysqli_num_rows($result);// use the mysqli_num_rows function to get the number of rows selected and set it to variable $count
if ($count< 1){
  echo"no available payments to verify <a href=''>Refresh</a> <br> ";
     echo"<a href='customercareDashboard.php'>or go back to dashboard</a>";
  exit;
}
else {  
    // fetch_assoc() method retrieves a single row as an associative array
    $row = $result->fetch_assoc();
     //sender info
     $_SESSION['orderNo']=$row['itemid'];
    $senderName=$row['senderName'];
    $senderIDNO=$row['senderIDNo'];
    $sendermobileNumber=$row['senderPhoneNo'];
    $senderEmail=$row['senderEmail'];
    $senderGender=$row['senderGender'];
    //receiver info
    $name=$row['receiverName'];
    $IdNo=$row['receiverIDNO']; 
    $mobileNumber=$row['receiverPhoneNO'];
    $email=$row['receiverEmail'];
    $gender=$row['receiverGender'];

    //item detais
    $quantity=$row['quantity'];
    $description=$row['description'];
    $vehicleId=$row['vehicleId'];

    // payment info
    $charges=$row['charges'];
    $PaymentMethod=$row['PaymentMethod'];
    $PaymentStatement=$row['PaymentStatement'];  
    
    //get vehicle details
    $sql="SELECT type,plateNo,driverId from vehicle where vehicleId=$vehicleId";
    $result=$conn->query($sql);
    $count=mysqli_num_rows($result);
    if($count>0){
      $row=$result->fetch_assoc();
      $vehicleType=$row['type'];
      $vehicleplateNumber=$row['plateNo'];
      $DriverId=$row['driverId'];
    }else{
      echo" vehicle does not exist";
    }  
    //get driver details 

    $sqlQuery="SELECT name,mobileNumber from user where userId=$DriverId";
    $result=$conn->query($sqlQuery);
    $count=mysqli_num_rows($result);
    if($count>0){
      $driverrow=$result->fetch_assoc();
      $driverName=$driverrow['name'];
      $driverPhoneNO=$driverrow['mobileNumber'];
    }


  
    }   
      
$conn->close();
// 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>customercare confirm payment</title>
        <link rel="stylesheet" href="formms.css">
    </head>
    <body>
     <div> 
     <form style="width: 700px;" method="POST" action="customerCareConfirmpaymentProcessing.php" onsubmit="return customercareOrderSorting()">
     <p>payment details</p>
        <p>charges: <?php echo $charges; ?><br></p>
           
      <p>paymentMethod: <?php echo $PaymentMethod; ?> <br></p>

          <p>PaymentStatement: <?php echo  $PaymentStatement; ?> <br></p> 
         
     <p style="text-align: center;">sender Details</p>
        <p>Name : <?php echo  $senderName; ?><br></p>
            
        <p>Mobile number:  <?php echo $sendermobileNumber; ?><br></p>
            
        <p>Email: <?php echo  $senderEmail; ?> <br></p>
         
        <p>ID NO: <?php echo  $senderIDNO; ?><br></p>
            
       <p>Gender: <?php echo  $senderGender; ?><br></p>         
          

         <p>Receiver details</p>
         <p>Name: <?php echo   $name; ?><br></p>
           
          <p>Mobile number: <?php echo  $mobileNumber; ?> <br></p>
          
        <p>Email: <?php echo   $email; ?><br></p>
           
        <p>ID NO: <?php echo   $IdNo; ?><br></p>
          
        <p>Gender: <?php echo  $gender; ?><br></p>

        <p>item details</p>
         <p>quantity: <?php echo   $quantity; ?><br></p>
           
          <p>description: <?php echo  $description; ?> <br></p>

          <p>driver and vehicle details</p>
         <p>name: <?php echo    $driverName; ?><br></p>
           
          <p>mobile Number: <?php echo  $driverPhoneNO; ?> <br></p>

          <p>vehicle type: <?php echo   $vehicleType; ?><br></p>
           
          <p>vehicle plate number: <?php echo  $vehicleplateNumber; ?> <br></p> 
           
 <p>if payment is confirmed and email sent to both sender and receiver confirm else cancel</p>                
               <button type="submit">submit</button>  
               <br>

               <br>
                
               <a href="customercarecancelpayment.php">cancel</a>
        </form>
     </div>
         </body>
</html>