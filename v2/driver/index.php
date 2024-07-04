<?php
ob_start(); // Start output buffering
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();

$id = $_SESSION['user_id'];
$sql = "SELECT id, `name`, mobile_number, email, `role`, `user_name`, `password`, id_no, dob, gender, staff_id FROM user WHERE id = '$id'";
$result = $conn->query($sql);

if ($result) {
    $driver = (object) $result->fetch_assoc();
} else {
    // Handle query error
    echo 'Error: ' . $conn->error;
}

$vehicle_sql = "SELECT * FROM vehicle WHERE driver_id = '$id'";
try {
    $vehicle_result = $conn->query($vehicle_sql);
    if ($vehicle_result) {
        $vehicle = (object) $vehicle_result->fetch_assoc();
    } else {
        // Handle query error
        echo 'Error: ' . $conn->error;
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}
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
                        <img src="/passenger/assets/driver.jpg" alt="Bus Image" class="img-fluid" />
                    </div>
                    <div class="col-md-8" style="display: flex; flex-direction: column; flex-wrap: wrap; height:150px; font-weight:bold">
                        <p>Driver name: <span><?php echo $driver->name; ?></span></p>
                        <p>License plate: <span><?php echo $vehicle->plate_number; ?></span></p>
                        <p>Brand: <span><?php echo $vehicle->brand; ?></span></p>
                        <p>Model: <span><?php echo $vehicle->model; ?></span></p>
                        <p>Passenger Capacity: <span><?php echo $vehicle->capacity; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php include '../includes/footer.php'; ?>