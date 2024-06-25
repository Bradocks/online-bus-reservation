<?php
ob_start(); // Start output buffering
include '../../includes/db.php';
include '../../includes/auth.php';
include '../../includes/header.php';

check_auth();
check_role('admin');

$filters = [
    'passenger_name' => ['value' => isset($_GET['passenger_name']) ? $_GET['passenger_name'] : '', 'type' => 'like'],
    'date_of_booking' => ['value' => isset($_GET['date_of_booking']) ? $_GET['date_of_booking'] : '', 'type' => 'date'],
    'departure_date' => ['value' => isset($_GET['departure_date']) ? $_GET['departure_date'] : '', 'type' => 'date'],
    'departure_point' => ['value' => isset($_GET['departure_point']) ? $_GET['departure_point'] : '', 'type' => 'like'],
    'destination' => ['value' => isset($_GET['destination']) ? $_GET['destination'] : '', 'type' => 'like'],
    'driver_name' => ['value' => isset($_GET['driver_name']) ? $_GET['driver_name'] : '', 'type' => 'like'],
    'bus_plate_number' => ['value' => isset($_GET['bus_plate_number']) ? $_GET['bus_plate_number'] : '', 'type' => 'like'],
    'capacity_percentage' => ['value' => isset($_GET['capacity_percentage']) ? $_GET['capacity_percentage'] : '', 'type' => 'like'],
    'vacant_seats' => ['value' => isset($_GET['vacant_seats']) ? $_GET['vacant_seats'] : '', 'type' => 'like'],
    'fully_booked_buses' => ['value' => isset($_GET['fully_booked_buses']) ? $_GET['fully_booked_buses'] : '', 'type' => 'like'],
    'unsuccessful_bookings' => ['value' => isset($_GET['unsuccessful_bookings']) ? $_GET['unsuccessful_bookings'] : '', 'type' => 'like'],
    'time_bookings' => ['value' => isset($_GET['time_bookings']) ? $_GET['time_bookings'] : '', 'type' => 'like'],
];

$query = "
SELECT 
    sub.passenger_name, 
    sub.booking_date, 
    sub.route, 
    sub.place_of_departure, 
    sub.destination, 
    sub.driver_name, 
    sub.bus_plate_number, 
    sub.bus_capacity, 
    sub.vacant_seats, 
    sub.capacity_percentage, 
    sub.fully_booked_buses, 
    sub.unsuccessful_bookings, 
    sub.year, 
    sub.month, 
    sub.week, 
    sub.day
FROM 
(
    SELECT 
        u.name AS passenger_name, 
        b.id AS booking_id,
        b.date_time AS booking_date, 
        b.route AS route, 
        b.place_of_departure, 
        b.destination, 
        d.name AS driver_name, 
        v.plate_number AS bus_plate_number, 
        v.capacity AS bus_capacity, 
        (v.capacity - COUNT(bs.id)) AS vacant_seats, 
        (COUNT(bs.id) / v.capacity) * 100 AS capacity_percentage, 
        COUNT(CASE WHEN bs.status = 'booked' THEN 1 END) AS fully_booked_buses, 
        COUNT(CASE WHEN b.payment_statement IS NULL OR b.payment_statement = '' THEN 1 END) AS unsuccessful_bookings, 
        DATE_FORMAT(b.date_time, '%Y') AS year, 
        DATE_FORMAT(b.date_time, '%Y-%m') AS month, 
        DATE_FORMAT(b.date_time, '%Y-%u') AS week, 
        DATE_FORMAT(b.date_time, '%Y-%m-%d') AS day 
    FROM 
        booking b 
    LEFT JOIN 
        user u ON b.passenger_id = u.id 
    LEFT JOIN 
        vehicle v ON b.vehicle_id = v.id 
    LEFT JOIN 
        bus_seats bs ON b.seat_id = bs.id 
    LEFT JOIN 
        user d ON v.driver_id = d.id 
    WHERE 
        1=1 
    GROUP BY 
        u.name, 
        b.id, 
        b.date_time, 
        b.route, 
        b.place_of_departure, 
        b.destination, 
        d.name, 
        v.plate_number, 
        v.capacity, 
        year, 
        month, 
        week, 
        day
) as sub
WHERE 1= 1
";

foreach ($filters as $key => $filter) {
    $value = $filter['value'];
    $type = $filter['type'];
    if (!empty($value)) {
        if ($type == 'like') {
            $query .= " AND $key LIKE '%$value%'";
        } elseif ($type == 'date') {
            $query .= " AND DATE(sub.$key) = '$value'";
        }
    }
}

$result = $conn->query($query);

echo '<style>
.form-group {
    display: flex;
    flex-direction: column;
    margin-right: 10px;
    margin-left: 10px;
}
.form-group label {
    flex: 1;
}
.form-group input,
.form-group select {
    flex: 1;
    width: 100%;
}
.flex-container {
    display: flex;
    flex-wrap: wrap;
}
.flex-container .form-group {
    flex: 1 1 calc(25% - 20px); /* Adjust width to fit the container */
    box-sizing: border-box;
}
</style>';

echo '<div class="mt-4 container">';
echo '<h1 class="mb-4">Booking Report</h1>';
echo '<form method="GET" action="" class="card">';
echo '<div class="mb-4 px-4 py-4 flex-container">';
echo '<div class="form-group"><label>Passenger Name:</label><input type="text" name="passenger_name" value="' . htmlspecialchars($filters['passenger_name']['value']) . '"></div>';
echo '<div class="form-group"><label>Date of Booking:</label><input type="date" name="date_of_booking" value="' . htmlspecialchars($filters['date_of_booking']['value']) . '"></div>';
echo '<div class="form-group"><label>Departure Date:</label><input type="date" name="departure_date" value="' . htmlspecialchars($filters['departure_date']['value']) . '"></div>';
echo '<div class="form-group"><label>Departure Point:</label><input type="text" name="departure_point" value="' . htmlspecialchars($filters['departure_point']['value']) . '"></div>';
echo '<div class="form-group"><label>Destination:</label><input type="text" name="destination" value="' . htmlspecialchars($filters['destination']['value']) . '"></div>';
echo '<div class="form-group"><label>Driver Name:</label><input type="text" name="driver_name" value="' . htmlspecialchars($filters['driver_name']['value']) . '"></div>';
echo '<div class="form-group"><label>Bus Plate Number:</label><input type="text" name="bus_plate_number" value="' . htmlspecialchars($filters['bus_plate_number']['value']) . '"></div>';
echo '<div class="form-group"><label>Capacity Percentage:</label><input type="text" name="capacity_percentage" value="' . htmlspecialchars($filters['capacity_percentage']['value']) . '"></div>';
echo '<div class="form-group"><label>Vacant Seats:</label><input type="text" name="vacant_seats" value="' . htmlspecialchars($filters['vacant_seats']['value']) . '"></div>';
echo '<div class="form-group"><label>Fully Booked Buses:</label><input type="text" name="fully_booked_buses" value="' . htmlspecialchars($filters['fully_booked_buses']['value']) . '"></div>';
echo '<div class="form-group"><label>Unsuccessful Bookings:</label><input type="text" name="unsuccessful_bookings" value="' . htmlspecialchars($filters['unsuccessful_bookings']['value']) . '"></div>';
echo '<div class="form-group"><label>Time Bookings:</label><select name="time_bookings">
    <option value="">Select</option>
    <option value="yearly"' . ($filters['time_bookings']['value'] === 'yearly' ? ' selected' : '') . '>Yearly</option>
    <option value="monthly"' . ($filters['time_bookings']['value'] === 'monthly' ? ' selected' : '') . '>Monthly</option>
    <option value="weekly"' . ($filters['time_bookings']['value'] === 'weekly' ? ' selected' : '') . '>Weekly</option>
    <option value="daily"' . ($filters['time_bookings']['value'] === 'daily' ? ' selected' : '') . '>Daily</option>
</select></div>';
echo '</div>';
echo '<div class="form-group px-4"><button type="submit" class="btn btn-primary">Filter</button></div>';
echo '</form>';

echo "<div class=\"card\"> <div class=\"card-body\" style=\"overflow-x: scroll\">";
if ($result->num_rows > 0) {
    echo '<table class="table table-striped" style="height: 100%;">';
    echo "<tr>
            <th>Passenger Name</th>
            <th>Date of Booking</th>
            <th>Departure Date & Time</th>
            <th>Departure Point</th>
            <th>Destination</th>
            <th>Driver Allocated</th>
            <th>Registration Number of Bus</th>
            <th>Vacant Seats in Buses</th>
            <th>Capacity Percentage</th>
            <th>Fully Booked Buses</th>
            <th>Unsuccessful Bookings</th>
            <th>Bookings by Year</th>
            <th>Bookings by Month</th>
            <th>Bookings by Week</th>
            <th>Bookings by Day</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['passenger_name']}</td>
                <td>{$row['booking_date']}</td>
                <td>{$row['route']}</td>
                <td>{$row['place_of_departure']}</td>
                <td>{$row['destination']}</td>
                <td>{$row['driver_name']}</td>
                <td>{$row['bus_plate_number']}</td>
                <td>{$row['vacant_seats']}</td>
                <td>{$row['capacity_percentage']}%</td>
                <td>{$row['fully_booked_buses']}</td>
                <td>{$row['unsuccessful_bookings']}</td>
                <td>{$row['year']}</td>
                <td>{$row['month']}</td>
                <td>{$row['week']}</td>
                <td>{$row['day']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}

echo "</div></div>";

echo '</div>';

include '../../includes/footer.php';
