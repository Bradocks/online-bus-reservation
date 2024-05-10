<?php
//estalish connnection to the database
// Database configuration settings
define('DB_HOST', 'mysql-db');
define('DB_USERNAME', 'sample');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'busreservation');
define('DB_PORT', 3306);

// Connecting to the database
function connect_db()
{
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

    /**
     * Check if the connection to the database was successful using connect_error if there is a connect_error the error will be 
     * displayed and execution will be terminated by the die function.
     */
    if ($conn->connect_error) {
        echo "connection error" . $conn->connect_error; // display the connection error if it exists
        die("connection failed:" . $conn->connect_error); // Terminate script execution if the connection fails
    }
    return $conn;
}
