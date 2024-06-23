<?php
ob_start(); // Start output buffering
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';

check_auth();
check_role('admin');
?>


<?php include '../includes/footer.php'; ?>