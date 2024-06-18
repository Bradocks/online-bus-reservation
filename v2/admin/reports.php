<?php
include '../includes/db.php';
include '../includes/auth.php';
check_auth();
check_role('admin');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
</head>
<body>
    <h1>Reports</h1>
    <h2>Bookings</h2>
    <form method="GET" action="reports.php">
        <select name="filter">
            <option value="successful">Successful</option>
            <option value="failed">Failed</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <ul>
        <?php
        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'successful';
        $sql = "SELECT * FROM bookings WHERE status='$filter'";
        $result = $conn->query($sql);

        while ($booking = $result->fetch_assoc()) {
            echo "<li>Booking ID: {$booking['id']}, User ID: {$booking['user_id']}, Vehicle ID: {$booking['vehicle_id']}, Seat: {$booking['seat_number']}, Transaction ID: {$booking['transaction_id']}</li>";
        }
        ?>
    </ul>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
