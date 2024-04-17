<?php
// Start a session to manage user
session_start(); 
//estalish connnection 
$servername="localhost";
$username="Newton";
$password="database@123";
$dbname="parceldelivery";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful usinh connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
       die ("connection failled:". $conn->connect_error); // Terminate script execution if the connection fails
        
}  

$userId=$_SESSION['userId'];

//get user details
$user="select  name,mobileNumber,email,address,userName,IDNO,DtOfBth,gender
from user  where  userId=$userId";
/*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
$result=$conn->query($user);
//the fetch_assoc() method retrieves a single row as an associative array
      $row=$result->fetch_assoc ();
    
      $name=$row['name'];
      $mobileNumber=$row['mobileNumber'];
      $email=$row['email'];
      $address=$row['address'];
      $userName=$row['userName'];
      $IDNO=$row['IDNO'];
      $DtOfBth=$row['DtOfBth'];
      $gender=$row['gender'];
       
 
 $conn->close();
 ?>
 <!DOCTYPE html>
<html>
    <head>
        <title>user account </title>
        <link rel="stylesheet" href="formms.css">
    </head>
    <body>
     <div> 
        <form  method="POST" action="editProfileProcessing.php" onsubmit="return editProfileVAlidate ()">
            <p>Edit profile by entering new desired values</p>
        <label>Full Name : <?php echo $name; ?><br></label>
          <input type="text" id="name" name="name"><br>
          <label>MobileNumber: <?php echo $mobileNumber; ?><br></label>
          <input type="text" id="mobileNumber" name="mobileNumber"><br>
          <label> Email :<?php echo  $email ; ?> <br></label>
          <input type="text" id="email" name="email"><br>
          <label>Address :<?php echo $address; ?><br></label>
          <input type="text" id="address" name="address"><br>
          <label>IDNO :<?php echo $IDNO; ?><br></label>
          <input type="text" id="IDNO" name="IDNO"><br>
          <label>Date of Birth :<?php echo $DtOfBth; ?><br></label>
          <input type="text" id="DtOfBth" name="DtOfBth"><br>
          <label>Gender :<?php echo $gender; ?></label>         
        <select name="gender" id="gender">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>

        <button type="submit" >submit</button>  
        <br>
       <h5><a href="profile.php">Back</a></h5><br>
        </form>
     </div>
     <script src="registration.js"></script>
    </body>
</html>