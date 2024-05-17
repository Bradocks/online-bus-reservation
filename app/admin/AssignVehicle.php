<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db();

$vehicleId = $_POST['vehicleId'];
$driverId = $_POST['driverId'];
$state = $_POST['state'];
//ensure the vehicle exists
$confirVehicle = " select vehicleId from vehicle where vehicleId=$vehicleId";
$confirresult = $conn->query($confirVehicle);
$confirrow = $confirresult->fetch_assoc();
if ($confirrow) {
    //ensure the driver exists
    $checkifdriverexist = "select role from user where userId=$driverId";
    $chekresult = $conn->query($checkifdriverexist);
    $checkrow = $chekresult->fetch_assoc();
    if ($checkrow) {
        $role = $checkrow['role'];

        if ($role === 'driver') {
            //ensure the driver is not assigned another vehicle
            $check = " select driverId from vehicle where driverid=$driverId and
  vehicleId !=$vehicleId";
            /*executes the SQL query using the query() method of the database connection 
       object $conn. it sends the SQL query to the database server for execution.*/
            $checkResult = $conn->query($check);
            if (!$checkResult->num_rows > 0) {

                $sqlAssign = "UPDATE vehicle SET driverid=?, state=? where vehicleid=?";

                /* a query that inserts values using placeholders in the prepare function
     using conn object? */
                $updatevehicle = $conn->prepare($sqlAssign);
                //The bind_param() method binds variables to the placeholders in the SQL query.
                $updatevehicle->bind_param("isi", $driverId, $state, $vehicleId);
                /* sends the query to the database server for execution with the 
       provided parameter values, and returns true or false */
                $updatevehicle->execute();

                if ($updatevehicle) {
                    echo "Updated " . "<br>";
                    echo  "   updated successfully <a href= 
   'AssignDriverAVehicle.html'>Assign</a>" . "<br>";
                    echo  "  Back to the Dashboard: <a href='index.php'>
   Dashboard</a>" . "<br>";
                } else {
                    echo " Not updated.  <a href= 
      'AssignVehicle.html'>Assign</a>";
                }
            } else {
                echo " driver assigned vehicle already: <a href= 
      'AssignVehicle.html'>Assign</a>";
            }
        } else {
            echo "driver doesn't exist";
        }
    } else {
        echo "driver doesn't exist";
    }
} else {
    echo "vehicle doesn't exist";
}

$conn->close();
