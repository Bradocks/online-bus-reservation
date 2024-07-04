<?php
ob_start();
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();


$booking_id = $_GET['booking_id'];

// Handle form submission for create and update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_GET['booking_id']) ? $_GET['booking_id'] : '';
    $payment_method = $_POST['payment_method'];
    $payment_statement = $_POST['payment_statement'];

    if ($id) {
        // Update existing vehicle
        $sql = "UPDATE booking SET payment_method='$payment_method', payment_statement='$payment_statement' WHERE id=$booking_id";
        echo "<script>window.location.href = `/passenger/ticket.php?seat_id={$booking['seat_id']}&booking_id=$booking_id`;</script>";
    }
    $conn->query($sql);
    exit();
}

$booking_sql = "SELECT * FROM booking WHERE `id` = $booking_id";
$booking = $conn->query($booking_sql)->fetch_assoc();

?>


<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
</head>

<body>

    <div class="container mt-4">
        <div class="card" style="max-width: 400px; margin: auto;">
            <form method="POST" action="">
                <?php if (isset($booking_id) && !isset($booking['payment_statement'])) : ?>
                    <div class="card-header">Payment</div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="Cash">Cash</option>
                                <option value="PesaPal">PesaPal</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" name="phone_number" id="phone" class="form-control" required placeholder="07********">
                        </div>

                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $booking['charges']; ?>" disabled required placeholder="Enter amount">
                        </div>

                        <div class="form-group">
                            <label>Payment Statement (Transaction Code)</label>
                            <textarea id="payment_statement" name="payment_statement" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    <?php elseif (isset($booking['payment_statement'])) : ?>
                        <div class="card-header"> Payment already done for booking </div>
                    <?php else : ?>
                        <div class="card-header"> No booking selected</div>
                    <?php endif; ?>
            </form>
        </div>
    </div>
    </div>

    <script>
        function validatePayment() {
            var phone = document.getElementById("phone").value;
            var amount = document.getElementById("amount").value;

            var phonePattern = /^\d{10}$/;
            if (!phonePattern.test(phone)) {
                alert("Please enter a valid mobile number with exactly 10 digits.");
                return false;
            }

            if (isNaN(amount) || amount <= 0) {
                alert("Please enter a valid amount.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>