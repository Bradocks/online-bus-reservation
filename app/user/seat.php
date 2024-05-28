<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

// Fetch seat data from the database
$sql = "SELECT * FROM bus_seats ORDER BY row, position";
$result = $conn->query($sql);

// Create an array to store seat data
$seats = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $seats[$row['row']][$row['position']] = $row;
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
    </style>
</head>
<body>
    <h1>Bus Reservation System</h1>
    <div class="bus">
        <?php foreach ($seats as $row => $positions): ?>
            <div class="row">
                <?php foreach ($positions as $position => $seat): ?>
                    <div class="seat <?= $seat['status'] ?>" title="Seat ID: <?= $seat['seat_id'] ?>">
                        <?= $seat['seat_id'] ?><br>
                        <?= $seat['status'] === 'booked' ? 'Already Booked' : 'Available' ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
