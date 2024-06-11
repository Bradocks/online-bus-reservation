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

<body style="display: flex; flex-direction: column;">
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
    <h5><a href="index.php" style="text-decoration: none; color: black;">Back</a></h5>
</body>

</html>