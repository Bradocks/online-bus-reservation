<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('Passenger');

// Get booking ID and seat ID from query parameters
$booking_id = $_GET['booking_id'];
$seat_id = isset($_GET['seat_id']) ? $_GET['seat_id'] : null;

// Update the seat_id in the booking table if provided
if ($seat_id) {
    $update_sql = "UPDATE booking SET seat_id = $seat_id WHERE id = $booking_id";
    $conn->query($update_sql);
}

// Query the booking information
$booking_sql = "SELECT id, passenger_id, vehicle_id, place_of_departure, destination, category, date_time, `route`, charges, payment_method, payment_statement, payment_detail, ticket_code, seat_id, route_id FROM booking WHERE id = $booking_id";
$booking_result = $conn->query($booking_sql);

if ($booking_result->num_rows > 0) {
    $booking = $booking_result->fetch_assoc();
    $passenger_id = $booking['passenger_id'];
    $vehicle_id = $booking['vehicle_id'];
    $place_of_departure = $booking['place_of_departure'];
    $destination = $booking['destination'];
    $category = $booking['category'];
    $date_time = $booking['date_time'];
    $route = $booking['route'];
    $charges = $booking['charges'];
    $payment_method = $booking['payment_method'];
    $payment_statement = $booking['payment_statement'];
    $payment_detail = $booking['payment_detail'];
    $ticket_code = $booking['ticket_code'];
    $seat_id = $booking['seat_id'];
    $route_id = $booking['route_id'];
} else {
    echo "No booking found for this ID.";
    exit;
}

// Fetch passenger name (assuming there is a passengers table)
$passenger_sql = "SELECT `name` FROM user WHERE id = $passenger_id";
$passenger_result = $conn->query($passenger_sql);
$passenger_name = $passenger_result->fetch_assoc()['name'];
?>
<!doctype html>
<html>

<head>
    <title>Ticket Confirmation</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .card {
            background-color: #ffffff;
            padding: 20px;
            margin-top: 20px;
        }

        .card-header {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            text-align: center;
        }

        .ticket-details {
            padding: 10px 25px;
            color: #555;
            font-size: 16px;
        }

        .divider {
            border-top: 1px solid #cccccc;
            margin: 10px 0;
        }

        .footer {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            color: #888888;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Ticket Confirmation</div>
            <div class="divider"></div>
            <div class="card-body">
                <p class="ticket-details">Passenger: <?php echo $passenger_name; ?></p>
                <p class="ticket-details">Ticket Number: <?php echo $ticket_code; ?></p>
                <p class="ticket-details">Route: <?php echo $route; ?></p>
                <p class="ticket-details">Date: <?php echo date('Y-m-d', strtotime($date_time)); ?></p>
                <p class="ticket-details">Time: <?php echo date('H:i A', strtotime($date_time)); ?></p>
                <p class="ticket-details">Seat: <?php echo $seat_id; ?></p>
                <p class="ticket-details" style="color: #888888;">Please present this ticket at the boarding gate.</p>
            </div>
        </div>
        <div class="footer">
            <p>If you have any questions, please contact our support team.</p>
            <p>© 2024 Company Name. All rights reserved.</p>
        </div>
    </div>
</body>

</html>