<?php

// Start a session to manage the user
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';
require_once __DIR__ . "../../utils/integrations/Pesapal.php";



$conn = connect_db();
$session = new Auth($conn);
$booking_model = new BaseModel('booking', $conn);
$row = $session->user();

$role = $row->role;


$booking_id = isset($_GET['booking_id']) ? (int) $_GET['booking_id'] : null;
$status = isset($_GET['status']) ? (int) $_GET['status'] : null;

if (isset($booking_id) && isset($status)) {
    $payment_request = new PesapalAPI();
    $booking = $booking_model->get_one($booking_id, 'bookingid');
    $payment = $payment_request->check_payment_status($_GET['OrderTrackingId']);
    $updated_booking = $booking_model->update(
        $booking_id,
        [
            'PaymentStatement' => $payment->confirmation_code,
            'paymentDetail' => $payment->payment_status_description,
            'PaymentMethod' => $payment->payment_method
        ],
        'bookingid'
    );
}

$bookings = $booking_model->where('PassengerId', '=', $row->userId)->get_all();

//set variable $role to the value of $row['role'] value
// get history based on their roles using a switch 
switch ($role) {
    case "Passenger":

        if (count($bookings) > 0) {
            // setting table with a border attribute of '1'
            echo '<a href="index.php">back</a>';
            echo "<table border='1'>";
            //table header row
            echo "<tr>
            <th>bookingId</th>
            <th>vehicleId</th>
            <th>departure</th>
            <th>destination</th>
            <th>charges</th>
            <th>PaymentMethod</th>
            <th>paymentDetail</th>
            <th>X TXN Code</th>
            <th>Ticket Code</th>
            </tr>";
            /*fetch_assoc() method is a function used in PHP to fetch a single row of 
         result set from a MySQL database query as an associative array*/
            foreach ($bookings as $row) {
                echo "<tr>
                        <td>" . $row['bookingid'] . "</td>
                        <td>" . $row['vehicleId'] . "</td>
                        <td>" . $row['departure'] . "</td>
                        <td>" . $row['destination'] . "</td>
                        <td>" . $row['charges'] . " </td>
                        <td>" . $row['PaymentMethod'] . "</td>
                        <td>" . $row['paymentDetail'] . "</td>
                        <td>" . $row['PaymentStatement'] . "</td>
                        <td>" . $row['ticketCode'] . "</td>
                    </tr>" .
                    "<br>";
            }
        } else {
            echo "No booking made! Book with us at : <a href='book.php'>Book</a>";
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
