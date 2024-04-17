<?php 
//estalish connnection to the database
$servername="localhost";
$username="root";
$password="root";
$dbname="busreservation";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful usinh connect_error if there is an connect_error the error will be 
displayed and execution will be terminited by the die function. */
 if ($conn->connect_error)  {
   echo"coection error". $conn->connect_error; //display the connection error if it exists
    die ("connection failled:". $conn->connect_error); // Terminate script execution if the connection fails
}
   // process  form data from the post request and set the collected data to php variable for use in the php script
      $name=$_POST['name']." ".$_POST['lname'];
      $mobileNumber=$_POST['mobileNumber'];
      $email=$_POST['email'];      
      $IDNo = $_POST['IDNo'];
      $DtOfBth=$_POST['DOB'];
      $gender=$_POST['gender'];
      $role=$_POST['role'];
      $userName=$_POST['userName'];

      
   //chek if the username is aready used in the database
   $sql_chekUserName="select * from staff where userName='$userName'"; /*sql query to select from user where the  user name is 
   the username used for registartion */ 
   $result_userName=$conn->query($sql_chekUserName); // set the result of the query to $result_userName variable
   $count=mysqli_num_rows($result_userName); // use mysqli_num_rows function to check the number of rows picked

   /* if the number of rows exeed 0 the user name is  used thus request the client to use another userName to create an account 
   else if there is no row picked the user name is not used thus create the accout in the database*/
   if($count> 0){
      echo "user name already used set another userName";
      echo "<p><a href='adminAddstaff.html'> use another userName to register</a></P>"; /* dislay alink to direct the
       user to create an accoutnt with different userName */
      }else{
   //insert data about staff into database 
      $sqladd="INSERT INTO staff (name,userName,IDNo,phoneNO,email,role,gender,DOB)
      VALUES (?,?,?,?,?,?,?,?,)";//QL query to insert user data into the database */
      // a  query that inserts values using placholders ?
      $stmt=$conn->prepare($sqladd);
      //The bind_param() method binds variables to the placeholders in the SQL query.
      $stmt->bind_param("ssiisisssss",$name,$userName,$IDNo,$mobileNumber,$email,$role,$gender,$DOB);
     /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
      $stmt->execute();
   //check if the sql query was succesfful by checking if it is equivalent to TRUE
      if($stmt){ 
       // If the insertion is successful
       echo"added sucessfully. add another one: <a href='adminAddstaff.html'>Add Another</a>"."<br>";
       echo"or go back to dashBoard <a href='AdminDashboard.php'>Add Another</a>"."<br>";     
       

      } 
      else {
   // If there's an error during insertion, display the error message by concantinating $sql variable that is the query and the error message
      echo" not adedd sucessfully re do: <a href='adminAddstaff.html'>Re do add</a>"."<br>";
      }

   }
  

  //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

