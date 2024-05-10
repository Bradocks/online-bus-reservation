<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

$conn = connect_db();
$session = new Auth($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $IdNO = $_POST['IdNo'];
    $date_of_departure = $_POST['date_of_departure'];
    $place_of_departure = $_POST['place_of_departure'];
    $destination = $_POST['destination'];
    $category = $_POST['category'];



    $booking_model = new BaseModel('booking', $conn);
    $vehicle_model = new BaseModel('vehicle', $conn);

    $booking_model->create([
        'PassengerId' => $session->user()->userId,
        'vehicleId' => $vehicle_model->random_select()->vehicleId,
        'departure' => $place_of_departure,
        'route' => $place_of_departure . '-' . $destination,
        'destination' => $destination,
        'category' => $category,
        'charges' => 2000,
        'PaymentMethod' => 'PESAPAL',
        'ticketCode' => BaseModel::generate_id(8),
    ]);
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>user account </title>
    <link rel="stylesheet" href="../form.css">

</head>

<body>
    <form method="POST" action="book.php">
        <div class="form-book-container">

            <div class="booking-details">
                <p style="text-align: center;">Booking details</p>
                <label>Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo $session->user()->name ?>" placeholder="Kiyotaka Ayanokoji" required><br>
                <label>National number(ID)</label>
                <input type="text" id="IdNo" name="IdNo" value="<?php echo $session->user()->IdNO ?>" required placeholder="89034582"><br>
                <label>MobileNumber</label>
                <input type="text" id="mobileNumber" value="<?php echo $session->user()->mobileNumber ?>" name="mobileNumber" placeholder="0799060221" required><br>
                <label>Email</label>
                <input type="text" id="email" name="email" value="<?php echo $session->user()->email ?>" required placeholder="newEmail@gmail.com"><br>
                <label>Date of Departure</label>
                <input type="text" name="date_of_departure" id="departure_date" placeholder="2024-12-03" required>
                <label>Departure Location</label>
                <input type="text" name="place_of_departure" id="current_location" required placeholder="Nairobi">
                <label>Destination Location</label>
                <input type="text" id="destination" name="destination" required placeholder="Czechia"><br>
                <label>Time</label>
                <select name="time" id="departure_time" required>
                    <option value="*" hidden>Select Time</option>
                    <option value="am">8 am</option>
                    <option value="pm">10 pm</option>
                </select>
            </div>
        </div>
        <div style="text-align: center;">
            <button type="submit">submit</button>
        </div>
        </div>

    </form>

    <script src="../js/registration.js"></script>
</body>

</html>