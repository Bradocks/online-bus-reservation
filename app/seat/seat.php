
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seat Reservation System</title>
    <style>
        body {
            display: flex;
            justify-content: center;
        }

        .container {
            width: 25%;
            /* Adjust the width as needed */
            margin: 0 auto;
        }

        .seat {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            margin: 5px;
            text-align: center;
            border: 1px solid #000;
            border-radius: 5px;
            cursor: pointer;
        }

        .available {
            background-color: green;
            color: white;
        }

        .booked {
            background-color: red;
            color: white;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
        }

        .bus {
            margin-bottom: 50px;
            border: solid 1px #000;
            border-radius: 30px;
            padding: 10px;
        }
    </style>
    <script>
        function bookSeat(seatId) {
            if (confirm("Are you sure you want to book this seat?")) {
                const formData = new FormData();
                formData.append('seat_id', seatId);

                fetch('', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const seatElement = document.getElementById('seat-' + seatId);
                            seatElement.classList.remove('available');
                            seatElement.classList.add('booked');

                            if ("<?= $payment_method ?>" == 'PesaPal') {
                                window.location.href = '<?= "/user/payment.php?bookingid=" . $booking->bookingid ?>';
                            } else {
                                window.location.href = '<?= "/admin/payment.php?bookingid=" . $booking->bookingid ?>';
                            }
                        } else {
                            alert('Failed to book seat.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Bus Reservation System</h1>
        <?php foreach ($buses as $vehicleId => $seats) : ?>
            <div class="bus">
                <h2>Bus <?= $vehicleId ?></h2>
                <?php
                $rows = break_into_rows($seats);
                foreach ($rows as $row) :
                ?>
                    <div class="row">
                        <?php foreach ($row as $seat) : ?>
                            <div id="seat-<?= $seat['id'] ?>" class="seat <?= $seat['status'] ?>" onclick="bookSeat(`<?= $seat['id'] ?>`)">
                                <div>
                                    <?= $seat['seat_id'] ?><br>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>