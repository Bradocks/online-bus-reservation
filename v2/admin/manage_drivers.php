<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('admin');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_driver'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', 'driver')";
        $conn->query($sql);
    } elseif (isset($_POST['delete_driver'])) {
        $id = $_POST['driver_id'];

        $sql = "DELETE FROM users WHERE id='$id' AND role='driver'";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Drivers</title>
</head>

<body>
    <h1>Manage Drivers</h1>
    <form method="POST" action="manage_drivers.php">
        <input type="text" name="name" placeholder="Driver Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="add_driver">Add Driver</button>
    </form>

    <h2>Existing Drivers</h2>
    <ul>
        <?php
        $sql = "SELECT * FROM users WHERE role='driver'";
        $result = $conn->query($sql);

        while ($driver = $result->fetch_assoc()) {
            echo "<li>{$driver['name']} ({$driver['username']}) 
                  <form method='POST' action='manage_drivers.php' style='display:inline;'>
                      <input type='hidden' name='driver_id' value='{$driver['id']}'>
                      <button type='submit' name='delete_driver'>Delete</button>
                  </form>
                  </li>";
        }
        ?>
    </ul>
    <a href="index.php">Back to Dashboard</a>
</body>

</html>

<?php include '../includes/footer.php'; ?>