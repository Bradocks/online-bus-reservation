<?php
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $registerQuery = "INSERT INTO user (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($registerQuery);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    header("Location: /user/login.php");
}
?>
