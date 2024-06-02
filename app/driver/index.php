<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
$conn = connect_db($db_config);
$session = new Auth($conn);

if ((!isset($_SESSION['userId']) || $_SESSION['userId'] === null) && $_SERVER['REQUEST_URI'] != '/user') {
    header("Location: /user");
    exit;
}

$driver = $session->user();

require_once __DIR__ . '/../utils/orm/BaseModel.php';

$vehicle_model = new BaseModel('vehicle', $conn);
$vehicle = $vehicle_model->where('driverId', '=', $driver->userId)->first();

?>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./driver.css" />
    <link rel="stylesheet" href="../home.css" />
    <title>Driver</title>
</head>

<body>
    <div class="driver_container">
        <h2>Driver Dashboard</h2>
        <header class="passenger-header">
            <div class="logo-container">
                <img src="/driver/assets/logo.png" alt=" Logo" class="logo" style="height: 100px;">
            </div>
            <div class="passenger-nav-details">
                <div class="user-info" style="color:white; font-size:20px;">
                    <p class="userName">
                        Welcome
                        <?php echo $driver->name; ?>
                    </p>
                    <p class="userId">
                        ID:
                        <?php echo $driver->userId; ?>
                    </p>
                </div>
                <nav class="navigation">
                    `
                    <ul class="nav-list">
                        <!--Check on the list of active bookings and history of all passed bookings -->
                        <li><a href="/user/history.php">History</a></li>
                        <li><a href="/user/ProfileUI.php">Profile</a></li>
                        <li><a href="/user/feedback.html">Feedback</a></li>
                        <li><a href="/user/logout.php">logout</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="driver_bus_details" style="background-color: white;">
            <div class="bus_image_wrapper">
                <img src="/driver/assets/driver.jpg" alt="" id="bus_icon" />
            </div>
            <div class="bus_details">
                <div class="bus_details_header">
                    <h2><?php echo $vehicle->plateNo; ?></h2>
                </div>
                <div class="car_credentials">
                    <p>Driver name: <span> <?php echo $driver->name; ?></span></p>
                    <p>License plate: <span> <?php echo $vehicle->plateNo; ?></span></p>
                    <p>Brand: <span>Mercedes</span></p>
                    <p>Model: <span>Benz</span></p>
                    <p>Passenger Capacity: <span> <?php echo $vehicle->capacity; ?></span></p>

                </div>
            </div>
        </div>
    </div>
    <footer class="footer" style="color:white;">
        <h2>Contact Us</h2>
        <p>Have a question?</p>
        <address>
            Email: okomotravels@gmail.com<br />
            Phone: 0710371315
        </address>
        <div class="copy">&copy; 2024. All rights reserved.</div>
    </footer>
</body>

</html>