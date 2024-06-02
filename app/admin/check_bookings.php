<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

$conn = connect_db($db_config);
$session = new Auth($conn);

// Fetch bookings with empty PaymentStatement
$sql = "SELECT * FROM booking WHERE PaymentStatement IS NULL OR PaymentStatement = ''";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Unsuccessful Bookings</h2>";
    echo "<table border='1'>
            <tr>
                <th>Booking ID</th>
                <th>Destination</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['bookingid']) . "</td>
                <td>" . htmlspecialchars($row['destination']) . "</td>
                <td><a href='payment.php?bookingid=" . htmlspecialchars($row['bookingid']) . "'>Complete Payment</a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No unsuccessful bookings found.";
}

$conn->close();
