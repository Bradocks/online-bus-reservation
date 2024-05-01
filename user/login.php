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
// process  form data from the post request and set the collected data to php variable for use in the php script
         $username=$_POST['userName'];
 
       $password=$_POST['password'];

       $userRole=$_POST['role'];
       
        
       
   //query to the database database to fetch user details
   $query="SELECT * FROM user WHERE userName='$username'"; //select from user table where userName column as value $username provided
   $result= $conn->query($query); //set the query results to variable $results
   $count=mysqli_num_rows($result);// use the mysqli_num_rows function to get the number of rows selected and set it to variable $count
   
   // Check if the query was successful, if $result as some data
if ($result) {
  // Fetch the user details using the php fetch_assoc() function  and set the details to variable $row
     $row = $result->fetch_assoc();
     // Verify password using password_verify function check if $row has data and the provided password resembles the one in the database
     if ($row && password_verify($password, $row['password'])) {
      // If password is verified, query the database to fetch user role
        $get_role_query = "SELECT * FROM user WHERE userName='$username'"; 
        $get_role_result = $conn->query($get_role_query);//set the query results to variable $get_role_result
        // Check if the query was successful by checking in the results has a row r row value is greater tha zero using num_row
        if ($get_role_result && $get_role_result->num_rows > 0) {
          // Fetch the role using the fetch_assoc() function and assign to variable $row
          $row = $get_role_result->fetch_assoc();
          //store session variables to be used through out the user session 
           $_SESSION['userId'] = $row['userId']; //set variable $_session['userid'] to row  value $row['userid']
           $_SESSION['userName'] = $row['userName'];//set variable $_session['userName'] to row  value $row['userName']
          $role = $row['role'];//set variable $role to the value of $row['role'] value
           // Redirect users based on their roles using a switch 

           if($userRole===$role){
          switch ($role){
          case "client":
          header("location:clientsDashboard.php");
          break;
          case "driver":
          header("location:driversDashboard.php");
          break;
          case "customerCare":
          header("location:customercareDashboard.php");
          break;
          case "admin":
          header("location:AdminDashboard.php");
          break;  
          default:
          header("location:home.html");
          }

        }else{
          echo"please enter your supposed role at <a href='login.html'> login</a>";
        }
      }
      }else{
        // If password is incorrect, display error message
        echo "login not succesfull. Try logging in again  or resert password ";
        //redirect for another loggin try or allow password reset
        echo"<a href='login.html'> login</a>";
         }
       
     }else{
      // If the query fails, display error message query failed and concatinate with the $conn error message
      echo "Query failed: " . $conn->error;
       }
         //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

