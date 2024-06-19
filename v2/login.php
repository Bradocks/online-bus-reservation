<?php
include 'includes/db.php';
include 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM user WHERE email='$username' AND role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if (!password_verify($password, $user['password'])) {
            echo 'Wrong password provided';
            exit();
        }

        switch ($user['role']) {
            case 'admin':
                header('Location: /admin/index.php');
                break;
            case 'driver':
                header('Location: /driver/index.php');
                break;
            case 'Passenger':
                header('Location: /passenger/index.php');
                break;
        }
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <div class="card" style="max-width: 400px; margin: auto;">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" id="username" name="username" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="driver">Driver</option>
                        <option value="Passenger">Passenger</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <?php if (isset($error)) echo "<p>$error</p>"; ?>
            </form>
        </div>
    </div>
</div>

</body>

</html>