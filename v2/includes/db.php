<?php
$host = 'mysql-db';
$user = 'sample';
$password = 'root';
$dbname = 'busreservation';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
