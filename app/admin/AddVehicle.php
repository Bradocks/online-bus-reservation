<?php
require_once("../config/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plateNo = $_POST['plateNo'];
    $capacity = $_POST['capacity'];
    $driverId = $_POST['driverId'];
    
    $insertQuery = "INSERT INTO vehicle (plateNo, capacity, driverId) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sii", $plateNo, $capacity, $driverId);
    $stmt->execute();
    
    header("Location: /admin/vehicles");
    exit;
}
?>
