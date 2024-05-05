<?php 
//establish connection to the database
$servername="localhost";
$username="root";
$password="root";
$dbname="busreservation";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful using connect_error if there is a connect_error the error will be 
displayed and execution will be terminated by the die function. */
 if ($conn->connect_error)  {
   echo"coection error". $conn->connect_error; //display the connection error if it exists
    die ("connection failed:". $conn->connect_error); // Terminate script execution if the connection fails
}
   // process  form data from the post request and set the collected data to php variable for use in the php script
      $name=$_POST['name']." ".$_POST['lname'];
      $mobileNumber=$_POST['mobileNumber'];
      $email=$_POST['email'];      
      $IdNo = $_POST['IdNo'];
      $DtOfBth=$_POST['DOB'];
      $gender=$_POST['gender'];
      $role=$_POST['role'];
      $userName=$_POST['userName'];

      
   //check if the username is already used in the database
   $sql_chekUserName=" select * from staff where userName='$userName'"; /*sql query to select from user where the  user name is 
   the username used for registration */ 
   $result_userName=$conn->query($sql_chekUserName); // set the result of the query to $result_userName variable
   $count=mysqli_num_rows($result_userName); // use mysqli_num_rows function to check the number of rows picked

   /* if the number of rows exceeds 0 the user name is  used, requesting the client to use another username to create an account 
   else if there is no row picked the user name is not used, creating the account in the database*/
   if($count> 0){
      echo "user name taken";
      echo "<p><a href='adminAddstaff.html'> choose another name</a></P>"; /* DisplayLink to direct the
       user to create an account with a different userName */
      }else{
   //insert data about staff into database 
      $sqladd="INSERT INTO staff (name,userName,IdNo,phoneNO,email,role,gender,DOB)
      VALUES (?,?,?,?,?,?,?,?,)";//QL query to insert user data into the database */
      // a  query that inserts values using placholders ?
      $stmt=$conn->prepare($sqladd);
      //The bind_param() method binds variables to the placeholders in the SQL query.
      $stmt->bind_param("ssiissss",$name,$userName,$IdNo,$mobileNumber,$email,$role,$gender,$DOB);
     /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
      $stmt->execute();
   //check if the sql query was successful by checking if it is equivalent to TRUE
      if($stmt){ 
       // If the insertion is successful
       echo"Staff Added <a href='adminAddstaff.html'>Add staff</a>"."<br>";
       echo"Back to dashBoard <a href='AdminDashboard.php'>Add staff</a>"."<br>";     
       

      } 
      else {
   // If there's an error during insertion, display the error message by concatenating $sql variable that is the query, and the error message
      echo" Failed!: <a href='adminAddstaff.html'>Add staff</a>"."<br>";
      }

   }
  

  //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

