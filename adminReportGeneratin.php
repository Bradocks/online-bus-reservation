<?php 
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

//check if type is setted as a queryparameter
/* isset($_GET['type']): This checks if the 'type' parameter is set in the GET request. $_GET is a superglobal array in PHP
 that contains variables passed to the current script via the URL parameters (GET method).
 This condition ensures that the 'type' parameter is present in the URL. its a bollean returns true if it is present*/
if(isset($_GET['type'])){
  // assigns 'type' parameter to the variable $type.
    $type=$_GET['type'];
    //starts a switch statement that runs either of the case based on the value of the 'type' parameter.
    switch($type){


         //sipmle reports
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
        case "listOfItems":
          //call the function if its==='type' parameter
            list_of_item($conn);
            break;
        case "listOfSenders":
          //call the function if its==='type' parameter
          list_of_sender($conn);
          break;
         case "listOfFeedbacks":
          //call the function if its==='type' parameter
            list_of_feedback($conn);
            break;
            case "listOfOrder":
              //call the function if its==='type' parameter
              list_of_orders($conn);
                break;

    }
}
/* The isset($_POST) function checks if the $_POST superglobal array contains any data.
 If data has been sent via POST, this condition evaluates to true else it evaluate to false, its a bollean. the $_POST superglobal 
 array contains data submitted via an HTML form using the POST method, and it allows PHP to access form data. */
elseif(isset($_POST)){
  //ssigns the value of the 'category' parameter sent via POST to the variable $category.
    $category=$_POST['category'];
    //starts a switch statement based on the value of the 'category' parameter received via POST
    switch($category){


      //join reports case
        case "item":
          //call the function if its==='category' parameter
            itemDetails($conn);
            break;
        case "client":
          //call the function if its==='category' parameter
            clientActivities($conn);
           break;
        case "customerCare":
          //call the function if its==='category' parameter
            customerCareActivities($conn);
            break;
        case "driver":
          //call the function if its==='category' parameter
            DriverActivities($conn);
            break;

            
            //filter reports case
        case "senderId":
          //call the function if its==='category' parameter
              list_of_itemBysenderId($conn);
             break;
         case "vehicleId":
          //call the function if its==='category' parameter
               list_of_itemByvehicleId($conn);
              break;
          case "customercare":
            //call the function if its==='category' parameter
                list_of_itemBycustomercareId($conn);
               break;
         case "state": 
          //call the function if its==='category' parameter
                list_of_itemBystate($conn);
               break;
         case "source":
          //call the function if its==='category' parameter
                list_of_itemBysource($conn);
               break;
         case "destination":
          //call the function if its==='category' parameter
                list_of_itemBydestination($conn);
               break;
          case "category":
            //call the function if its==='category' parameter
                list_of_itemBycategory($conn);
               break;
         case "route":
          //call the function if its==='category' parameter
                list_of_itemByroute($conn);
               break;
         case "charges":
          //call the function if its==='category' parameter
                list_of_itemBycharges($conn);
               break;
          case "time":
            //call the function if its==='category' parameter
                list_of_itemBytime($conn);
               break;

               //timely reports
         case "date":
            //call the function if its==='category' parameter
                itemsByDate($conn);
               break;

          case "Month":
            //call the function if its==='category' parameter
            itemsByMonth($conn);
               break;

           case "Year":
             //call the function if its==='category' parameter
             itemsByYear($conn);
                break;
    }

}
//staff  ##simple reports 
//a function taking  $conn parameter that provides connection to the database 
function list_of_staff($conn){
 //mysqli query to the data base to select all from staff table
$staff="select * from staff";
/* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
 $result=$conn->query($staff);
// check  if the query result has any rows by ensuling number of rows are more than 0 using num_rows
if($result->num_rows>0) {
  // setting table with a border attribute of '1'
  echo"<a href='adminReporst.php'>back</a>";
    echo"<table border='1'>";
    //table header row userName
    echo" <tr> <th>staffId</th> <th>Name</th> <th> userName </th><th>IdNo</th> <th>Phone Number</th> <th>Email</th> <th>salary</th> 
    <th>position</th> <th>state</th> <th>Gende</th> <th>date of birth</th>  <th>mode of employment</th></tr> ";
    //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
      while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
   echo "<tr><td>". $row['staffId']."</td><td>". $row['name']."</td><td>". $row['userName']."</td><td>".  $row['IDNo']."</td><td>".  $row['phoneNO']."</td><td>".
    $row['email']."</td><td>". $row['salary']."</td><td>". $row['position']. "</td><td>".  $row['state']. "</td><td>".
     $row['gender']."</td><td>". $row['DtOfBth']. "</td><td>".$row['modeOfEmployment']."</td></tr>".
    "<br>";
      }
 
}
}


function list_of_orders($conn){
  //mysqli query to the data base to select all from staff table
 $staff="select * from orders";
 /* executes the SQL query using the database connection represented by $conn using query mysqli method
 and stores the result in the $result variable. */
  $result=$conn->query($staff);
 // check  if the query result has any rows by ensuling number of rows are more than 0 using num_rows
 if($result->num_rows>0) {
   // setting table with a border attribute of '1'
   echo"<a href='adminReporst.php'>back</a>";
     echo"<table border='1'>";
     //table header row 
     echo" <tr> <th>orderNo</th> <th>senderId</th> <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th> 
     <th>category</th> <th>vehicleId</th><th>charges</th> <th>customerCareId</th><th>orderstate</th></tr> ";
     //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
       while($row=$result->fetch_assoc()){
        
         /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
         of the result set returned by the SQL query. Inside the loop: */
    echo "<tr><td>".$row['orderId']."</td><td>".$row['senderId']."</td><td>".$row['source']."</td><td>". $row['destination']."</td><td>".
     $row['quantity']."</td><td>".$row['description']."</td><td>".$row['category']."</td><td>". $row['vehicleId']."</td><td>".$row['charges'].
     "</td><td>".$row['customerCareId']."</td><td>".$row['orderstate']. "</td></tr>".
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
      echo"<a href='adminReporst.php'>back</a>";
         // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
        echo" <tr> <th> userId</th> <th>Name</th> <th>Phone Number</th> <th>Email</th> <th>address</th> 
        <th>role</th> <th>userName</th> <th>password</th> <th>IdNo</th>  <th>Date of birth</th> <th>Gender</th></tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
          while($row=$result->fetch_assoc()){
             /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
       echo "<tr><td>". $row['userId']."</td><td>". $row['name']."</td><td>".  $row['mobileNumber']."</td><td>".  
        $row['email']."</td><td>". $row['address']."</td><td>". $row['role']. "</td><td>".  $row['userName']. "</td><td>".
         $row['password']."</td><td>". $row['IDNO']. "</td><td>".$row['DtOfBth']. "</td><td>".$row['gender']."</td></tr>".
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
          echo"<a href='adminReporst.php'>back</a>";
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
        function list_of_sender($conn){
 //mysqli query to select all from table sender
            $sender="select * from sender";

          /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
             $result=$conn->query($sender);
            
      if($result->num_rows>0) {
        echo"<a href='adminReporst.php'>back</a>";
        // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
      echo" <tr> <th>senderId</th> <th>sender Name</th> <th> senderIDNo</th> <th>senderPhoneNo</th> <th> senderEmail</th> 
       <th>senderLocation</th> <th>senderDtOfBth</th> <th>senderGender</th>  <th>receiverName</th> 
        <th>receiverLocation</th>  <th>receiverDtOfBth</th>  <th>receiverGender</th> </tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
               echo "<tr><td>". $row['senderId']."</td><td>". $row['senderName']."</td><td>".  $row['senderIDNo']."</td><td>".  
                $row['senderPhoneNo']."</td><td>". $row['senderEmail']."</td><td>". $row['senderLocation']. "</td><td>".  
                $row['senderDtOfBth']. "</td><td>".  $row['senderGender']."</td><td>". $row['receiverName']."</td><td>".
                 $row['receiverLocation']. "</td><td>". $row['receiverDtOfBth']. "</td><td>". $row['receiverGender']."</td><?tr>".                 
                "<br>";
                  }
             
            }
            }

//a function taking  $conn parameter that provides connection to the database
 function list_of_feedback($conn){
   //mysqli query to select all from table feedback
   $feedback="select * from feedback";
   /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
     $result=$conn->query($feedback);
                
 if($result->num_rows>0) {
  echo"<a href='adminReporst.php'>back</a>";
    // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
   echo" <tr> <th>feedBackId</th> <th>domain</th> <th>dateTime</th> <th>source</th> <th>feedBack</th>  </tr> ";
   //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
  while($row=$result->fetch_assoc()){
  /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
  of the result set returned by the SQL query. Inside the loop: */
       echo "<tr><td>". $row['feedBackId']."</td><td>". $row['domain']."</td><td>".  $row['dateTime']."</td><td>".  
           $row['source']."</td><td>". $row['feedBack']."</td></tr>".
                    "<br>";
                      }
                 
                }
                }
  //a function taking  $conn parameter that provides connection to the database
function list_of_item($conn){
 //mysqli query to select all from table item
       $item="select * from item";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
         $result=$conn->query($item);
                    
    if($result->num_rows>0) {
      echo"<a href='adminReporst.php'>back</a>";
      // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
     echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
      <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
       <th>timeTaken</th> <th>route</th> <th>charges</th> <th>PaymentMethod</th> <th>PaymentStatement</th> <th>paymentDetail</th> <th>orderCode</th> </tr> ";
       //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
      while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
        echo "<tr> <td>". $row['itemid']."</td> <td>". $row['senderId']."</td> <td>".  $row['vehicleId']."</td><td>".  
         $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
           $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
           .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
           "</td><td>".$row['PaymentMethod']. "</td><td>".$row['PaymentStatement']. "</td><td>".$row['paymentDetail'].
           "</td><td>".$row['orderCode'].
            "</td></tr>".
                "<br>";
               }
                     
             }
         }
          

         //##join reports

         //a function taking  $conn parameter that provides connection to the database
function DriverActivities($conn){
 //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable userId
            $DriverId=$_POST['searchid'];
            $sql="select vehicleId from vehicle where driverId=$DriverId";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            if($row){ 
            $vehicleId=$row['vehicleId'];
          
             
    $history="select itemid, vehicleId,customerCareId,source,destination,deliveryState,
    receiverName,receiverEmail,senderName,senderEmail 
    from item  
    join sender ON itemid= orderNo
    where vehicleId=$vehicleId and deliveryState='sucessfull'";
    /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
    $result=$conn->query($history);

    if($result->num_rows>0) {
      echo"<a href='adminReporst.php'>back</a>";
  // setting table with a border attribute of '1'
  echo"<table border='1'>";
  //table header row 
    echo "<tr><th>orderId</th><th>vehicleId</th><th>customerCareId</th> <th>source</th> <th>destination</th><th>deliveryState</th>
    <th>receiver</th> <th>receiverEmail</th> <th>senderName</th> <th> senderEmail</th></tr>"; 
    //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array 
      while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
   echo "<tr><td>".$row['itemid']." </td> <td>". $row['vehicleId']."</td><td>". 
   $row['customerCareId']."</td><td>". $row['source']."</td><td>". $row['destination']. 
    "</td><td>". $row['deliveryState']."</td><td>". $row['receiverName']."</td><td>".
     $row['receiverEmail']. "</td><td>". $row['senderName']. "</td><td>". 
     $row['senderEmail']."</td></tr>"."<br>";
          }
   }else{
      echo "No deliveries completed by the driver ";
    }
  }else{
    echo"driver Not Assigned a vehicle";
  }
}

         //customercare activities
         //a function taking  $conn parameter that provides connection to the database
function customerCareActivities($conn){
  //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable userId
            $userId=$_POST['searchid'];
   $history="select itemid, vehicleId,senderId,source,destination,deliveryState,charges,PaymentMethod,paymentDetail 
from item where customerCareId=$userId";
 /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
$result=$conn->query($history);

if($result->num_rows>0) {
  echo"<a href='adminReporst.php'>back</a>";
        // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
    echo "<tr><th>orderId</th><th>vehicleId</th><th>senderId</th> <th>source</th> <th>destination</th><th>deliveryState</th>
    <th>charges</th> <th>PaymentMethod</th> <th>paymentDetail</th>  </tr>"; 
    //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array 
      while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
   echo "<tr><td>".$row['itemid']."</td><td>". $row['vehicleId']."</td><td>".$row['senderId'] ."</td><td>"
   .$row['source']."</td><td>".$row['destination']."</td><td>".$row['deliveryState']."</td><td>".$row['charges'].
   "</td><td>".$row['PaymentMethod']."</td><td>".$row['paymentDetail']."<br>";
      }
}else{
      echo "No orders sorted by the customer care";
}
 }

         //client activities
         //a function taking  $conn parameter that provides connection to the database
 function clientActivities($conn){
  //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable days
            $userId=$_POST['searchid'];
        $history="select itemid, vehicleId,customerCareId,source,destination,deliveryState,charges,PaymentMethod,
        PaymentStatement,paymentDetail,receiverName,receiverEmail 
         from item  
      join sender ON itemid= orderNo
    where item.senderId=$userId";
    /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
      $result=$conn->query($history);

    if($result->num_rows>0) {
      echo"<a href='adminReporst.php'>back</a>";
      // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
      echo"<tr><th>orderId</th><th>vehicleId</th><th> customerCareId</th><th>source</th><th>destination</th><th>deliveryState</th><th>
      charges</th><th>PaymentMethod</th> <th>PaymentStatement</th><th>paymentDetail</th><th>receiverName</th><th>receiverEmail</th></tr>";
      //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
      while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
   echo "<tr><td>" . $row['itemid']."</td><td>". $row['vehicleId']. "</td><td>". $row['customerCareId'].
   "</td><td>". $row['source']. "</td><td>". $row['destination']."</td><td>". $row['deliveryState']. 
    " </td><td>". $row['charges']. " </td><td>". $row['PaymentMethod']." </td><td>". $row['PaymentStatement']
    ." </td><td>". $row['paymentDetail']."</td><td>". $row['receiverName']."</td><td>". $row['receiverEmail']."</td></tr>".
    "<br>";
      }
    }else{
      echo "cliet yet to make an order";
          }
  }

         //item details
         //a function taking  $conn parameter that provides connection to the database
function itemDetails($conn){
  //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable itemId
            $itemId=$_POST['searchid'];
   $history="select itemid, vehicleId,customerCareId,source,destination,deliveryState,charges,PaymentMethod,
   paymentDetail,sender.senderId,senderName,senderEmail,
    receiverName,receiverEmail 
     from item  
     join sender ON  itemid= orderNo
     where itemid=$itemId";
     /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
      $result=$conn->query($history);

    if($result->num_rows>0) {
      echo"<a href='adminReporst.php'>back</a>";
       // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
      echo"<tr><th>orderId</th><th>sender id</th><th>sender</th><th>sender Email</th><th>receiver</th><th>receiverEmail
      </th><th>vehicleId</th><th> customerCareId</th><th>source</th><th>destination</th><th>deliveryState</th><th>
      charges</th> <th>PaymentMethod</th> <th>paymentDetail</th></tr>";
      //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
      $row=$result->fetch_assoc();
      // presenting the result in table data cells a 
   echo "<tr><td>" . $row['itemid']."</td><td>".$row['senderId']."</td><td>".$row['senderName']."</td><td>". $row['senderEmail'].
   "</td><td>". $row['receiverName']."</td><td>".  $row['receiverEmail']."</td><td>". $row['vehicleId']. "</td><td>". 
   $row['customerCareId']."</td><td>". $row['source']. "</td><td>". $row['destination']."</td><td>". $row['deliveryState']. 
    " </td><td>". $row['charges']. "</td><td>". $row['PaymentMethod']. "</td><td>". $row['paymentDetail']."</td></tr>".
    "<br>";
      
      }else{
      echo " item not added";
      }
    }

    //#filter reports
    //filter by vehicleID
    //a function taking  $conn parameter that provides connection to the database
    function list_of_itemByvehicleId($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable vehicleId
      $vehicleId=$_POST['searchid'];
      //mysqli query to select all from item where v
      $item="select * from item where vehicleId= $vehicleId and paymentDetail='paid'";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
           // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){
      /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
       echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
        $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
         $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
        .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
           "</td><td>".$row['orderCode'].
            "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo"no deliveriers made by the vehicle";
            }
        }

        //filter by senderId
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBysenderId($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable senderId
      $senderId=$_POST['searchid'];
      //mysqli query to select all from item wheresender id is the id value given
      $item="select * from item where  senderId= $senderId";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
        // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>PaymentMethod</th> <th>paymentDetail</th><th>orderCode</th></tr> ";
           //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
         while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['PaymentMethod']. "</td><td>".$row['paymentDetail']. "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo "sender has not orderd yet";
            }
        }
         
        //filter by customercareid
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBycustomercareId($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable customercareId
      $customercareId=$_POST['searchid'];
      //mysqli query to select all from item where customerCareId is the ID value given
      $item="select * from item where   customerCareId= $customercareId";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
   if($result->num_rows>0) {
    echo"<a href='adminReporst.php'>back</a>";
          // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
     while($row=$result->fetch_assoc()){
       /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
            echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
            $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
         $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo "customerCare has not sorted any orderd yet";
            }
        }
         
        //filter by state
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBystate($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable state
      $state= $_POST['searchid'];
      //mysqli query to select all from table item where deliveryState is the state given
      if($state==='sucessfull'){ 
            $item="select * from item where   deliveryState= '$state'";
      }else {
        $item="select * from item where   deliveryState IS NULL";
        
      }
             /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
            // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){
         /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo "given state not recorded  yet";
            }
        }
         
        //filter by source
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBysource($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable days
      $source=$_POST['searchid'];
      //msqli query to select all from item where source is the source given
      $item="select * from item where source='$source'";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
         // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){
      /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo"no items from the source";
            }
        }

        //filter by destiation
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBydestination($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable destination
      $destination=$_POST['searchid'];
      //msqli query to select all from item where destination is the destination given
      $item="select * from item where destination='$destination'";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
             // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){
        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo"no items from the destination";
            }
        }

        //filter by category
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBycategory($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable category
      $category=$_POST['searchid'];
      //msqli qeury to select all from table item where  category is the given category
      $item="select * from item where category='$category'";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
            // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){
       /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo"no items of the category";
            }
        }
         //filter by route
         //a function taking  $conn parameter that provides connection to the database
    function list_of_itemByroute($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable route
      $route=$_POST['searchid'];
      // mysqli query to select all from table item where route is the route given 
      $item="select * from item where route='$route'";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
            // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){
         /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo"no items deliverd by the route";
            }
        }

        //filter by charges
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBycharges($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable charges
      $charges=$_POST['searchid'];
      //mysqli query to select all from ite, where charges is greater than the given value
      $item="select * from item where charges >=$charges";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
      // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){

        /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo"no charges grater than that made";
            }
        }

        
        //filter by time
        //a function taking  $conn parameter that provides connection to the database
    function list_of_itemBytime($conn){
      //retrieves the value of a form field 'searchid' that was submitted via a POST request in PHP and set it to variable time
      $time=$_POST['searchid'];
      //mysqli query to select all from item where timeTaken is greater than time given
      $item="select * from item where timeTaken>'$time'";
       /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
        $result=$conn->query($item);
                   
        if($result->num_rows>0) {
          echo"<a href='adminReporst.php'>back</a>";
           // setting table with a border attribute of '1'
    echo"<table border='1'>";
    //table header row 
            echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
            <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
            <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
            //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
                while($row=$result->fetch_assoc()){
       /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
                 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
                 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
                $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
                .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
                "</td><td>".$row['orderCode'].
                  "</td></tr>".
               "<br>";
              }
                    
            }
            else{
              echo"no deliveries delivered beyond the time";
            }
        }

       // timely reports
      function itemsByDate($conn){
        $date=$_POST['searchid'];

        $sql="select * from item where date(orderTimeDate)='$date'";
         /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
$result=$conn->query($sql);
                   
if($result->num_rows>0) {
  echo"<a href='adminReporst.php'>back</a>";
   // setting table with a border attribute of '1'
echo"<table border='1'>";
//table header row 
    echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
    <th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
    <th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
    //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while($row=$result->fetch_assoc()){
/* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
of the result set returned by the SQL query. Inside the loop: */
         echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
         $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
        $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
        .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
        "</td><td>".$row['orderCode'].
          "</td></tr>".
       "<br>";

      }
    }else{
      echo "no items for the given date";
    }
  }

  function itemsByMonth($conn){
    $Month=$_POST['search'];
    $Year=$_POST['searchid'];
    
    $sql="select * from item where year(orderTimeDate)='$Year' 
    and month(orderTimeDate)='$Month'";
     /* executes the SQL query using the database connection represented by 
     $conn using query mysqli method
and stores the result in the $result variable. */
$result=$conn->query($sql);
               
if($result->num_rows>0) {
  echo"<a href='adminReporst.php'>back</a>";
// setting table with a border attribute of '1'
echo"<table border='1'>";
//table header row 
echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
<th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
<th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
//fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
    while($row=$result->fetch_assoc()){
/* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
of the result set returned by the SQL query. Inside the loop: */
     echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
     $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
    $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
    .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
    "</td><td>".$row['orderCode'].
      "</td></tr>".
   "<br>";

  }
}else{
  echo "no items for the given Month";
}
}

function itemsByYear($conn){
    $Year=$_POST['searchid'];
    
  $sql="select * from item where year(orderTimeDate)='$Year'";
   /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
$result=$conn->query($sql);
             
if($result->num_rows>0) {
  echo"<a href='adminReporst.php'>back</a>";
// setting table with a border attribute of '1'
echo"<table border='1'>";
//table header row 
echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
<th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
<th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
//fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
  while($row=$result->fetch_assoc()){
/* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
of the result set returned by the SQL query. Inside the loop: */
   echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
   $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
  $row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
  .$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
  "</td><td>".$row['orderCode'].
    "</td></tr>".
 "<br>";

}
}else{
echo "no items for the given year";
}
}

function itemsweekly($conn){
  $Year=$_POST['searchid'];
  $Month=$_POST[''];
  $week=$_POST[''];
  if($week===1){
    $Week=[1,2,3,4,5,6,7];
  }
  if($week===2){
    $Week=[8,9,10,11,12,13,14];
  }
  if($week===3){
    $Week=[15,16,17,18,19,20,21];
  }
  if($week===4){
    $Week=[22,23,24,25,26,27,28];
  }
  if($week===5){
    $Week=[29,30,31];
  }
$sql="select * from item where year(orderTimeDate)='$Year'and 
month(orderTimeDate)='$Month' and day(orderTimeDate)=Week";
 /* executes the SQL query using the database 
 connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
$result=$conn->query($sql);
           
if($result->num_rows>0) {
echo"<a href='adminReporst.php'>back</a>";
// setting table with a border attribute of '1'
echo"<table border='1'>";
//table header row 
echo" <tr> <th>itemid</th> <th>senderId</th> <th>vehicleId</th> <th>customerCareId</th> <th>deliveryState</th> 
<th>source</th> <th>destination</th> <th>quantity</th> <th>description</th>  <th>category</th> <th>time orderd</th> 
<th>timeTaken</th> <th>route</th> <th>charges</th> <th>orderCode</th></tr> ";
//fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
while($row=$result->fetch_assoc()){
/* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
of the result set returned by the SQL query. Inside the loop: */
 echo "<tr><td>". $row['itemid']."</td><td>". $row['senderId']."</td><td>".  $row['vehicleId']."</td><td>".  
 $row['customerCareId']."</td><td>". $row['deliveryState']."</td><td>". $row['source']. "</td><td>". 
$row['destination']. "</td><td>".$row['quantity']."</td><td>". $row['description']. "</td><td>".$row['category']."</td><td>"
.$row['orderTimeDate']."</td><td>".$row['timeTaken']. "</td><td>".$row['route']. "</td><td>".$row['charges']. 
"</td><td>".$row['orderCode'].
  "</td></tr>".
"<br>";

}
}else{
echo "no items for the given year";
}
}



