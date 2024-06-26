<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';

$conn = connect_db($db_config);
$session = new Auth($conn);

if ($session->user() !== null) {
    switch ($session->user()->role) {
        case "Passenger":
            header("Location:./passengerdashboard.php");
            break;
        case "driver":
            header("Location:/driver");
            break;
        case "admin":
            header("Location:/admin");
            break;
        default:
            header("location:home.html");
    }
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login </title>
    <link rel="stylesheet" href="../form.css">
</head>

<body>

    <style>
        body {
            background-image: url('/photo1.jpeg');
        }
    </style>

    <div id="form">
        <form method="POST" action="./login.php" onsubmit="return loginvalidate ()">
            <header class="header">
                <div class="logo-container">
                    <img src="/driver/assets/logo.png" alt="Logo" class="logo">
                </div>

                <P style="text-align: center;">Login</P>

                <label>email</label>
                <input type="text" id="userName" name="userName"><br>

                <label> Enter Password</label>
                <input type="password" id="password" name="password"><br>
                <label>Role</label>
                <select name="role" id="role">
                    <option value="Passenger">Passenger</option>
                    <option value="driver">driver</option>
                    <option value="admin">admin</option>
                </select>

                <button type="submit">Login</button>
                <p><a href="resetPassword.html">forgot password</a></p>
                <p><a href="userRegistrationForm.html">Create account</a></p>
        </form>
    </div>
    <script src="../js/registration.js"></script>
</body>

</html>