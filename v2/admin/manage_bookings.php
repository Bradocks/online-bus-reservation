<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('admin');

// Handle form submission for create and update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $passenger_id = $_POST['passenger_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $place_of_departure = $_POST['place_of_departure'];
    $destination = $_POST['destination'];
    $category = $_POST['category'];
    $date_time = $_POST['date_time'];
    $route = $_POST['route'];
    $charges = $_POST['charges'];
    $payment_method = $_POST['payment_method'];
    $payment_statement = $_POST['payment_statement'];
    $payment_detail = $_POST['payment_detail'];
    $ticket_code = $_POST['ticket_code'];
    $seat_id = $_POST['seat_id'];
    $route_id = $_POST['route_id'];

    if ($id) {
        // Update existing booking
        $sql = "UPDATE booking SET passenger_id='$passenger_id', vehicle_id='$vehicle_id', place_of_departure='$place_of_departure', destination='$destination', category='$category', date_time='$date_time', route='$route', charges='$charges', payment_method='$payment_method', payment_statement='$payment_statement', payment_detail='$payment_detail', ticket_code='$ticket_code', seat_id='$seat_id', route_id='$route_id' WHERE id=$id";
        echo "Booking updated successfully.";
    } else {
        // Create new booking
        $sql = "INSERT INTO booking (passenger_id, vehicle_id, place_of_departure, destination, category, date_time, route, charges, payment_method, payment_statement, payment_detail, ticket_code, seat_id, route_id) VALUES ('$passenger_id', '$vehicle_id', '$place_of_departure', '$destination', '$category', '$date_time', '$route', '$charges', '$payment_method', '$payment_statement', '$payment_detail', '$ticket_code', '$seat_id', '$route_id')";
    }
    $conn->query($sql);
    header('Location: /admin/manage_bookings.php');
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM booking WHERE id=$id";
    $conn->query($sql);
    header('Location: /admin/manage_bookings.php');
    exit();
}

// Fetch booking for update
$booking_to_update = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM booking WHERE id=$id";
    $result_edit = $conn->query($sql);
    $booking_to_update = $result_edit->fetch_assoc();
}

// Fetch all bookings
$sql = "SELECT * FROM booking";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header"><?php echo $booking_to_update ? 'Update Booking' : 'Create Booking'; ?></div>
        <div class="card-body">
            <form method="POST" action="/admin/manage_bookings.php?edit=<?php echo $booking_to_update['id']; ?>">
                <input type="hidden" name="id" value="<?php echo $booking_to_update ? $booking_to_update['id'] : ''; ?>">
                <div class="form-group">
                    <label>Passenger ID</label>
                    <input type="text" class="form-control" name="passenger_id" value="<?php echo $booking_to_update ? $booking_to_update['passenger_id'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Vehicle ID</label>
                    <input type="text" class="form-control" name="vehicle_id" value="<?php echo $booking_to_update ? $booking_to_update['vehicle_id'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Place of Departure</label>
                    <input type="text" class="form-control" name="place_of_departure" value="<?php echo $booking_to_update ? $booking_to_update['place_of_departure'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Destination</label>
                    <input type="text" class="form-control" name="destination" value="<?php echo $booking_to_update ? $booking_to_update['destination'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" name="category" value="<?php echo $booking_to_update ? $booking_to_update['category'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Date & Time</label>
                    <input type="text" class="form-control" name="date_time" value="<?php echo $booking_to_update ? $booking_to_update['date_time'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Route</label>
                    <input type="text" class="form-control" name="route" value="<?php echo $booking_to_update ? $booking_to_update['route'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Charges</label>
                    <input type="text" class="form-control" name="charges" value="<?php echo $booking_to_update ? $booking_to_update['charges'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Payment Method</label>
                    <input type="text" class="form-control" name="payment_method" value="<?php echo $booking_to_update ? $booking_to_update['payment_method'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Payment Statement</label>
                    <input type="text" class="form-control" name="payment_statement" value="<?php echo $booking_to_update ? $booking_to_update['payment_statement'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Payment Detail</label>
                    <input type="text" class="form-control" name="payment_detail" value="<?php echo $booking_to_update ? $booking_to_update['payment_detail'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Ticket Code</label>
                    <input type="text" class="form-control" name="ticket_code" value="<?php echo $booking_to_update ? $booking_to_update['ticket_code'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Seat ID</label>
                    <input type="text" class="form-control" name="seat_id" value="<?php echo $booking_to_update ? $booking_to_update['seat_id'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Route ID</label>
                    <input type="text" class="form-control" name="route_id" value="<?php echo $booking_to_update ? $booking_to_update['route_id'] : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $booking_to_update ? 'Update' : 'Create'; ?></button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Booking List</div>
        <div class="card-body" style="overflow-x: scroll;">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Passenger ID</th>
                        <th>Vehicle ID</th>
                        <th>Place of Departure</th>
                        <th>Destination</th>
                        <th>Category</th>
                        <th>Date & Time</th>
                        <th>Route</th>
                        <th>Charges</th>
                        <th>Payment Method</th>
                        <th>Payment Statement</th>
                        <th>Payment Detail</th>
                        <th>Ticket Code</th>
                        <th>Seat ID</th>
                        <th>Route ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['passenger_id']}</td>
                                    <td>{$row['vehicle_id']}</td>
                                    <td>{$row['place_of_departure']}</td>
                                    <td>{$row['destination']}</td>
                                    <td>{$row['category']}</td>
                                    <td>{$row['date_time']}</td>
                                    <td>{$row['route']}</td>
                                    <td>{$row['charges']}</td>
                                    <td>{$row['payment_method']}</td>
                                    <td>{$row['payment_statement']}</td>
                                    <td>{$row['payment_detail']}</td>
                                    <td>{$row['ticket_code']}</td>
                                    <td>{$row['seat_id']}</td>
                                    <td>{$row['route_id']}</td>
                                    <td>
                                        <a href='/admin/manage_bookings.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='javascript:void(0);' onclick='confirmCancel({$row['id']})' class='btn btn-danger btn-sm'>cancel</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='15'>No bookings available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to cancel this booking?")) {
            window.location.href = '/admin/manage_bookings.php?cancel=' + id;
        }
    }
</script>

<?php include '../includes/footer.php'; ?>