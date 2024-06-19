<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('Passenger');
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Select a route</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Route Name</th>
                        <th>Place of Departure</th>
                        <th>Destination</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, route_name, place_of_departure, destination FROM routes";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['route_name']}</td>
                                    <td>{$row['place_of_departure']}</td>
                                    <td>{$row['destination']}</td>
                                    <td><a href='book_bus.php?route_id={$row['id']}' class='btn btn-primary'>Book</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No routes available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php include '../includes/footer.php'; ?>