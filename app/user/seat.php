<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';


// Fetch seat data from the database
$sql = "SELECT * FROM bus_seats ORDER BY bus_id, row, position";
$result = $conn->query($sql);

// Create an array to store seat data for multiple buses
$buses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $buses[$row['bus_id']][$row['row']][$row['position']] = $row;
    }
} else {
    echo "No seats data found.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Reservation System</title>
    <style>
        .seat {
            display: inline-block;
            width: 50px;
            height: 50px;
            margin: 5px;
            text-align: center;
            line-height: 50px;
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
            margin-bottom: 10px;
        }

        .bus {
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <h1>Bus Reservation System</h1>
    <?php foreach ($buses as $bus_id => $seats) : ?>
        <div class="bus">
            <h2>Bus <?= $bus_id ?></h2>
            <?php foreach ($seats as $row => $positions) : ?>
                <div class="row">
                    <?php foreach ($positions as $position => $seat) : ?>
                        <div class="seat <?= $seat['status'] ?>" title="Seat ID: <?= $seat['seat_id'] ?>">
                            <?= $seat['seat_id'] ?><br>
                            <?= $seat['status'] === 'booked' ? 'Already Booked' : 'Available' ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</body>

</html>