<?php
//estalish connnection to the database
require_once("../config/database.php");
require_once("../utils/reports/Generator.php");
$conn = connect_db();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <style>
        /* CSS Styles */
        body {
            background-image: url('/photo1.jpeg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        table {
            background-color: rgba(255, 255, 255, 0.8);
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php

//check if the type is set as a query parameter
/**
 * isset($_GET['type']): This checks if the 'type' parameter is set in the GET request. $_GET is a superglobal array in PHP
 * that contains variables passed to the current script via the URL parameters (GET method).
 * This condition ensures that the 'type' parameter is present in the URL. its a bollean returns true if it is present
 */

if (isset($_GET['type'])) {
    // assigns 'type' parameter to the variable $type.
    $type = $_GET['type'];
    //starts a switch statement that runs either of the cases based on the value of the 'type' parameter.
    switch ($type) {
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


//staff  ##simple reports 
//a function taking  $conn parameter that provides a connection to the database 
function list_of_staff($conn)
{
    //mysqli query to the database to select all from the staff table
    $staff = "select * from staff";
    /* executes the SQL query using the database connection represented by $conn using the query mysqli method
and stores the result in the $result variable. */
    $result = $conn->query($staff);
    // check  if the query result has any rows by ensuring the number of rows is more than 0 using num_rows
    if ($result->num_rows > 0) {
        // setting table with a border attribute of '1'
        echo "<a href='adminReports.php'>back</a>";
        echo "<table border='1'>";
        //table header row userName
        echo "<tr> <th>staffId</th> <th>Name</th> <th> userName </th><th>IdNo</th> <th>Phone Number</th> <th>Email</th>
        <th>position</th> <th>state</th> <th>Gender</th> <th>date of birth</th>";
        list_of_staff_query($result);
    }
}


function list_of_staff_query($result)
{
    while ($row = $result->fetch_assoc()) {
        /** of the result set returned by the SQL query. Inside the loop: */
        echo "<tr><td>" . $row['staffId'] . "</td><td>" . $row['name'] . "</td><td>" . $row['userName'] . "</td><td>" .  $row['IdNo'] . "</td><td>" .  $row['phoneNO'] . "</td><td>" .
            $row['email'] . "</td><td>" . $row['position'] . "</td><td>" .  $row['state'] . "</td><td>" .
            $row['gender'] . "</td><td>" . $row['DOB'] . "</td><td>" .
            "<br>";
    }
}

//vehicle reports
//a function taking  $conn parameter that provides connection to the database
function list_of_vehicles($conn)
{
    //mysqli query to select all from table vehicle
    $vehicles = "select * from vehicle";
    /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
    $result = $conn->query($vehicles);

    if ($result->num_rows > 0) {
        echo "<a href='adminReports.php'>back</a>";
        // setting table with a border attribute of '1'
        echo "<table border='1'>";
        //table header row 
        echo " <tr> <th> vehicleId</th> <th>plateNo</th> <th> type</th> <th>capacity</th> <th> state</th> 
            <th>driverId</th> </tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while ($row = $result->fetch_assoc()) {
            /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
            echo "<tr><td>" . $row['vehicleId'] . "</td><td>" . $row['plateNo'] . "</td><td>" .  $row['type'] . "</td><td>" .
                $row['capacity'] . "</td><td>" . $row['state'] . "</td><td>" . $row['driverId'] . "</td></tr>" .
                "<br>";
        }
    }
}

//User reports
//a function taking  $conn parameter that provides connection to the database
function list_of_users($conn)
{
    //mysqli query to the data base to select all from user table
    $users = "select * from user";
    /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
    $result = $conn->query($users);

    if ($result->num_rows > 0) {
        echo "<a href='adminReports.php'>back</a>";
        // setting table with a border attribute of '1'
        echo "<table border='1'>";
        //table header row 
        echo " <tr> <th> userId</th> <th>Name</th> <th>Phone Number</th> <th>Email</th>
        <th>role</th> <th>userName</th> <th>password</th> <th>IdNo</th>  <th>Date of birth</th> <th>Gender</th></tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while ($row = $result->fetch_assoc()) {
            /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
            echo "<tr><td>" . $row['userId'] . "</td><td>" . $row['name'] . "</td><td>" .  $row['mobileNumber'] . "</td><td>" .
                $row['email'] . "</td><td>" . $row['role'] . "</td><td>" .  $row['userName'] . "</td><td>" .
                $row['password'] . "</td><td>" . $row['IdNo'] . "</td><td>" . $row['DOB'] . "</td><td>" . $row['gender'] . "</td></tr>" .
                "<br>";
        }
    }
}



function list_of_bookings($conn)
{

    $generator = new BookingReportGenerator($conn);
    $generator->render_filters();

    //mysqli query to the database to select all from the staff table
    $bookings = "select * from booking " . $generator->filter_query();
    /*  executes the SQL query using the database connection represented by $conn using query mysqli method
        and stores the result in the $result variable. 
    */

    $result = $conn->query($bookings);
    //Check  if the query result has any rows by ensuring the number of rows is more than 0 using num_rows
    if ($result->num_rows > 0) {
        // setting table with a border attribute of '1'
        echo "<a href='adminReports.php'>back</a>";
        echo "<table border='1'>";
        //table header row 
        echo "
        <thead>
            <th>bookingId</th> 
            <th>passengerId</th>
            <th>departure</th> 
            <th>destination</th> 
            <th>category</th> 
            <th>vehicleId</th>
            <th>charges</th>
        </thead>";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while ($row = $result->fetch_assoc()) {
            /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
         of the result set returned by the SQL query. Inside the loop: */
            echo "<tr>
            <td>" . $row['bookingId'] . "</td>
            <td>" . $row['passengerId'] . "</td>
            <td>" . $row['departure'] . "</td>
            <td>" . $row['destination'] . "</td>
            <td>" . $row['category'] . "</td>
            <td>" . $row['vehicleId'] . "</td>
            <td>" . $row['charges'] . "</td>";
        }
    }
}





/**
 * a function taking  $conn parameter that provides connection to the database
 * @param $conn
 */
function list_of_passengers($conn)
{
    //mysqli query to select all from table passenger
    $sender = "select * from passenger";

    /* executes the SQL query using the database connection represented by $conn using query mysqli method
and stores the result in the $result variable. */
    $result = $conn->query($sender);

    if ($result->num_rows > 0) {
        echo "<a href='adminReports.php'>back</a>";
        // setting table with a border attribute of '1'
        echo "<table border='1'>";
        //table header row 
        echo " <tr> <th>passengerId</th> <th>passenger Name</th> <th> passengerIdNo</th> <th>passengerPhoneNo</th> <th> passengerEmail</th> 
       <th>passengerDOB</th> <th>passengerGender</th>  </tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while ($row = $result->fetch_assoc()) {
            /* presenting the result in table data cells and each database row to a different table row using while by looping through each row 
        of the result set returned by the SQL query. Inside the loop: */
            echo "<tr><td>" . $row['passengerId'] . "</td><td>" . $row['passengerName'] . "</td><td>" .  $row['passengerIdNo'] . "</td><td>" .
                $row['passengerPhoneNo'] . "</td><td>" . $row['passengerEmail'] . "</td><td>" . "</td><td>" .
                $row['passengerDOB'] . "</td><td>" .  $row['passegerGender'] . "</td><?tr>" .
                "<br>";
        }
    }
}

//a function taking  $conn parameter that provides a connection to the database
function list_of_feedback($conn)
{
    //mysqli query to select all from table feedback
    $feedback = "select * from feedback";
    /* executes the SQL query using the database connection represented by $conn using the query mysqli method
and stores the result in the $result variable. */
    $result = $conn->query($feedback);

    if ($result->num_rows > 0) {
        echo "<a href='adminReports.php'>back</a>";
        // setting table with a border attribute of '1'
        echo "<table border='1'>";
        //table header row 
        echo " <tr> <th>feedBackId</th>  <th>feedBack</th>  </tr> ";
        //fetch_assoc() method is a function used in PHP to fetch a single row of result set from a MySQL database query as an associative array
        while ($row = $result->fetch_assoc()) {
            /* presenting the result in table data cells and each database row to a different table row while looping through each row 
  of the result set returned by the SQL query. Inside the loop: */
            echo "<tr><td>" . $row['feedBackId'] . "</td><td>"  . $row['feedBack'] . "</td></tr>" .
                "<br>";
        }
    }
}
