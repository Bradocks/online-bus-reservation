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
$query="SELECT * FROM  orders WHERE senderId=$senderId and orderstate='sorted'"; /* sql query to select from sorted_orders where senderId is t
he $senderId  value */
$result= $conn->query($query); // set the result of the query to $result variable
$count=mysqli_num_rows($result);  // use mysqli_num_rows function to check the number of rows picked

/* if the number of rows exeed 0 the  order exists in sorted_orders
else if there is no row picked the  order does not exists in sorted_orders */
if ($count> 0) {     
    header("location: client_order_sorted.php");
     
}    
 else{
    //chek if the order is awaiting to be sorted by the customerCare
    $query="SELECT * FROM orders WHERE  senderId=$senderId and orderstate='processing'"; /* sql query to select from pending_orders_client table
     where senderId is the $senderId  value */
    $result_2= $conn->query($query); // set the result of the query to $result_2 variable
    $count_2=mysqli_num_rows($result_2);  // use mysqli_num_rows function to check the number of rows picked

/* if the number of rows exeed 0 the  order exists in pending_orders_client
else if there is no row picked the  order does not exists in pending_orders_client */
    if ($count_2>0){
        header("location:  ClientordersubmissionWait.html");

    }
     else{
        header("location: ClientNopPendingOrders.html");
     }
}
      
$conn->close();
