<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

$conn = connect_db();
// Assume booking_id is passed via GET or POST
$booking_model = new BaseModel('booking', $conn);
$booking_id = isset($_GET['bookingid']) ? (int) $_GET['bookingid'] : null;

if (!isset($booking_id)) {
    die("Booking ID is required.");
}

// Fetch booking deta
$booking = $booking_model->get_one($booking_id, 'bookingid');

if (isset($booking)) {
    $row = $booking;

    //$name = htmlspecialchars($row->name);
    $PassengerId = htmlspecialchars($row->PassengerId );
   // $IdNO = htmlspecialchars($row->IdNo);
    $date_of_departure = htmlspecialchars($row->dateTime);
    $place_of_departure = htmlspecialchars($row->departure);
    $destination = htmlspecialchars($row->destination);
    $seatId = htmlspecialchars($row->seatId);
    $charges = htmlspecialchars($row->charges);
    $vehicleId = htmlspecialchars($row->vehicleId);
} else {
    die("Booking not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .ticket {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        .ticket h2 {
            margin-top: 0;
            color: #333;
        }

        .ticket p {
            margin: 10px 0;
            color: #555;
        }

        .ticket .amount {
            font-size: 20px;
            font-weight: bold;
            color: #d9534f;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h2>Booking Confirmation</h2>
        <p><strong>Passenger ID:</strong> <?php echo $PassengerId ; ?></p>
        <p><strong>Date & Time:</strong> <?php echo $date_of_departure; ?></p>
        <p><strong>Place of Departure:</strong> <?php echo $place_of_departure; ?></p>
        <p><strong>Destination:</strong> <?php echo $destination; ?></p>
        <p><strong>Seat Reserved:</strong> <?php echo $seatId; ?></p>
        <p><strong>charges:</strong><?php echo $charges; ?></p>
        <p><strong>vehicleId:</strong><?php echo $vehicleId; ?></p>
    </div>
</body>

</html>