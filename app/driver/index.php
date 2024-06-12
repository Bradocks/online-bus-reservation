<?php
require_once __DIR__ . "/../config/database.php";

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userId']) || $_SESSION['userId'] === null) {
    header("Location: /user");
    exit;
}

// Fetch user details
$userId = $_SESSION['userId'];
$userQuery = "SELECT * FROM user WHERE userId = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$driver = $stmt->get_result()->fetch_object();

// Fetch vehicle details
$vehicleQuery = "SELECT * FROM vehicle WHERE driverId = ?";
$stmt = $conn->prepare($vehicleQuery);
$stmt->bind_param("i", $driver->userId);
$stmt->execute();
$vehicle = $stmt->get_result()->fetch_object();
?>
