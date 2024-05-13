<?php
session_start();
$userId = $_SESSION['userId'];
$userName = $_SESSION['userName'];

if ((!isset($_SESSION['userId']) || $_SESSION['userId'] === null) && $_SERVER['REQUEST_URI'] != '/user') {
    header("Location: /user");
    exit;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="../home.css" />
</head>

<body>
    <header class="passenger-header">
        <div class="logo-container">
            <img src="/driver/assets/logo.png" alt=" Logo" class="logo" style="height: 100px" />
        </div>
        <div class="passenger-nav-details">
            <div class="user-info">
                <p class="userName">
                    Welcome
                    <?php echo $userName; ?>
                </p>
                <p class="userId">
                    ID:
                    <?php echo $userId; ?>
                </p>
            </div>
            <nav class="navigation">
                `
                <ul class="nav-list">
                    <details class="dropdown">
                        <summary role="button">
                            <a class="button">Manage Staff & Vehicles</a>
                        </summary>
                        <ul>
                            <li><a href="./adminAddstaff.html">Add Staff</a></li>
                            <li><a href="./AdmindeleteStaff.html">Delete Staff</a></li>
                            <li><a href="./AdminUpdateStaff.html">Update Staff</a></li>
                            <li><a href="./AdminAddVehicle.html">Add vehicle</a></li>
                            <li><a href="./adminAssignDriverVehicle.html">Update Vehicle</a></li>
                            <li><a href="./AdminDeleteVehicle.html">Delete Vehicle</a></li>
                            <li><a href="adminReports.php">Reports</a></li>
                            <li><a href="./AdmindeleteUser.html">Delete user</a></li>
                            <li><a href="../user/feedback.html">Feedback</a></li>
                        </ul>
                    </details>
                    <!--Check on the list of active bookings and history of all passed bookings -->
                    <li><a href="/user/Profile.html">Profile</a></li>
                    <li><a href="/user/feedback.html">Feedback</a></li>
                    <li><a href="/user/logout.php">logout</a></li>



                </ul>
            </nav>
        </div>
    </header>

    <div class="dash-image-container">
        <img src="/user/assets/bus10.jpg" alt="" class="image-item" style="height: 900px; width: 100%" />
    </div>
    <!-- <header>
        <section><img src="../user/logo.png" alt="" style="height: 100px;"></section>
        <section style=" background-color: rgb(143, 113, 113);"></section>
        <section style="margin-top: 2rem;"> Username:<?php echo $userName; ?>
            <br>
            ID no:<?php echo $userId; ?>
        </section>
    </header>-->

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