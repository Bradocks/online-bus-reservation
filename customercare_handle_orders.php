<?php 
//estalish connnection 
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname);
 if ($conn->connect_error)  {
       die ("connection failled:". $conn->connect_error);
}
//queryto the database database
$query="SELECT * FROM orders where orderstate='processing'";
/*executes the SQL query using the query() method of the database connection 
object $conn. it sends the SQL query to the database server for execution.*/
$result= $conn->query($query);
$count=mysqli_num_rows($result);// use the mysqli_num_rows function to get the number of rows selected and set it to variable $count
   
if ($count> 0) { 
    $get_role_query = "SELECT orderId FROM orders where orderstate='processing'";
    $get_role_result = $conn->query($get_role_query);
    // fetch_assoc() method retrieves a single row as an associative array
    $row = $get_role_result->fetch_assoc();
    $orderId = $row['orderId'];
      
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
        <form  method="POST" action=" customercare_handle_orders_sort.php">
            <p style="text-align: center;">orders menu</p>
        <p>available pending orders</p>
        <?php echo $count; ?><br>
          <p>sort orders in their request time order</p>
         <?php echo  $orderId; ?><br>     
       <button type="submit">sort</button>  
        </form>
     </div>
    </body>
</html>