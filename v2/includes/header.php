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
                <div class="navbar-links">
                    <a href="/admin/index.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/index.php') ? 'active' : ''; ?>">Home</a>
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <!-- Dropdown for Admin specific management links -->
                        <div class="<?php
                                    if (
                                        $_SERVER['SCRIPT_NAME'] === '/admin/manage_drivers.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/manage_admins.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/manage_bookings.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/manage_vehicles.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/manage_routes.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/manage_passenger.php'
                                    ) {
                                        echo 'active dropdown';
                                    } else {
                                        echo 'dropdown';
                                    }
                                    ?>">
                            <button class="dropbtn">Management</button>
                            <div class="dropdown-content">
                                <a href="/admin/manage_drivers.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_drivers.php') ? 'active' : ''; ?>">Manage Drivers</a>
                                <a href="/admin/manage_admins.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_admins.php') ? 'active' : ''; ?>">Manage Admins</a>
                                <a href="/admin/manage_bookings.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_bookings.php') ? 'active' : ''; ?>">Manage Bookings</a>
                                <a href="/admin/manage_vehicles.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_vehicles.php') ? 'active' : ''; ?>">Manage Vehicles</a>
                                <a href="/admin/manage_routes.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_routes.php') ? 'active' : ''; ?>">Manage Routes</a>
                                <a href="/admin/manage_passenger.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/manage_routes.php') ? 'active' : ''; ?>">Manage Passengers</a>
                            </div>
                        </div>

                        <div class="<?php
                                    if (
                                        $_SERVER['SCRIPT_NAME'] === '/admin/reports/booking_reports.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/reports/feedback_reports.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/reports/passenger_reports.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/reports/route_reports.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/reports/seat_reports.php' ||
                                        $_SERVER['SCRIPT_NAME'] === '/admin/reports/vehicle_reports.php'
                                    ) {
                                        echo 'active dropdown';
                                    } else {
                                        echo 'dropdown';
                                    }
                                    ?>">
                        <div class="dropdown">
                            <button class="dropbtn">Reports</button>
                            <div class="dropdown-content">
                                <a href="/admin/reports/booking_reports.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/reports/booking_reports.php') ? 'active' : ''; ?>">Booking</a>
                                <a href="/admin/reports/feedback_reports.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/reports/feedback_reports.php') ? 'active' : ''; ?>">Feedback</a>
                                <a href="/admin/reports/passenger_reports.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/reports/passenger_reports.php') ? 'active' : ''; ?>">Passenger</a>
                                <a href="/admin/reports/route_reports.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/reports/route_reports.php') ? 'active' : ''; ?>">Route</a>
                                <a href="/admin/reports/seat_reports.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/reports/seat_reports.php') ? 'active' : ''; ?>">Seat</a>
                                <a href="/admin/reports/vehicle_reports.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/admin/reports/vehicle_reports.php') ? 'active' : ''; ?>">Vehicle</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] === 'passenger') : ?>
                        <!-- Passenger specific links -->
                        <a href="/passenger/book_bus.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/passenger/book_bus.php') ? 'active' : ''; ?>">Book Bus</a>
                        <a href="/passenger/history.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/passenger/history.php') ? 'active' : ''; ?>">Booking History</a>
                        <a href="/passenger/feedback.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/passenger/feedback.php') ? 'active' : ''; ?>">Feedback</a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] === 'driver') : ?>
                        <!-- Driver specific links -->
                        <a href="/driver/feedback.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/driver/feedback.php') ? 'active' : ''; ?>">Feedback</a>
                    <?php endif; ?>

                    <a href="/logout.php" class="<?php echo ($_SERVER['SCRIPT_NAME'] === '/logout.php') ? 'active' : ''; ?>">Logout</a>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main class="container">