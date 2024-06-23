<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking System</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/png" href="/favicon.png">
</head>

<body>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <nav class="navbar">
            <div class="container flex justify-between items-center">
                <a href="/index.php" class="navbar-brand">Bus Booking System</a>
                <div>
                    <a href="/admin/index.php">Dashboard</a>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <a href="/admin/manage_drivers.php">Manage Drivers</a>
                        <a href="/admin/manage_admins.php">Manage Admins</a>
                        <a href="/admin/manage_bookings.php">Manage Bookings</a>
                        <a href="/admin/manage_vehicles.php">Manage Vehicles</a>
                        <a href="/admin/manage_routes.php">Manage Routes</a>
                        <a href="/admin/reports.php">Reports</a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] === 'Passenger') : ?>
                        <a href="/passenger/routes.php">Book bus</a>
                        <a href="/passenger/history.php">History</a>
                        <a href="/passenger/feedback.php">Feedback</a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] === 'driver') : ?>
                        <a href="/passenger/feedback.php">Feedback</a>
                    <?php endif; ?>
                    <a href="/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main class="container">