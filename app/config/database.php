<?php
// Database configuration setting
$db_config = [
    'host' => 'mysql-db',
    'username' => 'sample',
    'password' => 'root',
    'dbname' => 'busreservation',
    'port' => 3306
];

// Connecting to the database

$global_conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname'], $config['port']);

// Check if the connection to the database was successful
if ($conn->connect_error) {
    // echo "Connection error: " . $conn->connect_error; 
    die("Connection failed: " . $conn->connect_error); // Terminate script execution if the connection fails
}

// Now you can use $conn for your database operations
