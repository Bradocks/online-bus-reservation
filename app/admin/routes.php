

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