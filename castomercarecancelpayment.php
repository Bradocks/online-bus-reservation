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
$orderId=$_SESSION['orderNo'];
$paymentdetail='erronious';
 //mark order's payment detail as paid 
 $sql="UPDATE item set paymentDetail=? where itemid=$orderId";
 $insert=$conn->prepare($sql);
 $insert->bind_param("s",$paymentdetail);
 $insert->execute();
header("Location:customerCareConfirmPayment.php");
$conn->close();