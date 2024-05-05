<?php 
//estalish connnection to the database
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

//check if the type is set as a query parameter
/* isset($_GET['type']): This checks if the 'type' parameter is set in the GET request. $_GET is a superglobal array in PHP
 that contains variables passed to the current script via the URL parameters (GET method).
 This condition ensures that the 'type' parameter is present in the URL. its a bollean returns true if it is present*/
if(isset($_GET['type'])){
  // assigns 'type' parameter to the variable $type.
    $type=$_GET['type'];
    //starts a switch statement that runs either of the cases based on the value of the 'type' parameter.
    switch($type){


         //simple reports
        case "listOfStaff":
          //call the function if its==='type' parameter
          list_of_staff($conn);
          break;
        case "listOfVehicles":
          //call the function if its==='type' parameter
           list_of_vehicles($conn);
           break;
         case "listOfUsers":
          //call the function if its==='type' parameter
          list_of_users($conn);
          break; 
        
          case "listOfpassengers":
          //call the function if its==='type' parameter
          list_of_passengers($conn);
          break;
         case "listOfFeedbacks":
          //call the function if its==='type' parameter
            list_of_feedback($conn);
            break;
            case "listOfbookings":
          //call the function if its==='type' parameter
            list_of_bookings($conn);
            break;

    }
}
/* The isset($_POST) function checks if the $_POST superglobal array contains any data.
 If data has been sent via POST, this condition evaluates to true else it evaluates to false, it's a boolean. the $_POST superglobal 
 array contains data submitted via an HTML form using the POST method, which allows PHP to access form data. */
elseif(isset($_POST)){
  //assigns the value of the 'category' parameter sent via POST to the variable $category.
    $category=$_POST['category'];
    //starts a switch statement based on the value of the 'category' parameter received via POST
    switch($category){


      //join reports case
        case "booking":
          //call the function if its==='category' parameter
            bookingDetails($conn);
            break;
        case "passenger":
          //call the function if its==='category' parameter
            passengerActivities($conn);
           break;
            break;
        case "driver":
          //call the function if its==='category' parameter
            DriverActivities($conn);
            break;

            
            //filter reports case
      
         case "vehicleId":
          //call the function if its==='category' parameter
               list_of_itemByvehicleId($conn);
              break;
          
         case "state": 
          //call the function if its==='category' parameter
                list_of_bookingBystate($conn);
               break;
         case "departure":
          //call the function if its==='category' parameter
                list_of_bookingBydeparture($conn);
               break;
         case "destination":
          //call the function if its==='category' parameter
                list_of_bookingBydestination($conn);
               break;
          case "category":
            //call the function if its==='category' parameter
                list_of_bookingBycategory($conn);
               break;
         case "route":
          //call the function if its==='category' parameter
                list_of_bookingByroute($conn);
               break;
         case "charges":
          //call the function if its==='category' parameter
                list_of_bookingBycharges($conn);
               break;
          case "time":
            //call the function if its==='category' parameter
                list_of_bookingsBytime($conn);
               break;

               //timely reports
         case "date":
            //call the function if its==='category' parameter
                bookingsByDate($conn);
               break;

          case "Month":
            //call the function if its==='category' parameter
            bookingsByMonth($conn);
               break;

           case "Year":
             //call the function if its==='category' parameter
             bookingsByYear($conn);
                break;
    }

}
//staff  ##simple reports 
//a function taking  $conn parameter that provides a connection to the database 
function list_of_staff($conn){
 //mysqli query to the database to select all from the staff table
$staff="select * from staff";
/* executes the SQL query using the database connection represented by $conn using the query mysqli method
and stores the result in the $result variable. */
 $result=$conn->query($staff);
// check  if the query result has any rows by ensuring the number of rows is more than 0 using num_rows
if($result->num_rows>0) {
  // setting table with a border attribute of '1'
  echo"<a href='adminReports.php'>back</a>";
    echo"<table border='1'>";
    //table header row userName
    echo" <tr> <th>staffId</th> <th>Name</th> <th> userName </th><th>IdNo</th> <th>Phone Number</th> <th>Email</th>
    <th>position</th> <th>state</th> <th>Gender</th> <th>date of birth</th> 
    //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
      while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row while looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
   echo "<tr><td>". $row['staffId']."</td><td>". $row['name']."</td><td>". $row['userName']."</td><td>".  $row['IdNo']."</td><td>".  $row['phoneNO']."</td><td>".
    $row['email']."</td><td>". $row['position']. "</td><td>".  $row['state']. "</td><td>".
     $row['gender']."</td><td>". $row['DOB']. "</td><td>".
    "<br>";
      }
 
}
}


function list_of_bookings($conn){
  //mysqli query to the database to select all from the staff table
 $staff="select * from bookings";
 /* executes the SQL query using the database connection represented by $conn using query mysqli method
 and stores the result in the $result variable. */
  $result=$conn->query($staff);
 //Check  if the query result has any rows by ensuring the number of rows is more than 0 using num_rows
 if($result->num_rows>0) {
   // setting table with a border attribute of '1'
   echo"<a href='adminReports.php'>back</a>";
     echo"<table border='1'>";
     //table header row 
     echo" <tr> <th>bookingId</th> <th>passengerId</th> <th>departure/th> <th>destination</th> 
     <th>category</th> <th>vehicleId</th><th>charges</th> ";
     //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
       while($row=$result->fetch_assoc()){
        
         /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
         of the result set returned by the SQL query. Inside the loop: */
    echo "<tr><td>".$row['bookingId']."</td><td>".$row['passengerId']."</td><td>".$row['departure']."</td><td>". $row['destination']."</td><td>".
    ."</td><td>".$row['category']."</td><td>". $row['vehicleId']."</td><td>".$row['charges']. "</td></tr>".
     "<br>";
       }
  
 }
 }
 

//User reports
//a function taking  $conn parameter that provides connection to the database
function list_of_users($conn){
 //mysqli query to the data base to select all from user table
    $users="select * from user";
    /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
     $result=$conn->query($users);
    
    if($result->num_rows>0) {
      echo"<a href='adminReports.php'>back</a>";
         // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
        echo" <tr> <th> userId</th> <th>Name</th> <th>Phone Number</th> <th>Email</th>
        <th>role</th> <th>userName</th> <th>password</th> <th>IdNo</th>  <th>Date of birth</th> <th>Gender</th></tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
          while($row=$result->fetch_assoc()){
             /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
       echo "<tr><td>". $row['userId']."</td><td>". $row['name']."</td><td>".  $row['mobileNumber']."</td><td>".  
        $row['email']."</td><td>". $row['role']. "</td><td>".  $row['userName']. "</td><td>".
         $row['password']."</td><td>". $row['IdNo']. "</td><td>".$row['DOB']. "</td><td>".$row['gender']."</td></tr>".
        "<br>";
          }
     
    }
    }
     

    //a function taking  $conn parameter that provides connection to the database
    function list_of_vehicles($conn){
 //mysqli query to select all from table vehicle
        $vehicles="select * from vehicle";
        /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
         $result=$conn->query($vehicles);
        
        if($result->num_rows>0) {
          echo"<a href='adminReports.php'>back</a>";
             // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th> vehicleId</th> <th>plateNo</th> <th> type</th> <th>capacity</th> <th> state</th> 
            <th>driverId</th> </tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
              while($row=$result->fetch_assoc()){
                /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
           echo "<tr><td>". $row['vehicleId']."</td><td>". $row['plateNo']."</td><td>".  $row['type']."</td><td>".  
            $row['capacity']."</td><td>". $row['state']."</td><td>". $row['driverId']. "</td></tr>".
            "<br>";
              }
         
        }
        }
       //a function taking  $conn parameter that provides connection to the database
        function list_of_passenger($conn){
 //mysqli query to select all from table passenger
            $sender="select * from passenger";

          /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
             $result=$conn->query($sender);
            
      if($result->num_rows>0) {
        echo"<a href='adminReports.php'>back</a>";
        // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
      echo" <tr> <th>passengerId</th> <th>passenger Name</th> <th> passengerIdNo</th> <th>passengerPhoneNo</th> <th> passengerEmail</th> 
       <th>passengerDOB</th> <th>passengerGender</th>  </tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
               echo "<tr><td>". $row['passengerId']."</td><td>". $row['passengerName']."</td><td>".  $row['passengerIdNo']."</td><td>".  
                $row['passengerPhoneNo']."</td><td>". $row['passengerEmail']."</td><td>". "</td><td>".  
                $row['passengerDOB']. "</td><td>".  $row['passegerGender']."</td><?tr>".                 
                "<br>";
                  }
             
            }
            }

//a function taking  $conn parameter that provides a connection to the database
 function list_of_feedback($conn){
   //mysqli query to select all from table feedback
   $feedback="select * from feedback";
   /* executes the SQL query using the database connection represented by $conn using the query mysqli method
and stores the result in the $result variable. */
     $result=$conn->query($feedback);
                
 if($result->num_rows>0) {
  echo"<a href='adminReports.php'>back</a>";
    // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
   echo" <tr> <th>feedBackId</th>  <th>feedBack</th>  </tr> ";
   //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
  while($row=$result->fetch_assoc()){
  /* presenting the result in table data cells and each database row to a different table row while looping through each row 
  of the result set returned by the SQL query. Inside the loop: */
       echo "<tr><td>". $row['feedBackId']. $row['feedBack']."</td></tr>".
                    "<br>";
                      }
                 
                }
                }
 
          

