<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . '/../utils/auth/Auth.php';

$conn = connect_db();
$session = new Auth($conn);


if ((!isset($_SESSION['userId']) || $_SESSION['userId'] === null) && $_SERVER['REQUEST_URI'] != '/user') {
    header("Location: /user");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Passenger booking- Home</title>
    <link rel="stylesheet" href="../home.css" />
</head>

<body>
    <header class="passenger-header">
        <div class="logo-container">
            <img src="logo.png" alt=" Logo" class="logo" style="height: 100px" />
        </div>
        <div class="passenger-nav-details">
            <div class="user-info">
                <p class="userName">
                    Welcome
                    <?php echo $session->user()->name; ?>
                </p>
                <p class="userId">
                    ID:
                    <?php echo $session->user()->userId; ?>
                </p>
            </div>
            <nav class="navigation">
                `
                <ul class="nav-list">
                    <!--Check on the list of active bookings and history of all passed bookings -->
                    <li><a href="book.php">Book</a></li>
                    <li><a href="history.php">History</a></li>
                    <li><a href="ProfileUI.php">Profile</a></li>
                    <li><a href="feedback.html">Feedback</a></li>
                    <li><a href="logout.php">logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="dash-image-container">
        <img src="./assets/bus10.jpg" alt="" class="image-item" style="height: 900px; width: 100%" />
    </div>

    <footer class="footer">
        <h2>Contact Us</h2>
        <p>Have a question?</p>
        <address>
            Email: okomotravels@gmail.com<br />
            Phone: 0710371315
        </address>
        <div class="copy">&copy; 2024. All rights reserved.</div>
    </footer>
</body>

</html>