<?php
//establish connection to the database
require_once("../config/database.php");

$conn = connect_db($db_config);

$vehicleId = $_POST['vehicleId'];

$check = "select vehicleId from vehicle where vehicleId=$vehicleId";
/*executes the SQL query using the query() method of the database connection 
object $conn. it sends the SQL query to the database server for execution.*/
$checkResult = $conn->query($check);
if ($checkResult->num_rows > 0) {

    $sql = "UPDATE `vehicle` SET `disabled`= true WHERE vehicleId=?";
    // a  query that deletes values using placholders ?
    $stmt = $conn->prepare($sql);
    //The bind_param() method binds variables to the placeholders in the SQL query.
    $stmt->bind_param("i", $vehicleId);
    /* sends the query to the database server for execution with the 
       provided parameter values, returns true or false */
    $stmt->execute();
    if ($stmt) {
        echo " deleted sucessfully <a href='DeleteVehicle.html'>delete another</a>" . "<br>";

        echo " Back to dashBoard: <a href='index.php'>Dashboard</a>" . "<br>";
    } else {
        echo "Not deleted: <a href='DeleteStaff.html'>delete</a>" . "<br>";
    }
} else {
    echo " vehicle not available, back to DashBoard: <a href='index.php'>Dashboard</a>" . "<br>";
}
$conn->close();
