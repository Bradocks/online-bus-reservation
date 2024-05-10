<?php
// Start a session to manage the user
session_start(); 
//estalish connnection 
$servername="localhost";
$username="root";
$password="root";
$dbname="busreservation";
$conn=new mysqli($servername,$username,$password,$dbname); // using the php new mysqli function to establish a connection.

/* Check if the connection to the database was successful using connect_error if there is a connect_error the error will be 
displayed and execution will be terminated by the die function. */
 if ($conn->connect_error)  {
       die ("connection failed:". $conn->connect_error); // Terminate script execution if the connection fails
        
}  

$userId=$_SESSION['userId'];
 

//query to the database database to fetch user details
$query="SELECT * FROM user WHERE userId='$userId'"; //select from user table where userName column as value $username provided
$result= $conn->query($query); //set the query results to variable $results
 
// Fetch the user details using the php fetch_assoc() function  and set the details to variable $row
$row = $result->fetch_assoc();

$role = $row['role'];//set variable $role to the value of $row['role'] value
// get history based on their roles using a switch 
switch ($role) {
   case "passenger":
      $history = "select bookingid, vehicleId,departure,destination,
      charges,PaymentMethod,paymentDetail
      from booking  
      join passenger ON  bookingid= ticketId
      where booking.passengerId=$userId";
      /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
      $result = $conn->query($history);

      if ($result->num_rows > 0) {
         // setting table with a border attribute of '1'
         echo '<a href="profileBack.php">back</a>';
         echo "<table border='1'>";
         //table header row
         echo "<tr><th>bookingId</th><th>vehicleId</th><th>departure
            </th><th>destination</th>><th>charges</th>
            <th>PaymentMethod</th><th>paymentDetail</th></tr>";
         /*fetch_assoc() method is a function used in PHP to fetch a single row of 
         result set from a MySQL database query as an associative array*/
         while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['bookingId'] . "</td><td>" . $row['vehicleId'] . "</td><td>" . $row['departure'] . "</td><td>" . $row['destination'] . "</td><td>" . $row['charges'] . " </td><td>" . $row['PaymentMethod'] . " </td><td>" . $row['paymentDetail'] .
               "</td></tr>" .
               "<br>";
         }
      } else {
         echo "No booking made! Book with us at : <a href='book.html'>Book</a>";
      }

      break;
   case "driver":
      $sql = "select vehicleId from vehicle where driverId=$userId";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $vehicle = $row['vehicleId'];


      $history = "select bookingId,vehicleId,departure,destination,passengerName,passengerEmail 
      from booking  
      join passenger ON ticketid= bookingNId
      where vehicleId=$vehicle and destination='sucessfull'";
      /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
      $result = $conn->query($history);

      if ($result->num_rows > 0) {
         // setting table with a border attribute of '1'
         echo '<a href="profileBack.php">back</a>';
         echo "<table border='1'>";
         //table header row
         echo "<tr><th>bookingId</th> <th>vehicleId</th> <th>departure</th> <th>destination</th>
             <th>passengerName</th> <th> passengerEmail</th></tr>";
         /*fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query 
         as an associative array*/
         while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['bookingId'] . " </td><td>" . $row['vehicleId'] . "</td><td>" . $row['departure'] . "</td><td>" . $row['destination'] . "</td>><td>" . $row['passengerName'] . "</td><td>" . $row['passengerEmail'] . "</td></tr>" . "<br>";
         }
         echo '<br>';

      } else {
         echo " No trips yet! ";
      }

      break;

   default:
      header("location:home.html");
}
$conn->close(); //close database connection



    
