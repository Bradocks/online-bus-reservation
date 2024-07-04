<?php
ob_start(); // Start output buffering
include '../../includes/db.php';
include '../../includes/auth.php';
include '../../includes/header.php';

check_auth();
check_role('admin');

$filters = [
    'r.place_of_departure' => ['value' => isset($_GET['departure']) ? $_GET['departure'] : '', 'type' => 'like'],
    'r.destination' => ['value' => isset($_GET['destination']) ? $_GET['destination'] : '', 'type' => 'like'],
    'sub.time_bookings' => ['value' => isset($_GET['time_bookings']) ? $_GET['time_bookings'] : '', 'type' => 'date'],
];

$query = "
SELECT 
    p.name AS passenger_name, 
    b.date_time AS date_of_travel, 
    r.place_of_departure AS departure, 
    r.destination AS destination 
FROM 
    booking b 
JOIN 
    user p ON b.passenger_id = p.id 
JOIN 
    routes r ON b.route_id = r.id 
WHERE 
    1=1
";

foreach ($filters as $key => $filter) {
    $value = $filter['value'];
    $type = $filter['type'];
    if (!empty($value)) {
        if ($type == 'like') {
            $query .= " AND $key LIKE '%$value%'";
        }
    }
}

if (isset($filters['sub.time_bookings']['value'])) {
    switch ($filters['sub.time_bookings']['value']) {
        case 'year':
            $query .= " AND b.date_time BETWEEN now() - INTERVAL 1 YEAR AND now()";
            break;
        case '6months':
            $query .= " AND b.date_time BETWEEN now() - INTERVAL 6 MONTH AND now()";
            break;
        case '3months':
            $query .= " AND b.date_time BETWEEN now() - INTERVAL 3 MONTH AND now()";
            break;
        case '1month':
            $query .= " AND b.date_time BETWEEN now() - INTERVAL 1 MONTH AND now()";
            break;
    }
}


$result = $conn->query($query);

echo '<style>
.flex-container {
    display: flex;
    flex-wrap: wrap;
}
.flex-container .form-group {
    flex: 1 1 calc(33% - 20px);
    margin: 10px;
    box-sizing: border-box;
}
</style>';

echo '<div class="mt-4 container">';
echo '<h1 class="mb-4">Passenger Travel Report</h1>';
echo '<form method="GET" action="" class="card">';
echo '<div class="mb-4 px-4 py-4 flex-container">';
echo '<div class="form-group"><label>Departure Point:</label><input type="text" name="departure" value="' . htmlspecialchars($filters['departure']['value']) . '"></div>';
echo '<div class="form-group"><label>Destination:</label><input type="text" name="destination" value="' . htmlspecialchars($filters['destination']['value']) . '"></div>';
echo '<div class="form-group"><label>Time Bookings:</label><select name="time_bookings">
        <option value="">Select</option>
        <option value="yearly"' . ($filters['time_bookings']['value'] === 'year' ? ' selected' : '') . '>Last 1 Year</option>
        <option value="monthly"' . ($filters['time_bookings']['value'] === '6months' ? ' selected' : '') . '>Last 6 months</option>
        <option value="weekly"' . ($filters['time_bookings']['value'] === '3months' ? ' selected' : '') . '>Last 3 months</option>
        <option value="daily"' . ($filters['time_bookings']['value'] === '1month' ? ' selected' : '') . '>Last 30 days</option>
    </select></div>';
echo '<div class="form-group"><button type="submit" class="btn btn-primary">Filter</button></div>';
echo '</div>';
echo '</form>';

echo "<div class=\"card\"> <div class=\"card-body\" style=\"overflow-x: auto\">";
if ($result->num_rows > 0) {
    echo '<table class="table">';
    echo "<tr>
            <th>Passenger Name</th>
            <th>Date of Travel</th>
            <th>Departure</th>
            <th>Destination</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['passenger_name']}</td>
                <td>{$row['date_of_travel']}</td>
                <td>{$row['departure']}</td>
                <td>{$row['destination']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No bookings found.</p>";
}
echo "</div></div>";

echo '</div>';

include '../../includes/footer.php';
