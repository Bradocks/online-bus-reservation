<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();

// process  form data from the post request and set the collected data to php variable for use in the php script
$plateNO = $_POST['plateNO'];
$capacity = $_POST['capacity'];
$state = $_POST['state'];
$driverId = $_POST['driverId'];

//ensure the driver exists
$checkifdriverexist = "select role from user where userId=$driverId";
$chekresult = $conn->query($checkifdriverexist);
$checkrow = $chekresult->fetch_assoc();
if ($checkrow) {
    $role = $checkrow['role'];

    if ($role === 'driver') {

        //ensure the driver doesn't have another vehicle already allocated
        $ensuredriverNotAllocated = "select * from vehicle where driverId=$driverId";
        $ensureResult = $conn->query($ensuredriverNotAllocated);
        $ensureRow = $ensureResult->fetch_assoc();
        $row = $ensureRow['driverId'];
        if (!$row) {

            //insert data about staff into database , 
            $sqladd = "INSERT INTO vehicle (plateNo,capacity,state,driverId)
      VALUES (?,?,?,?)"; //QL query to insert user data into the database 
            // a  query that inserts values using placeholders?
            $stmt = $conn->prepare($sqladd);
            //The bind_param() method binds variables to the placeholders in the SQL query.
            $stmt->bind_param("sisi", $plateNO, $capacity, $state, $driverId);
            /* sends the query to the database server for execution with the 
          provided parameter values, returns true or false */
            $stmt->execute();
            //check if the sql query was successful by checking if it is equivalent to TRUE
            if ($stmt) {
                // If the insertion is successful
                echo " Vehicle added <a href='AddVehicle.html'>Add vehicle</a>";
                "<br>";
                echo "  Back to dashBoard <a href='index.php'>Dashboard </a>";
                "<br>";
            } else {
                // If there's an error during insertion, display the error message by concatenating $sql variable that is the query, and the error message
                echo " Failed!: <a href='AddVehicle.html'> Add Vehicle!</a>";
                "<br>";
            }
        } else {
            echo "driver already assigned another vehicle";
        }
    } else {
        echo "driver doesn't exist";
    }
} else {
    echo "driver doesn't exist";
}

//close the connection to the database using the $conn variables used to open the connection by invoking the close() function
$conn->close();
