<?php
include '../includes/db.php';
include '../includes/auth.php';
check_auth();
check_role('Passenger');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $seat_number = $_POST['seat_number'];
    $transaction_id = $_POST['transaction_id'];

    $sql = "INSERT INTO bookings (user_id, vehicle_id, seat_number, transaction_id) VALUES ('$user_id', '$vehicle_id', '$seat_number', '$transaction_id')";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Book a Bus</title>
</head>

<body>
<!--TODO: Show seats for user to pick-->
<h1>Book a Bus</h1>
<form method="POST" action="book_bus.php">
    <link rel="stylesheet" href="/v2/css/form.css">
    <form method="POST" action="book.php" class="container">
        <div class="formcontainer">
            <div class="user_details" style="width: 100%;">
                <label>Full Name</label>
                <input type="text" id="name" name="name" placeholder="Peter Hera"><br>

                <label>National_IDNO</label>
                <input type="text" id="id_no" name="id_no" placeholder="89034582"><br>

                <label>Mobile_Number</label>
                <input type="text" id="mobile_number" name="mobile_number" placeholder="0710398363"><br>

                <label>Email</label>
                <input type="text" id="email" name="email" placeholder="email@gmail.com"><br>

                <label>Date_of_Departure</label>
                <input type="text" name="date_of_departure" id="departure_date" placeholder="YYYY-MM-DD"><br>

                <label>Departure_Location</label>
                <input type="text" name="place_of_departure" id="place_of_departure" placeholder="Nairobi"><br>

                <label>Destination</label>
                <input type="text" id="destination" name="destination" placeholder="Busia"><br>

                <label>Seat_No</label>       
                <input type="text" name="seat_id" placeholder="1A" required>

                <label>Time</label>
                <select name="time" id="departure_time">
                    <option value="*" hidden>Select Time</option>
                    <option value="am">0100 HRS</option>
                    <option value="pm">0200 HRS</option>
                    <option value="pm">0300 HRS</option>
                    <option value="pm">0400 HRS</option>
                    <option value="pm">0500 HRS</option>
                    <option value="pm">0600 HRS</option>
                    <option value="pm">0700 HRS</option>
                    <option value="pm">0800 HRS</option>
                    <option value="pm">0900 HRS</option>
                    <option value="pm">1000 HRS</option>
                    <option value="pm">1100 HRS</option>
                    <option value="pm">1200 HRS</option>
                    <option value="am">1300 HRS</option>
                    <option value="pm">1400 HRS</option>
                    <option value="pm">1500 HRS</option>
                    <option value="pm">1600 HRS</option>
                    <option value="pm">1700 HRS</option>
                    <option value="pm">1800 HRS</option>
                    <option value="pm">1900 HRS</option>
                    <option value="pm">2000 HRS</option>
                    <option value="pm">2100 HRS</option>
                    <option value="pm">2200 HRS</option>
                    <option value="pm">2300 HRS</option>
                    <option value="pm">2400 HRS</option>
                   
                </select><br>

                <label>Payment Method</label>
                <select name="payment_method" id="payment_method">
                    <option value="cash">Cash</option>
                    <option value="M_PESA">M_PESA</option>
                </select><br>
            </div>
        </div>
        <div style="text-align: center;">
    <button type="submit">Book</button>
</form>
<div class ="back" style="padding-top: 20px;">
    <a href="index.php">Back to Dashboard</a>
</div>

</body>

</html>