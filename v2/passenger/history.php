<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('Passenger');
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Booking Information</div>
        <div class="card-body" style="overflow-x: scroll;">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Vehicle ID</th>
                        <th>Place of Departure</th>
                        <th>Destination</th>
                        <th>Date & Time</th>
                        <th>Route</th>
                        <th>Charges</th>
                        <th>Payment Method</th>
                        <th>Payment Detail</th>
                        <th>Ticket Code</th>
                        <th>Seat ID</th>
                        <th>Route ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_id =  $_SESSION['user_id'];
                    $sql = "SELECT id, passenger_id, vehicle_id, place_of_departure, destination, category, date_time, route, charges, payment_method, payment_statement, payment_detail, ticket_code, seat_id, route_id FROM booking
                            WHERE passenger_id = $user_id;
                    ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['vehicle_id']}</td>
                                    <td>{$row['place_of_departure']}</td>
                                    <td>{$row['destination']}</td> 
                                    <td>{$row['date_time']}</td>
                                    <td>{$row['route']}</td>
                                    <td>{$row['charges']}</td>
                                    <td>{$row['payment_method']}</td>                                  
                                    <td>{$row['payment_detail']}</td>
                                    <td><a class=\"btn btn-primary\" href=\"/passenger/ticket.php?booking_id={$row['id']}\">{$row['ticket_code']}</a></td>
                                    <td>{$row['seat_id']}</td>
                                    <td>{$row['route_id']}</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='15'>No bookings available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>