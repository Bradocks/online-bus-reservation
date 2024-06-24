<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';

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

    <ul>
        Bookings - List all Bookings filter by <br>
        Seat reports - <br>
        Passenger reports <br>
        User reports <br>
        View Feedback <br>
        Vehicle reports <br>
        Staff Reports <br>
    </ul>
    <a href="index.php">Back to Dashboard</a>
</body>

</html>