<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'bus_booking_system';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
