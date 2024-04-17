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
$query="SELECT * FROM  orders where orderstate='processing'";
/*executes the SQL query using the query() method of the database connection 
object $conn. it sends the SQL query to the database server for execution.*/
$result= $conn->query($query);
$count=mysqli_num_rows($result);// use the mysqli_num_rows function to get the number of rows selected and set it to variable $count
   
if ($count> 0) { 
       /* header() function in PHP is used to send raw HTTP headers to the client,allowing 
    you to perform various tasks such as redirecting the user to anotherpage.  */
         header("location:customercare_handle_orders.php");
   
       }    
 else{
    header("location:customercare_no_orders_available.html");
}
      
$conn->close();//close database connection
