<!DOCTYPE html>
<html>

<head>
    <title> Payment </title>
    <link rel="stylesheet" href="../form.css">
</head>

<body>

<style>
            body {
              background-image: url('/photo1.jpeg');
            }
            </style>

    <div class="form-payment-container">

        <form action="process_payment.php" onsubmit="return validatePayment()"  method="POST">
            <input type="hidden" name="bookingid" value="<?php echo htmlspecialchars($_GET['bookingid']); ?>">
            <h2 style="margin-bottom: 2rem;">Payment</h2>
            <label>Payment Method</label>
            <select name="paymentMethod" id="paymentMethod" required>
                <option value="*" hidden>Select option</option>
                <option value="Cash">Cash</option>
                <option value="PesaPal">PesaPal</option>
            </select>

            <label>Mobile Number</label>
            <input type="text" name="phone_number" id="phone" required placeholder="07********">

            <label>Amount</label>
            <input type="text" name="amount" id="amount" required placeholder="Enter amount">

            <label>payment statement</label>
            <textarea id="paymenStatement" name="paymenStatement"></textarea>
            </br>

            <button name="submit" value="submit">submit</button>
        </form>
        <script src="../js/functions.js"></script>
    </div>

</body>

</html>