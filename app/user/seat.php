<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

$conn = connect_db();
$seats_model = new BaseModel('bus_seats', $conn);

$booking_model = new BaseModel('booking', $conn);
$booking_id = isset($_GET['bookingid']) ? (int) $_GET['bookingid'] : null;
$booking = $booking_model->get_one($booking_id, 'bookingid');
// Fetch seat data from the database

$seats = $seats_model
    ->where('vehicleId', '=', $booking->vehicleId)
    ->get_all();

// Create an array to store seat data for multiple buses
$buses = [];
if ($seats) {
    foreach ($seats as $seat) {
        $buses[$seat['vehicleId']][] = $seat;
    }
} else {
    echo "No seats data found.";
}
$conn->close();

// Function to break seats into rows of 4
function break_into_rows($seats, $row_size = 4)
{
    $result = [];
    for ($i = 0; $i < count($seats); $i += $row_size) {
        $result[] = array_slice($seats, $i, $row_size);
    }
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seat Reservation System</title>
    <style>
        body {
            display: flex;
            justify-content: center;
        }

        .container {
            width: 25%;
            /* Adjust the width as needed */
            margin: 0 auto;
        }

        .seat {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            margin: 5px;
            text-align: center;
            border: 1px solid #000;
            border-radius: 5px;
        }

        .available {
            background-color: green;
            color: white;
        }

        .booked {
            background-color: red;
            color: white;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
        }

        .bus {
            margin-bottom: 50px;
            border: solid 1px #000;
            border-radius: 30px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bus Reservation System</h1>
        <?php foreach ($buses as $vehicleId => $seats) : ?>
            <div class="bus">
                <h2>Bus <?= $vehicleId ?></h2>
                <?php
                $rows = break_into_rows($seats);
                foreach ($rows as $row) :
                ?>
                    <div class="row">
                        <?php foreach ($row as $seat) : ?>
                            <div class="seat <?= $seat['status'] ?>" title="Seat ID: <?= $seat['seat_id'] ?>">
                                <div>
                                    <?= $seat['seat_id'] ?><br>
                                    <?= $seat['status'] === 'booked' ? 'Already Booked' : 'Available' ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>