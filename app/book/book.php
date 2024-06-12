<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking</title>
    <link rel="stylesheet" href="../form.css">
    <style>
        body {
            background-image: url('/photo1.jpeg');
        }
    </style>
</head>

<body>

    <form method="POST" action="book.php" class="container">
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
                <input type="text" name="date_of_departure" id="departure_date" placeholder="2024-12-03" value="<?php echo date('Y-m-d') ?>" required>

                <label>Bus</label>
                <select name="vehicle_id" id="vehicle_id" required onchange="populateRouteDetails()">
                    <option value="" hidden>Select Route</option>
                    <?php foreach ($routes as $route) : ?>
                        <option value="<?php echo $route['vehicleId']; ?>" data-departure="<?php echo $route['place_of_departure']; ?>" data-destination="<?php echo $route['destination']; ?>">
                            <?php echo $route['place_of_departure'] . ' - ' . $route['destination'] . ' Bus (' . $route['vehicle_name'] . ') (' . $route['available_seats'] . ' Seats available)'; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Departure Location</label>
                <input type="text" name="place_of_departure" id="place_of_departure" required placeholder="Nairobi" readonly>
                <label>Destination Location</label>
                <input type="text" id="destination" name="destination" required placeholder="Czechia" readonly><br>
                <label>Time</label>
                <select name="time" id="departure_time" required>
                    <option value="*" hidden>Select Time</option>
                    <option value="am">8 am</option>
                    <option value="pm">10 pm</option>
                </select>
                <label>Payment Method</label>
                <select name="payment_method" id="paymentMethod" required>
                    <option value="*" hidden>Select option</option>
                    <option value="Cash">Cash</option>
                    <option value="PesaPal">PesaPal</option>
                </select>
            </div>
        </div>
        <div style="text-align: center;">
            <button type="submit">submit</button>
        </div>
    </form>

    <script>
        function populateRouteDetails() {
            const routeSelect = document.getElementById('vehicle_id');
            const selectedOption = routeSelect.options[routeSelect.selectedIndex];
            const departure = selectedOption.getAttribute('data-departure');
            const destination = selectedOption.getAttribute('data-destination');

            document.getElementById('place_of_departure').value = departure;
            document.getElementById('destination').value = destination;
        }
    </script>
</body>

</html>