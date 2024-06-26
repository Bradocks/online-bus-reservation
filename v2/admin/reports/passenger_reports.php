<?php
ob_start(); // Start output buffering
include '../../includes/db.php';
include '../../includes/auth.php';
include '../../includes/header.php';

check_auth();
check_role('admin');

$filters = [
    'date_of_travel' => ['value' => isset($_GET['date_of_travel']) ? $_GET['date_of_travel'] : '', 'type' => 'date'],
    'departure' => ['value' => isset($_GET['departure']) ? $_GET['departure'] : '', 'type' => 'like'],
    'destination' => ['value' => isset($_GET['destination']) ? $_GET['destination'] : '', 'type' => 'like'],
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
            $query .= " AND r.$key LIKE '%$value%'";
        } elseif ($type == 'date') {
            $query .= " AND b.date_time = '$value'";
        }
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
foreach ($filters as $field => $data) {
    echo "<div class=\"form-group\">
            <label>" . ucfirst(str_replace('_', ' ', $field)) . ":</label>
            <input type=\"" . ($data['type'] === 'date' ? 'date' : 'text') . "\" name=\"$field\" value=\"" . htmlspecialchars($data['value']) . "\">
          </div>";
}
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
