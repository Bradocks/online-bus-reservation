<?php
ob_start(); // Start output buffering
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';

check_auth();
check_role('admin');

// Handle form submission for create and update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $plate_number = $_POST['plate_number'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $capacity = $_POST['capacity'];
    $driver_id = $_POST['driver_id'];
    $disabled = $_POST['disabled'];
    $route_id = $_POST['route_id'];

    if ($id) {
        // Update existing vehicle
        $sql = "UPDATE vehicle SET plate_number='$plate_number', brand='$brand', model='$model', capacity='$capacity', driver_id='$driver_id', disabled='$disabled', route_id='$route_id' WHERE id=$id";
        echo "Vehicle updated successfully.";
    } else {
        // Create new vehicle
        $sql = "INSERT INTO vehicle (plate_number, brand, model, capacity, driver_id, disabled, route_id) VALUES ('$plate_number', '$brand', '$model', '$capacity', '$driver_id', '$disabled', '$route_id')";
    }
    $conn->query($sql);
    header('Location: /admin/manage_vehicles.php');
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM vehicle WHERE id=$id";
    $conn->query($sql);
    header('Location: /admin/manage_vehicles.php');
    exit();
}

// Fetch vehicle for update
$vehicle_to_update = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM vehicle WHERE id=$id";
    $result_edit = $conn->query($sql);
    $vehicle_to_update = $result_edit->fetch_assoc();
}

// Fetch all vehicles
$sql = "SELECT * FROM vehicle";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header"><?php echo $vehicle_to_update ? 'Update Vehicle' : 'Create Vehicle'; ?></div>
        <div class="card-body">
            <form method="POST" action="/admin/manage_vehicles.php?edit=<?php echo $vehicle_to_update['id']; ?>">
                <input type="hidden" name="id" value="<?php echo $vehicle_to_update ? $vehicle_to_update['id'] : ''; ?>">
                <div class="form-group">
                    <label>Plate Number</label>
                    <input type="text" class="form-control" name="plate_number" value="<?php echo $vehicle_to_update ? $vehicle_to_update['plate_number'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" class="form-control" name="brand" value="<?php echo $vehicle_to_update ? $vehicle_to_update['brand'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Model</label>
                    <input type="text" class="form-control" name="model" value="<?php echo $vehicle_to_update ? $vehicle_to_update['model'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="text" class="form-control" name="capacity" value="<?php echo $vehicle_to_update ? $vehicle_to_update['capacity'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Driver ID</label>
                    <input type="text" class="form-control" name="driver_id" value="<?php echo $vehicle_to_update ? $vehicle_to_update['driver_id'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Disabled</label>
                    <input type="text" class="form-control" name="disabled" value="<?php echo $vehicle_to_update ? $vehicle_to_update['disabled'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Route ID</label>
                    <input type="text" class="form-control" name="route_id" value="<?php echo $vehicle_to_update ? $vehicle_to_update['route_id'] : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $vehicle_to_update ? 'Update' : 'Create'; ?></button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Vehicle List</div>
        <div class="card-body" style="overflow-x: scroll;">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Plate Number</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Capacity</th>
                        <th>Driver ID</th>
                        <th>Disabled</th>
                        <th>Route ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['plate_number']}</td>
                                    <td>{$row['brand']}</td>
                                    <td>{$row['model']}</td>
                                    <td>{$row['capacity']}</td>
                                    <td>{$row['driver_id']}</td>
                                    <td>{$row['disabled']}</td>
                                    <td>{$row['route_id']}</td>
                                    <td>
                                        <a href='/admin/manage_vehicles.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='javascript:void(0);' onclick='confirmDelete({$row['id']})' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No vehicles available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this vehicle?")) {
            window.location.href = '/admin/manage_vehicles.php?delete=' + id;
        }
    }
</script>

<?php include '../includes/footer.php'; ?>