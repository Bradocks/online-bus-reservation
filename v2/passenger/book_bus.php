<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';

check_auth();
check_role('Passenger');

$route_id = $_GET['route_id'];
$route_sql = "SELECT * FROM routes WHERE id = '$route_id' LIMIT 1";
$route = $conn->query($route_sql)->fetch_assoc();

// Check for available seats before loading the form
$place_of_departure = $route['place_of_departure'];
$destination = $route['destination'];


$sql = "SELECT v.id as vehicle_id, s.id as seat_id FROM vehicle v 
JOIN bus_seats s ON v.id = s.vehicle_id 
JOIN routes r ON v.route_id = r.id 
WHERE r.place_of_departure = '$place_of_departure'
AND r.destination = '$destination'
AND s.status <> 'booked' LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows != 1) {
    echo "<script>alert('No available seats for the selected route.'); window.location.href='/passenger/routes.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $id_no = $_POST['id_no'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $date_of_departure = $_POST['date_of_departure'];
    $place_of_departure = $_POST['place_of_departure'];
    $destination = $_POST['destination'];
    $seat_id = $_POST['seat_id'];
    $departure_time = $_POST['departure_time'];
    $payment_method = $_POST['payment_method'];

    $row = $result->fetch_assoc();
    $vehicle_id = $row['vehicle_id'];
    $seat_id = $row['seat_id'];

    // Insert the booking
    $sql = "INSERT INTO booking (passenger_id, vehicle_id, place_of_departure, destination, date_time, route_id, payment_method, seat_id)
            VALUES ('$user_id', '$vehicle_id', '$place_of_departure', '$destination', '$date_of_departure $departure_time', '$route_id', '$payment_method', '$seat_id')";
    if ($conn->query($sql) === TRUE) {
        $booking_id = $conn->insert_id;
        // // Update seat as booked
        // $sql = "UPDATE seats SET is_booked = 1 WHERE id = '$seat_id'";
        // $conn->query($sql);
        echo "<script>window.location.href='/passenger/seat.php?booking_id=$booking_id';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h1>Book a Bus</h1>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="book_bus.php?route_id=<?php echo $route_id; ?>">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Peter Hera" required>
                </div>
                <div class="form-group">
                    <label for="id_no">National ID NO</label>
                    <input type="text" id="id_no" name="id_no" placeholder="89034582" required>
                </div>
                <div class="form-group">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" id="mobile_number" name="mobile_number" placeholder="0710398363" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="email@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="date_of_departure">Date of Departure</label>
                    <input type="text" name="date_of_departure" id="date_of_departure" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="place_of_departure">Departure Location</label>
                    <input type="text" name="place_of_departure" id="place_of_departure" value="<?php echo $route['place_of_departure']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" id="destination" name="destination" value="<?php echo $route['destination']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="departure_time">Time</label>
                    <select name="departure_time" id="departure_time">
                        <option value="*" hidden>Select Time</option>
                        <option value="01:00">0100 HRS</option>
                        <option value="02:00">0200 HRS</option>
                        <option value="03:00">0300 HRS</option>
                        <option value="04:00">0400 HRS</option>
                        <option value="05:00">0500 HRS</option>
                        <option value="06:00">0600 HRS</option>
                        <option value="07:00">0700 HRS</option>
                        <option value="08:00">0800 HRS</option>
                        <option value="09:00">0900 HRS</option>
                        <option value="10:00">1000 HRS</option>
                        <option value="11:00">1100 HRS</option>
                        <option value="12:00">1200 HRS</option>
                        <option value="13:00">1300 HRS</option>
                        <option value="14:00">1400 HRS</option>
                        <option value="15:00">1500 HRS</option>
                        <option value="16:00">1600 HRS</option>
                        <option value="17:00">1700 HRS</option>
                        <option value="18:00">1800 HRS</option>
                        <option value="19:00">1900 HRS</option>
                        <option value="20:00">2000 HRS</option>
                        <option value="21:00">2100 HRS</option>
                        <option value="22:00">2200 HRS</option>
                        <option value="23:00">2300 HRS</option>
                        <option value="24:00">2400 HRS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method">
                        <option value="cash">Cash</option>
                        <option value="M-PESA">M-PESA</option>
                    </select>
                </div>
                <div style="text-align: center;">
                    <button type="submit">Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>