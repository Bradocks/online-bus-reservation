<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

// Assume booking_id is passed via GET or POST
$booking_id = $_GET['bookingid'] ?? null;

if (!$bookingid) {
    die("Booking ID is required.");
}

// Fetch booking details
$sql = "SELECT * FROM booking WHERE bookingid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookingid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $name = htmlspecialchars($row['name']);
    $mobileNumber = htmlspecialchars($row['mobileNumber']);
    $email = htmlspecialchars($row['email']);
    $IdNO = htmlspecialchars($row['IdNo']);
    $date_of_departure = htmlspecialchars($row['date_of_departure']);
    $place_of_departure = htmlspecialchars($row['place_of_departure']);
    $destination = htmlspecialchars($row['destination']);
    $category = htmlspecialchars($row['category']);
    $seat = htmlspecialchars($row['seat_reserved']);
    $amount = htmlspecialchars($row['amount']);
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
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Mobile Number:</strong> <?php echo $mobileNumber; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>ID Number:</strong> <?php echo $IdNO; ?></p>
        <p><strong>Date of Departure:</strong> <?php echo $date_of_departure; ?></p>
        <p><strong>Place of Departure:</strong> <?php echo $place_of_departure; ?></p>
        <p><strong>Destination:</strong> <?php echo $destination; ?></p>
        <p><strong>Category:</strong> <?php echo $category; ?></p>
        <p><strong>Seat Reserved:</strong> <?php echo $seat; ?></p>
        <p class="amount"><strong>Amount:</strong> $<?php echo $amount; ?></p>
    </div>
</body>
</html>
