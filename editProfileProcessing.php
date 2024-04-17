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
   // process  form data from the post request and set the collected data to php variable for use in the php script
      $name=$_POST['name'];
      $mobileNumber=$_POST['mobileNumber'];
      $email=$_POST['email'];
      $address=$_POST['address'];
      $IDNo=$_POST['IDNO'];
      $DtOfBth=$_POST['DtOfBth'];
      $gender=$_POST['gender'];

      $userId=$_SESSION['userId'];
       
      $sqlupdate="UPDATE user SET name=?, mobileNumber=?, email=?, address=?,  IDNO=? ,DtOfBth=?,gender=?
      where userId=?";
      // an update query that inserts values using placholders in prepare function using conn object ? 
    $stmt=$conn->prepare($sqlupdate);
    //The bind_param() method binds variables to the placeholders in the SQL query.
    $stmt->bind_param("sississi",$name,$mobileNumber,$email,$address,$IDNo,$DtOfBth,$gender,$userId);
     /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
    $stmt->execute();
        
   //check if the sql query was succesfful by checking if it is equivalent to TRUE
      if($stmt){ 
       // If the update is successful, redirect the user to the profile view page using php header function        
      header("location:profile.php");

      } 
      else {
   /*If there's an error in the update, display the error message by concantinating $sql variable that is the query 
   and the error message */
      echo"update unsucessful. redo at<a href='profile.php'>Back</a>"."<br>" ;
      }
  

  //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

