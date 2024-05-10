<?php
require_once __DIR__ . '/../../utils/orm/BaseModel.php';  // Assuming BaseDB class is defined in BaseDB.php

class Auth
{
    private $db;

    public function __construct($conn)
    {


        session_start();  // Start the session if not already started



        $this->db = new BaseModel('user', $conn);  // Initialize BaseDB for the 'users' table
    }

    public function user()
    {
        $userId = $_SESSION['userId'] ?? null;  // Get userId from session or null if not set

        if ($userId) {
            return (object) $this->db->get_one($userId, 'userId');  // Fetch user details using BaseDB
        } else {
            return null;  // Return null if no user ID in session
        }
    }

    public function login($username, $password)
    {
    }

    public function logout()
    {
        // Option 1: Unset all session variables
        session_unset();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }
}
