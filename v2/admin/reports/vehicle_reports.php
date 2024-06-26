<?php
ob_start(); // Start output buffering
include '../../includes/db.php';
include '../../includes/auth.php';
include '../../includes/header.php';

check_auth();
check_role('admin');

$query = "
SELECT 
    v.plate_number AS vehicle_plate,
    d.name AS driver_name,
    v.capacity - COALESCE(SUM(CASE WHEN bs.status = 'booked' THEN 1 ELSE 0 END), 0) AS vacant_seats
FROM 
    vehicle v
LEFT JOIN 
    booking b ON v.id = b.vehicle_id
LEFT JOIN 
    bus_seats bs ON b.seat_id = bs.id AND bs.status = 'booked'
LEFT JOIN 
    user d ON v.driver_id = d.id
GROUP BY 
    v.id, v.plate_number, d.name, v.capacity
ORDER BY 
    v.plate_number
";

$result = $conn->query($query);

echo '<style>
.table-container {
    overflow-x: auto;
}
</style>';

echo '<div class="mt-4 container">';
echo '<h1 class="mb-4">Vehicle Report</h1>';

echo "<div class=\"card\"> <div class=\"card-body table-container\">";
if ($result->num_rows > 0) {
    echo '<table class="table">';
    echo "<tr>
            <th>Vehicle Plate</th>
            <th>Driver Name</th>
            <th>Vacant Seats</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['vehicle_plate']}</td>
                <td>{$row['driver_name']}</td>
                <td>{$row['vacant_seats']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No vehicles found.</p>";
}
echo "</div></div>";

echo '</div>';

include '../../includes/footer.php';
