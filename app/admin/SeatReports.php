<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';


// Fetch vacant seats
$routes_model = new BaseModel('routes', $conn);

$vacant_seats = $routes_model
    ->select([
        'routes.route_id',
        'routes.place_of_departure',
        'routes.destination',
        'v.vehicleId',
        'v.plateNo AS vehicle_name',
        'bs.id AS seat_id',
        'bs.row',
        'bs.position',
        'bs.status'
    ])
    ->join('vehicle v', 'v.route_id = routes.route_id')
    ->join('bus_seats bs', 'bs.vehicleId = v.vehicleId')
    ->where('bs.status', '=', 'available')
    ->groupBy(['routes.route_id', 'v.vehicleId', 'bs.id'])
    ->get_all();

$routes_model = new BaseModel('routes', $conn);
// Fetch fully booked buses
$fully_booked_buses = $routes_model
    ->select([
        'routes.route_id',
        'routes.place_of_departure',
        'routes.destination',
        'v.vehicleId',
        'v.plateNo AS vehicle_name',
        'COUNT(bs.id) AS total_seats'
    ])
    ->join('vehicle v', 'v.route_id = routes.route_id')
    ->join('bus_seats bs', 'bs.vehicleId = v.vehicleId')
    ->where('bs.status', '=', 'booked')
    ->groupBy(['routes.route_id', 'v.vehicleId'])
    ->having('total_seats', '>=', '55')
    // Assuming a bus has 55 seats
    ->get_all();

$routes_model = new BaseModel('routes', $conn);
// Fetch fully booked buses on a given route
$given_route_id = 1;
$fully_booked_buses_on_route = $routes_model
    ->select([
        'routes.route_id',
        'routes.place_of_departure',
        'routes.destination',
        'v.vehicleId',
        'v.plateNo AS vehicle_name',
        'COUNT(bs.id) AS total_seats'
    ])
    ->join('vehicle v', 'v.route_id = routes.route_id')
    ->join('bus_seats bs', 'bs.vehicleId = v.vehicleId')
    ->where('bs.status', '=', 'booked')
    ->where('routes.route_id', '=', $given_route_id)
    ->groupBy(['routes.route_id', 'v.vehicleId'])
    ->having('total_seats', '>=', '20')
    ->get_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bus Seats Availability</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-image: url('/user/assets/bus10.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .container {
            flex: 1;
            padding: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: auto;
            padding: 10px 0;
            background: #f1f1f1;
            width: 100%;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Vacant Seats in Buses</h2>
        <?php if (!empty($vacant_seats)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Route ID</th>
                        <th>Place of Departure</th>
                        <th>Destination</th>
                        <th>Vehicle ID</th>
                        <th>Vehicle Name</th>
                        <th>Seat ID</th>
                        <th>Row</th>
                        <th>Position</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacant_seats as $seat) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($seat['route_id']); ?></td>
                            <td><?php echo htmlspecialchars($seat['place_of_departure']); ?></td>
                            <td><?php echo htmlspecialchars($seat['destination']); ?></td>
                            <td><?php echo htmlspecialchars($seat['vehicleId']); ?></td>
                            <td><?php echo htmlspecialchars($seat['vehicle_name']); ?></td>
                            <td><?php echo htmlspecialchars($seat['seat_id']); ?></td>
                            <td><?php echo htmlspecialchars($seat['row']); ?></td>
                            <td><?php echo htmlspecialchars($seat['position']); ?></td>
                            <td><?php echo htmlspecialchars($seat['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No vacant seats found.</p>
        <?php endif; ?>

        <h2>Fully Booked Buses</h2>
        <?php if (!empty($fully_booked_buses)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Route ID</th>
                        <th>Place of Departure</th>
                        <th>Destination</th>
                        <th>Vehicle ID</th>
                        <th>Vehicle Name</th>
                        <th>Total Seats</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fully_booked_buses as $bus) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($bus['route_id']); ?></td>
                            <td><?php echo htmlspecialchars($bus['place_of_departure']); ?></td>
                            <td><?php echo htmlspecialchars($bus['destination']); ?></td>
                            <td><?php echo htmlspecialchars($bus['vehicleId']); ?></td>
                            <td><?php echo htmlspecialchars($bus['vehicle_name']); ?></td>
                            <td><?php echo htmlspecialchars($bus['total_seats']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No fully booked buses found.</p>
        <?php endif; ?>

        <h2>Fully Booked Buses on Route ID: <?php echo $given_route_id; ?></h2>
        <?php if (!empty($fully_booked_buses_on_route)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Route ID</th>
                        <th>Place of Departure</th>
                        <th>Destination</th>
                        <th>Vehicle ID</th>
                        <th>Vehicle Name</th>
                        <th>Total Seats</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fully_booked_buses_on_route as $bus) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($bus['route_id']); ?></td>
                            <td><?php echo htmlspecialchars($bus['place_of_departure']); ?></td>
                            <td><?php echo htmlspecialchars($bus['destination']); ?></td>
                            <td><?php echo htmlspecialchars($bus['vehicleId']); ?></td>
                            <td><?php echo htmlspecialchars($bus['vehicle_name']); ?></td>
                            <td><?php echo htmlspecialchars($bus['total_seats']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No fully booked buses found on this route.</p>
        <?php endif; ?>
    </div>
    <div class="footer">
        <br>
        <h5><a href="/user/index.php" style="text-decoration: none; color: black;">Back</a></h5>
        <br>
    </div>
</body>

</html>