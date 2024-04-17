<?php 
// Start a session to manage user
session_start();
//estalish connnection 
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname);// using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful usinh connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
  
    die ("connection failled:". $conn->connect_error); // Terminate script execution if the connection fails
}
   
// process  form data from the post request and set the collected data to php variable for use in the php script
        //item data(from client order submisison)
      $source=$_POST['source'];
      $destination=$_POST['destination'];
      $quantity=$_POST['quantity'];
      $description=$_POST['description'];
      $category=$_POST['category'];   
       
      //receiver date (from client order submission)
      $name=$_POST['name'];
      $IdNo=$_POST['IdNo']; 
      $mobileNumber=$_POST['mobileNumber'];
      $email=$_POST['email'];
      $Location=$_POST['Location'];
      $dOfBth=$_POST['dOfBth'];
      $gender=$_POST['gender'];

      $orderstate='processing';
      
      $userId=$_SESSION['userId'];   

   //insert data into database
     
    $sql="INSERT INTO  orders(senderId,source,destination,quantity,
    description,category,receiverName,receiverIDNO,receiverPhoneNO,receiverEmail,
    receiverLocation,receiverDtOfBth,receiverGender,orderstate)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";// SQL query to insert user data into the database 
    /* a query that inserts values using placholders in prepare function
     using conn object ? */
    $insertIntoOrders=$conn->prepare($sql);
    //The bind_param() method binds variables to the placeholders in the SQL query.
    $insertIntoOrders->bind_param("ississsiisssss",$userId,$source,
    $destination,$quantity,$description,$category,$name,$IdNo,$mobileNumber,$email,
    $Location,$dOfBth,$gender,$orderstate);
    /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
    $insertIntoOrders->execute();
   //check if the sql query was succesfful by checking if it is equivalent to TRUE
   if($insertIntoOrders){ 
    //redirect to waiting 
    header("location:  ClientordersubmissionWait.html");
       
   }
   else {
      //if not inserted redirect to order page to reorder the order using php header function
       header("location:order.html");
   }
   //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

