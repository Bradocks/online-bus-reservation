<?php 
// Start a session to manage user
session_start(); 
//estalish connnection to the database
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful usinh connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
   echo"coection error". $conn->connect_error; //display the connection error if it exists
    die ("connection failled:". $conn->connect_error); // Terminate script execution if the connection fails
}
$senderId=$_SESSION['userId'];

$orderId=$_SESSION['orderId'];


//payment dettails
 $paymentMethod=$_POST['paymentMethod'];
 $paymentStatement=$_POST['paymenStatement'];
//queryto the database database
$query="SELECT * FROM orders WHERE orderId=$orderId ";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
$result= $conn->query($query);
$count=mysqli_num_rows($result);// use the mysqli_num_rows function to get the number of rows selected and set it to variable $count
   
if ($count> 0) { 
     
    //the fetch_assoc() method retrieves a single row as an associative array
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
    $driverPhoneNO=$row['driverPhoneNO'];
    $driverName=$row['driverName'];
    $charges=$row['charges'];
     //using a php function rando_int to a llocate a random value to variable orderCode
    $orderCode=random_int(27,10000);

    //update orderstate to Accepted
    $orderstate='Accepted';
    $sql="update orders set orderstate=?
     where orderId=?";
    /* a query that inserts values using placholders in prepare function
    using conn object ? */
    $insertIntoOrders=$conn->prepare($sql);
    //The bind_param() method binds variables to the placeholders in the SQL query.
    $insertIntoOrders->bind_param("si",$orderstate,$orderId);
       /* sends the query to the database server for execution with the 
      provided parameter values, returns true or false */

      $insertIntoOrders->execute();
// a query that inserts values using placholders in prepare function using conn object to the item table 
   
    $insertItem=$conn->prepare("INSERT INTO item (itemid,senderId,vehicleId,customerCareId,
    source,destination,quantity,description,category,charges,PaymentMethod,PaymentStatement,
    orderCode)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    //The bind_param() method binds variables to the placeholders in the SQL query.
    $insertItem->bind_param("iiiissississi",$orderId,$senderId,$vehicleId,$customerCareId,
       $source,$destination,$quantity,$description,$category,$charges,$paymentMethod,
       $paymentStatement,$orderCode);
    /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
       $insertItem->execute();
    if(!$insertItem)
   {
    die("stmt dint execute:" );
   }
    //get sender details from user table using senderId
    $sql_getSenderDetails=" SELECT * from user WHERE userId=$senderId";
    $senderDetails=$conn->query($sql_getSenderDetails);
    $rowDetails = $senderDetails->fetch_assoc();
    $senderNo=$rowDetails["userId"];
    $senderName=$rowDetails["name"];
    $senderIDNo=$rowDetails["IDNO"];
    $senderPhoneNumber=$rowDetails["mobileNumber"];
    $senderEmail=$rowDetails["email"];
    $senderLocation=$rowDetails["address"];
    $senderDtOfBth=$rowDetails["DtOfBth"];
    $senderGender=$rowDetails["gender"];

    //insert sender and receiver details in the sender table

    /* a query that inserts values using placholders in prepare function
     using conn object ? */
 
    $stmt=$conn->prepare("INSERT INTO sender(orderNo,senderId,senderName,senderIDNo, senderPhoneNo,senderEmail,senderLocation,senderDtOfBth,
     senderGender,receiverName,receiverIDNO,receiverPhoneNo,receiverEmail,receiverLocation,receiverDtOfBth,receiverGender) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    //The bind_param() method binds variables to the placeholders in the SQL query.
       $stmt->bind_param("iisiisssssiissss",$orderId,$senderId,$senderName,$senderIDNo,       
       $senderPhoneNumber,$senderEmail,$senderLocation,$senderDtOfBth,
   $senderGender,$name,$IdNo,$mobileNumber,$email,$Location,$dOfBth,$gender);
   /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
   $stmt->execute();
  
   if($stmt)   
                   header("Location:clientsDashboard.php");
   }else{
    header("Location:client_order_sorted.php");
   }
        

  
$conn->close();