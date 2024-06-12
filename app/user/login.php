<?php
require_once __DIR__ . '/../config/database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $loginQuery = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($loginQuery);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_object();
        $_SESSION['userId'] = $user->userId;
        header("Location: /user/dashboard.php");
    } else {
        $error = "Invalid username or password";
    }
}
?>
