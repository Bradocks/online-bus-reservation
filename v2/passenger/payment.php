<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('Passenger');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">
    <div class="card" style="max-width: 400px; margin: auto;">
        <div class="card-header">Payment</div>
        <div class="card-body">

                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="*" hidden>Select option</option>
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
                    <input type="text" name="amount" id="amount" class="form-control" required placeholder="Enter amount">
                </div>

                <div class="form-group">
                    <label>Payment Statement</label>
                    <textarea id="payment_statement" name="paymena_statement" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
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




// Fetch booking 
// Fetch  price
// Render form and submit
// Update booking to paid