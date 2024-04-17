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
//queryto the database database
$query="SELECT * FROM orders where orderstate='processing'";
/*executes the SQL query using the query() method of the database connection 
object $conn. it sends the SQL query to the database server for execution.*/
$result= $conn->query($query);
$count=mysqli_num_rows($result);// use the mysqli_num_rows function to get the number of rows selected and set it to variable $count
   
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
      
     // Check if the query was successful
   

    }
    
 else{
    header("location:customercare_no_orders_available.html");
}
      
$conn->close();
// 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>user account </title>
        <link rel="stylesheet" href="formms.css">
    </head>
    <body>
     <div> 
     <form style="width: 700px;" method="POST" action="CustomerCareOrderSorted.php" onsubmit="return customercareOrderSorting()">
            <p style="text-align: center;">Item Details</p>
        <p> source : <?php echo  $source; ?><br></p>
            
        <p>destination:  <?php echo $destination; ?><br></p>
            
        <p>Quantity: <?php echo  $quantity; ?> <br></p>
         
        <p>description: <?php echo  $description; ?><br></p>
            
       <p>category: <?php echo  $category; ?><br></p>         
          

         <p style="text-align: center;">Receiver details</p>
         <p>Name: <?php echo  $name; ?><br></p>
           
          <p>Identification number(ID): <?php echo  $IdNo; ?> <br></p>
          
        <p>MobileNumber: <?php echo  $mobileNumber; ?><br></p>
           
        <p>Email: <?php echo  $email; ?><br></p>
          
        <p>Location: <?php echo  $Location; ?><br></p>
          
          <p>date of birth: <?php echo  $dOfBth; ?><br></p>
           
        <p>gender: <?php echo  $gender; ?><br></p>         
          

        <p>from the client order compute and fill the following</p>
        <label>vehicleId</label>         
        <input type="text" name="VehicleId" id="vehicleId"><br>
         
        <label>charges</label>         
        <input type="text" name="charges" id="charges" ><br>

       <button type="submit">submit</button>  
        </form>
     </div>
     <script src="registration.js"></script>
    </body>
</html>