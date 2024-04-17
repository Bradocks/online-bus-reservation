<?php  // Start a session to manage user
session_start();
$senderId=$_SESSION['userId'];
//estalish connnection 
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname);/* using the php new mysqli 
function to establish a connection. */

/* Check if the connection to the database was successful usinh connect_error if 
there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
       die ("connection failled:". $conn->connect_error);
}
    $orderId=$_SESSION['orderId'];
     //update orderstate to Accepted
    $orderstate='canceld';
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
       if($insertIntoOrders){ 
 header("location:clientsDashboard.php");

       }
       else{
          echo "error deleting:". $conn->error;
       }
       
 
 $conn->close();