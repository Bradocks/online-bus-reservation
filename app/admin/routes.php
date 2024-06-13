//FUNCTIONS 
<?php
// add_route.php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';
require_once __DIR__ . '/../utils/orm/BaseModel.php';


// Assume booking_id is passed via GET or POST
$route_model = new BaseModel('routes', $conn);

// Function to add a route
function addRoute($conn, $route_name, $departure, $destination)
{
    // Check if the route already exists
    $stmt = $conn->prepare("SELECT * FROM routes WHERE route_name = ? AND place_of_departure = ? AND destination = ?");
    $stmt->bind_param("sss", $route_name, $departure, $destination);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Route exists.";
        $stmt->close();
        return;
    }
    $stmt->close();

    // Insert the new route
    $stmt = $conn->prepare("INSERT INTO routes (route_name, place_of_departure, destination) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $route_name, $departure, $destination);
    if ($stmt->execute()) {
        header("Location: routes.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Function to delete a route
function deleteRoute($conn, $route_id)
{
    // Check if the route exists
    $stmt = $conn->prepare("SELECT * FROM routes WHERE route_id = ?");
    $stmt->bind_param("i", $route_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Route not found.";
        $stmt->close();
        return;
    }
    $stmt->close();

    // Delete the route
    $stmt = $conn->prepare("DELETE FROM routes WHERE route_id = ?");
    $stmt->bind_param("i", $route_id);
    if ($stmt->execute()) {
        header("Location: routes.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle form submission for adding a route
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_route'])) {
    $route_name = $_POST['route_name'];
    $place_of_departure = $_POST['place_of_departure'];
    $destination = $_POST['destination'];
    addRoute($conn, $route_name, $place_of_departure, $destination);
}

// Handle form submission for deleting a route
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_route'])) {
    $route_id = $_POST['route_id'];
    deleteRoute($conn, $route_id);
}

// Fetch all routes for display
$result = $conn->query("SELECT * FROM routes");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Routes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <h1>Manage Routes</h1>

    <!-- Form to add a route -->
    <h2>Add a Route</h2>
    <form action="routes.php" method="post">
        <label for="route_name">Route Name:</label>
        <input type="text" id="route_name" name="route_name" required>
        <br>
        <label for="place_of_departure">Place of Departure:</label>
        <input type="text" id="place_of_departure" name="place_of_departure" required>
        <br>
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required>
        <br>
        <input type="hidden" name="add_route" value="true" required>

        <input type="submit" value="Add Route">
    </form>

    <!-- Display existing routes with options to delete -->
    <h2>Existing Routes</h2>
    <table border="1">
        <tr>
            <th>Route ID</th>
            <th>Route Name</th>
            <th>Place of Departure</th>
            <th>Destination</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['route_id']) ?></td>
                    <td><?= htmlspecialchars($row['route_name']) ?></td>
                    <td><?= htmlspecialchars($row['place_of_departure']) ?></td>
                    <td><?= htmlspecialchars($row['destination']) ?></td>
                    <td>
                        <form action="routes.php" method="post" style="display:inline;">
                            <input type="hidden" name="route_id" value="<?= htmlspecialchars($row['route_id']) ?>">
                            <input type="submit" name="delete_route" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">No routes available.</td>
            </tr>
        <?php endif; ?>
    </table>
    <h5><a href="index.php" style="text-decoration: none; color: black;">Back</a></h5>
</body>

</html>