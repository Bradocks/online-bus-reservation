<?php
require_once __DIR__ . '/../config/database.php';

session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: /user/login.php");
    exit;
}

$userId = $_SESSION['userId'];
$userQuery = "SELECT * FROM user WHERE userId = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_object();
?>
