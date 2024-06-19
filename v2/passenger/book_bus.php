<?php
include '../includes/db.php';
include '../includes/auth.php';
check_auth();
check_role('Passenger');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $seat_number = $_POST['seat_number'];
    $transaction_id = $_POST['transaction_id'];

    $sql = "INSERT INTO bookings (user_id, vehicle_id, seat_number, transaction_id) VALUES ('$user_id', '$vehicle_id', '$seat_number', '$transaction_id')";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book Bus</title>
</head>

<body>
    TODO: Show seats for user to pick
    <h1>Book a Bus</h1>
    <form method="POST" action="book_bus.php">
        <input type="number" name="vehicle_id" placeholder="Vehicle ID" required>
        <input type="number" name="seat_number" placeholder="Seat Number" required>
        <input type="text" name="transaction_id" placeholder="Transaction ID" required>
        <button type="submit">Book</button>
    </form>
    <a href="index.php">Back to Dashboard</a>
</body>

</html>