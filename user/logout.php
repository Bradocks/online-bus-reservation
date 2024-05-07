<?php
/*destroy all data associated with the current session, terminates the session and clears
 all session data stored on the server, including session variables and session cookies.*/
session_destroy();
header("location:home.html");

