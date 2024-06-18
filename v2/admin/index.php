<?php
include '../includes/db.php';
include '../includes/auth.php';
check_auth();
check_role('admin');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin</h1>
    <a href="manage_drivers.php">Manage Drivers</a>
    <a href="manage_admins.php">Manage Admins</a>
    <a href="manage_bookings.php">Manage Bookings</a>
    <a href="manage_vehicles.php">Manage Vehicles</a>
    <a href="reports.php">Reports</a>
    <a href="/logout.php">Logout</a>
</body>
</html>
