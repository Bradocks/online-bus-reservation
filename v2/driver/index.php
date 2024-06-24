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
</body>

</html>

<?php include '../includes/footer.php'; ?>