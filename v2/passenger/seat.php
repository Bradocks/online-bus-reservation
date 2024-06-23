<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('Passenger');

$seat_id = $_GET['seat_id'];
$booking_id = $_GET['booking_id'];





// Query the vehicle_id and plate_number from the booking and vehicle tables
$vehicle_sql = "SELECT b.vehicle_id, v.plate_number 
                FROM booking b
                JOIN vehicle v ON b.vehicle_id = v.id
                WHERE b.id = $booking_id";

$vehicle_result = $conn->query($vehicle_sql);

if ($vehicle_result->num_rows > 0) {
    $vehicle_row = $vehicle_result->fetch_assoc();
    $vehicle_id = $vehicle_row['vehicle_id'];
    $plate_number = $vehicle_row['plate_number'];
} else {
    echo "No vehicle found for this booking.";
    exit;
}

// Query the seats from the bus_seats table
$seats_sql = "SELECT id, vehicle_id, seat_id, `row`, position, `status`
              FROM bus_seats 
              WHERE vehicle_id = $vehicle_id 
              ORDER BY seat_id DESC";

$seats_result = $conn->query($seats_sql);
?>

<div class="bus-container mt-4">
    <div class="card">
        <div class="card-header"><?php echo $vehicle_row['plate_number']; ?></div>
        <div class="card-body">
            <div class="bus-model">
                <?php
                if ($seats_result->num_rows > 0) {
                    while ($seat = $seats_result->fetch_assoc()) {
                        $color = $seat['status'] == 'available' ? 'green' : 'red';
                        echo "<div class='seat' style='background-color: $color; border-radius: 10px; padding:4px;' onclick='confirmSeat({$seat['id']},{$booking_id})'>
                                {$seat['seat_id']}
                              </div>";
                    }
                } else {
                    echo "No seats available for this vehicle.";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmSeat(seatId, bookingId) {
        if (confirm("Do you want to book this seat?")) {
            // Handle seat booking here, e.g., redirect to a booking page
            window.location.href = `/passenger/ticket.php?seat_id=${seatId}&booking_id=${bookingId}`;
        }
    }
</script>

<style>
    .bus-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .bus-model {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 80%;
    }

    .seat {
        width: 60px;
        height: 60px;
        margin: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }
</style>