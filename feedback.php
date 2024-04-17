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
         $Domain=$_POST['Domain'];
 
       $Feedback=$_POST['Feedback'];
  //use session variable $_SESSION['userId'] to get $userID
       $userId= $_SESSION['userId'];
       //query the user database filtering by userid to get the user role
       $sql= "select * from user where userId=$userId";
       /*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
       $result=$conn->query($sql);
       // fetch_assoc() method retrieves a single row as an associative array
       $row=$result->fetch_assoc();
       $role= $row['role'];
        if($role){ 
           // an INSERT query that inserts values using placholders ?  
       $stmt= $conn->prepare("INSERT INTO feedback(domain,source,feedBack) VALUES (?,?,?)");
       //The bind_param() method binds variables to the placeholders in the SQL query.
       $stmt->bind_param("sss",$Domain,$role,$Feedback);
       /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
       $stmt->execute();

       if($stmt){
        switch($role){
            case "client":
                  /* header() function in PHP is used to send raw HTTP headers to the client,allowing 
    you to perform various tasks such as redirecting the user to anotherpage.  */
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
        }
       }
        }
        else {
            echo "role not found";
        }
        $conn->close(); //close database connection