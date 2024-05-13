<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();
// process  form data from the post request and set the collected data to php variable for use in the php script
 
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
       $stmt= $conn->prepare("INSERT INTO feedback(feedBack) VALUES (?)");
       //The bind_param() method binds variables to the placeholders in the SQL query.
       $stmt->bind_param("s",$Feedback);
       /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
       $stmt->execute();

       if($stmt){
        switch($role){
            case "client":
                  /* header() function in PHP is used to send raw HTTP headers to the client,allowing 
    you to perform various tasks such as redirecting the user to anotherpage.  */
                header("location:passengerDashboard.php");
                break;
                case "driver":
                header("location:driverDashboard.php");
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
