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
                    <a href="/admin/index.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/index.php') ? 'active' : ''; ?>">Dashboard</a>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <a href="/admin/manage_drivers.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_drivers.php') ? 'active' : ''; ?>">Manage Drivers</a>
                        <a href="/admin/manage_admins.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_admins.php') ? 'active' : ''; ?>">Manage Admins</a>
                        <a href="/admin/manage_bookings.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_bookings.php') ? 'active' : ''; ?>">Manage Bookings</a>
                        <a href="/admin/manage_vehicles.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_vehicles.php') ? 'active' : ''; ?>">Manage Vehicles</a>
                        <a href="/admin/manage_routes.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_routes.php') ? 'active' : ''; ?>">Manage Routes</a>
                        <a href="/admin/reports.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/reports.php') ? 'active' : ''; ?>">Reports</a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] === 'Passenger') : ?>
                        <a href="/passenger/routes.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/passenger/routes.php') ? 'active' : ''; ?>">Book bus</a>
                        <a href="/passenger/history.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/passenger/history.php') ? 'active' : ''; ?>">History</a>
                        <a href="/passenger/feedback.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/passenger/feedback.php') ? 'active' : ''; ?>">Feedback</a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] === 'driver') : ?>
                        <a href="/passenger/feedback.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/passenger/feedback.php') ? 'active' : ''; ?>">Feedback</a>
                    <?php endif; ?>
                    <a href="/logout.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/logout.php') ? 'active' : ''; ?>">Logout</a>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main class="container">