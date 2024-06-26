<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';

$conn = connect_db($db_config);
$session = new Auth($conn);


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['bookingid'];
    $paymentMethod = $_POST['paymentMethod'];
    $amount = $_POST['charges'];
    $paymenStatement = $_POST['paymenStatement'];

    // Check if booking exists
    $sql = "SELECT * FROM booking WHERE bookingid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the PaymentStatement and other details
        $update_sql = "UPDATE booking SET PaymentMethod = ?, charges = ?, PaymentStatement = ? WHERE bookingid = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sisi", $paymentMethod, $charges, $paymenStatement, $booking_id);

        if ($update_stmt->execute()) {
            if ($session->user()->role == 'Passenger') {
                header("Refresh: 2; URL=/user/index.php");
            } else {
                header("Refresh: 2; URL=index.php");
            }
            // Redirect to index.php after 2 seconds
        } else {
            echo "Error updating booking: " . $conn->error;
        }
    } else {
        echo "Booking not found.";
    }
}

$conn->close();
