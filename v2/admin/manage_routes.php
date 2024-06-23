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
    $route_name = $_POST['route_name'];
    $price = $_POST['price'];
    $place_of_departure = $_POST['place_of_departure'];
    $destination = $_POST['destination'];

    if ($id) {
        // Update existing route
        $sql = "UPDATE routes SET route_name='$route_name', price='$price', place_of_departure='$place_of_departure', destination='$destination' WHERE id=$id";
        echo "Route updated successfully.";
    } else {
        // Create new route
        $sql = "INSERT INTO routes (route_name, price, place_of_departure, destination) VALUES ('$route_name', '$price', '$place_of_departure', '$destination')";
    }
    $conn->query($sql);
    header('Location: /admin/manage_routes.php');
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM routes WHERE id=$id";
    $conn->query($sql);
    header('Location: /admin/manage_routes.php');
    exit();
}

// Fetch route for update
$route_to_update = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM routes WHERE id=$id";
    $result_edit = $conn->query($sql);
    $route_to_update = $result_edit->fetch_assoc();
}

// Fetch all routes
$sql = "SELECT * FROM routes";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header"><?php echo $route_to_update ? 'Update Route' : 'Create Route'; ?></div>
        <div class="card-body">
            <form method="POST" action="/admin/manage_routes.php?edit=<?php echo $route_to_update['id']; ?>">
                <input type="hidden" name="id" value="<?php echo $route_to_update ? $route_to_update['id'] : ''; ?>">
                <div class="form-group">
                    <label>Route Name</label>
                    <input type="text" class="form-control" name="route_name" value="<?php echo $route_to_update ? $route_to_update['route_name'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $route_to_update ? $route_to_update['price'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Place of Departure</label>
                    <input type="text" class="form-control" name="place_of_departure" value="<?php echo $route_to_update ? $route_to_update['place_of_departure'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Destination</label>
                    <input type="text" class="form-control" name="destination" value="<?php echo $route_to_update ? $route_to_update['destination'] : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $route_to_update ? 'Update' : 'Create'; ?></button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Route List</div>
        <div class="card-body" style="overflow-x: scroll;">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Route Name</th>
                        <th>Price</th>
                        <th>Place of Departure</th>
                        <th>Destination</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['route_name']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['place_of_departure']}</td>
                                    <td>{$row['destination']}</td>
                                    <td>
                                        <a href='/admin/manage_routes.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='javascript:void(0);' onclick='confirmDelete({$row['id']})' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No routes available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this route?")) {
            window.location.href = '/admin/manage_routes.php?delete=' + id;
        }
    }
</script>

<?php include '../includes/footer.php'; ?>
