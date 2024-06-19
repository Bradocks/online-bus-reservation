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

        // var_dump($_SESSION);

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

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="driver">Driver</option>
            <option value="Passenger">Passenger</option>
        </select>
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>

</html>