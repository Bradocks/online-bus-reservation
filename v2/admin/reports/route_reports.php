<?php
ob_start(); // Start output buffering
include '../../includes/db.php';
include '../../includes/auth.php';
include '../../includes/header.php';

check_auth();
check_role('admin');

$query = "
SELECT 
    r.place_of_departure AS departure,
    r.destination AS destination,
    COALESCE(COUNT(b.id), 0) AS total_bookings
FROM 
    routes r
LEFT JOIN 
    booking b ON b.route_id = r.id
GROUP BY 
    r.id, r.place_of_departure, r.destination
ORDER BY 
    total_bookings DESC
";

$result = $conn->query($query);

echo '<style>
.table-container {
    overflow-x: auto;
}
</style>';

echo '<div class="mt-4 container">';
echo '<h1 class="mb-4">Most Booked Routes Report</h1>';

echo "<div class=\"card\"> <div class=\"card-body table-container\">";
if ($result->num_rows > 0) {
    echo '<table class="table">';
    echo "<tr>
            <th>Departure</th>
            <th>Destination</th>
            <th>Total Bookings</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['departure']}</td>
                <td>{$row['destination']}</td>
                <td>{$row['total_bookings']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No data available.</p>";
}
echo "</div></div>";

echo '</div>';

include '../../includes/footer.php';
