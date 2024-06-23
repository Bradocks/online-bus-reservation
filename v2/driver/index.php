<?php
ob_start(); // Start output buffering
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();

/* Ensure $session is properly instantiated
$session = new Auth($conn);

if ((!isset($_SESSION['id']) || $_SESSION['id'] === null) && $_SERVER['REQUEST_URI'] != '/user') {
    header("Location: /user");
    exit;
}

$driver = $session->user();
$vehicle_model = new BaseModel('vehicle', $conn);
$vehicle = $vehicle_model->where('driver_id', '=', $driver->id)->first();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Bus Details</title>
    <style>
        .container {
            margin-top: 1.5rem;
        }
        .card {
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .card-body {
            padding: 1.25rem;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
        }
        .col-md-4, .col-md-8 {
            position: relative;
            width: 100%;
            padding-right: .75rem;
            padding-left: .75rem;
        }
        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .footer {
            padding: 1rem 0;
            color: white;
            background-color: #343a40;
            text-align: center;
        }
        .footer h2 {
            margin-top: 0;
        }
        .copy {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><?php echo $vehicle->plateNo; ?></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="/driver/assets/driver.jpg" alt="Bus Image" class="img-fluid" />
                </div>
                <div class="col-md-8">
                    <p>Driver name: <span><?php echo $driver->name; ?></span></p>
                    <p>License plate: <span><?php echo $vehicle->plateNo; ?></span></p>
                    <p>Brand: <span>Mercedes</span></p>
                    <p>Model: <span>Benz</span></p>
                    <p>Passenger Capacity: <span><?php echo $vehicle->capacity; ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <h2>Contact Us</h2>
        <p>Have a question?</p>
        <address>
            Email: okomotravels@gmail.com<br />
            Phone: 0710371315
        </address>
        <div class="copy">&copy; 2024. All rights reserved.</div>
    </div>
</footer>

</body>
</html>

<?php include '../includes/footer.php'; ?>


<!--<!DOCTYPE html>
<html>

<head>
    <title>Driver Dashboard</title>
</head>

<body>
   TODO: Trip information
    TODO: Bus Details
    <h1>Welcome, Driver</h1>
    <a href="/logout.php">Logout</a>
</body>

</html>--!