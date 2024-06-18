<?php
session_start();

function check_auth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login.php');
        exit();
    }
}

function check_role($role) {
    if ($_SESSION['role'] !== $role) {
        header('Location: /index.php');
        exit();
    }
}
?>
