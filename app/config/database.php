<?php
// Database configuration setting
$db_config = [
    'host' => 'mysql-db',
    'username' => 'sample',
    'password' => 'root',
    'dbname' => 'busreservation',
    'port' => 3306
];

// Establish the connection using the configuration array
$conn = new mysqli($db_config['host'], $db_config['username'], $db_config['password'], $db_config['dbname'], $db_config['port']);

// Check if the connection to the database was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Terminate script execution if the connection fails
}

// Now you can use $conn for your database operations
?>
