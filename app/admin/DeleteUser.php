<?php
require_once("../config/database.php");

$UserId = $_POST['userId'];

// Check if the user exists
$checkQuery = "SELECT * FROM user WHERE userId = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("i", $UserId);
$stmt->execute();
$checkResult = $stmt->get_result();

if ($checkResult->num_rows > 0) {
    // Delete the user
    $deleteQuery = "DELETE FROM user WHERE userId = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $UserId);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "User deleted<a href='DeleteUser.html'>Delete user</a>" . "<br>";
        echo "Back to dashBoard: <a href='index.php'>Dashboard</a>". "<br>";
    } else {
        echo "Failed!: <a href='DeleteUser.html'>Delete user</a>". "<br>";
    }
} else {
    echo "User not found <a href='index.php'>Dashboard</a>". "<br>";
}
$conn->close();
?>
