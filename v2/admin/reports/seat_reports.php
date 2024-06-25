<?php
ob_start(); // Start output buffering
include '../../includes/db.php';
include '../../includes/auth.php';
include '../../includes/header.php';

check_auth();
check_role('admin');

$filters = [
    'bus_plate_number' => ['value' => isset($_GET['bus_plate_number']) ? $_GET['bus_plate_number'] : '', 'type' => 'like'],
    'route' => ['value' => isset($_GET['route']) ? $_GET['route'] : '', 'type' => 'like'],
];

$query = "
SELECT 
    v.plate_number AS bus_plate_number, 
    r.route_name AS route, 
    v.capacity AS bus_capacity, 
    (v.capacity - COUNT(bs.id)) AS vacant_seats, 
    COUNT(CASE WHEN bs.status = 'booked' THEN 1 END) AS fully_booked_buses
FROM 
    vehicle v
LEFT JOIN 
    bus_seats bs ON v.id = bs.vehicle_id 
LEFT JOIN
    routes r ON v.route_id = r.id
WHERE 
    1=1
";

foreach ($filters as $key => $filter) {
    $value = $filter['value'];
    $type = $filter['type'];
    if (!empty($value)) {
        if ($type == 'like') {
            $query .= " AND v.$key LIKE '%$value%'";
        }
    }
}

$query .= " GROUP BY v.plate_number, r.route_name, v.capacity";

var_dump($query);
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
    flex: 1 1 calc(33.33% - 20px); /* Adjust width to fit the container */
    box-sizing: border-box;
}
</style>';

echo '<div class="mt-4 container">';
echo '<h1 class="mb-4">Bus Seats Report</h1>';
echo '<form method="GET" action="" class="card">';
echo '<div class="mb-4 px-4 py-4 flex-container">';
echo '<div class="form-group"><label>Bus Plate Number:</label><input type="text" name="bus_plate_number" value="' . htmlspecialchars($filters['bus_plate_number']['value']) . '"></div>';
echo '<div class="form-group"><label>Route:</label><input type="text" name="route" value="' . htmlspecialchars($filters['route']['value']) . '"></div>';
echo '</div>';
echo '<div class="form-group px-4"><button type="submit" class="btn btn-primary">Filter</button></div>';
echo '</form>';

echo "<div class=\"card\"> <div class=\"card-body\" style=\"overflow-x: scroll\">";
if ($result->num_rows > 0) {
    echo '<table class="table table-striped" style="height: 100%;">';
    echo "<tr>
            <th>Bus Plate Number</th>
            <th>Route</th>
            <th>Bus Capacity</th>
            <th>Vacant Seats</th>
            <th>Booked Seats</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['bus_plate_number']}</td>
                <td>{$row['route']}</td>
                <td>{$row['bus_capacity']}</td>
                <td>{$row['vacant_seats']}</td>
                <td>{$row['fully_booked_buses']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}

echo "</div></div>";

echo '</div>';

include '../../includes/footer.php';
