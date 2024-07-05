<?php
ob_start(); // Start output buffering
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';

check_auth();
check_role('admin');
?>

<body>
    <img src="/passenger/assets/bus1.jpeg" style="background-position: center; background-repeat: no-repeat;  background-size: cover; height: 100%; width: 100%" />
</body>

<?php include '../includes/footer.php'; ?>