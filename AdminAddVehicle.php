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
   // process  form data from the post request and set the collected data to php variable for use in the php script
      $plateNO=$_POST['plateNO'];
      $type=$_POST['type'];
      $capacity=$_POST['capacity'];      
      $state = $_POST['state'];
      $driverId=$_POST['driverId'];
      
       //ensure the driver exist
       $checkifdriverexist="select role from user where userId=$driverId";
       $chekresult=$conn->query($checkifdriverexist);
       $checkrow=$chekresult->fetch_assoc();
       if($checkrow){
       $role=$checkrow['role'];
       
       if($role==='driver'){

         //ensure driver doesn't have another vehicle arleady allocated
         $ensuredriverNotAllocated="select * from vehicle where driverId=$driverId";
         $ensureResult=$conn->query($ensuredriverNotAllocated);
         $ensureRow=$ensureResult->fetch_assoc();
         $row=$ensureRow['driverId'];
         if(!$row){
   
   //insert data about staff into database , 
      $sqladd="INSERT INTO vehicle (plateNo,type,capacity,state,driverId)
      VALUES (?,?,?,?,?)";//QL query to insert user data into the database 
      // a  query that inserts values using placholders ?
      $stmt=$conn->prepare($sqladd);
      //The bind_param() method binds variables to the placeholders in the SQL query.
      $stmt->bind_param("ssisi",$plateNO,$type,$capacity,$state,$driverId);
      /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
      $stmt->execute();
   //check if the sql query was succesfful by checking if it is equivalent to TRUE
      if($stmt){ 
       // If the insertion is successful
       echo" added sucessfully. add another one: <a href='AdminAddVehicle.html'>Add Another</a>";
       "<br>";
       echo"  or go back to dashBoard <a href='AdminDashboard.php'>Dashboard </a>";
       "<br>";     
       

      } 
      else {
   // If there's an error during insertion, display the error message by concantinating $sql variable that is the query and the error message
      echo" not adedd sucessfully re do: <a href='AdminAddVehicle.html'> Re do add</a>";
      "<br>";
      }
   }else{
      echo "driver already assigned another vehicle";
   }
}else{
   echo"driver doesn't exist";
}
   }else{
      echo"driver doesn't exist";
   }

  //close the connection to the database using the $conn variables used to open the connection by invoking the close() function
 $conn->close();

