<?php
/*destroy all data associated with the current session, terminates the session and clears
 all session data stored on the server, including session variables and session cookies.*/
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';

$session = new Auth($conn);
$session->logout();
header("Location: /user");
exit;
