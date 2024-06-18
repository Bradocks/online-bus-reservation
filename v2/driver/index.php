<?php
include '../includes/db.php';
include '../includes/auth.php';
check_auth();
check_role('driver');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Dashboard</title>
</head>
<body>
    <h1>Welcome, Driver</h1>
    <a href="/logout.php">Logout</a>
</body>
</html>
