<?php  // Start a session to manage user
session_start();
$senderId=$_SESSION['userId'];
//estalish connnection 
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname);// using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful usinh connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
       die ("connection failled:". $conn->connect_error);
}
//queryto the database database
$query="SELECT * FROM orders WHERE senderId=$senderId and orderstate='sorted'"; // sql query to select from sorted_orders where senderId is the $senderId  value//
$result= $conn->query($query); // set the result of the query to $result variable
$count=mysqli_num_rows($result);  // use mysqli_num_rows function to check the number of rows picked

/* if the number of rows exeed 0 the  order exists
else if there is no row picked the user name is not used thus create the accout in the database*/
if ($count> 0) { 
     
    // fetch_assoc() method retrieves a single row as an associative array
    $row = $result->fetch_assoc();
    $orderId = $row['orderId'];
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
    $customerCareId=$row['customerCareId'];
    $vehicleId=$row['vehicleId'];
    $vehicleplateNumber=$row['plateNumber'];
    $vehicleType=$row['vehicleType'];
    $driverName=$row['driverName'];
    $driverPhoneNO=$row['driverPhoneNO'];
    $charges=$row['charges'];

    $_SESSION['orderId']= $orderId;

}    
 else{
    echo "please refresh";
     
}
      
$conn->close();
?>
<html>
    <head>
        <title>user account </title>
        <link rel="stylesheet" href="formms.css">
    </head>
    <body>
     <div style="background-color:aliceblue; width:700px;"> 
      
            <p style="text-align: center;">Item Details</p>
            <p>orderId: <?php echo $orderId; ?><br></p> 
             
            <p>source : <?php echo  $source; ?><br></p>
            
        <p>destination : <?php echo $destination; ?><br></p>
            
        <p>Quantity (in numbers): <?php echo  $quantity; ?> <br></p>
         
        <p>description: <?php echo  $description; ?><br></p>
            
       <p>category: <?php echo  $category; ?><br></p>   
        
         <p style="text-align: center;">Receiver details</p>
         <p>Name : <?php echo  $name; ?><br></p>
          
          <p>Identification number(ID):  <?php echo  $IdNo; ?> <br></p>
          
        <p>MobileNumber:  <?php echo  $mobileNumber; ?><br></p>
           
        <p>Email: <?php echo  $email; ?><br></p>
          
        <p>Location: <?php echo $Location; ?><br></p>
          
          <p>date of birth:  <?php echo  $dOfBth; ?><br></p>
           
        <p>gender: <?php echo  $gender; ?><br></p>         
          
         <p>customerCareId: <?php echo   $customerCareId; ?><br></p>         
         
     <P style="text-align: center;">vehicle details and charges</P>
        <p>vehicle plate number:  <?php echo $vehicleplateNumber; ?><br></p>
        
        <p>vehicle type:  <?php echo $vehicleType; ?><br></p>

        <p>driver Name:  <?php echo  $driverName; ?><br></p>
        
        <p>driver Contact: <?php echo  $driverPhoneNO; ?><br></p>         
         
        <p>charges: <?php echo  $charges; ?><br></p>         
         
     
        <h4 style="background-color: green; width:180px"><a href="payment.html">accept and submit order</a><h4>
 
        <h4 style="background-color: red; width:120px"><a href="cancel_order-Client.php">cancel order</a></h4>
      
 
     </div>
    </body>
</html>