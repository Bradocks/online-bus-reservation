
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
            <nav class="navigation">
                `
                <ul class="nav-list">
                    <div class="user-info" style="margin-right: 6rem;">
                        <p class="userName">
                            Welcome
                            <?php echo $userName; ?>
                        </p>
                        <p class="userId">
                            ID:
                            <?php echo $userId; ?>
                        </p>
                    </div>
                    <details class="dropdown">
                        <summary role="button">
                            <a class="button">System Management</a>
                        </summary>
                        <ul>
                            <li><a class="admin_dropdown_item" href="./Addstaff.html">Add Staff</a></li>
                            <li><a class="admin_dropdown_item" href="./DeleteStaff.html">Delete Staff</a></li>
                            <li><a class="admin_dropdown_item" href="./Employee status.html">Employee status</a></li>
                            <li><a class="admin_dropdown_item" href="./AddVehicle.html">Add vehicle</a></li>
                            <li><a class="admin_dropdown_item" href="./DeleteVehicle.html">Delete Vehicle</a></li>
                            <li><a class="admin_dropdown_item" href="./routes.php">routes</a></li>
                            <li><a class="admin_dropdown_item" href="./check_bookings.php">Failed Bookings</a></li>
                            <li><a class="admin_dropdown_item" href="adminReports.php">Reports</a></li>
                            <li><a class="admin_dropdown_item" href="./DeleteUser.html">Delete user</a></li>
                            <li><a class="admin_dropdown_item" href="../user/feedback.html">Feedback</a></li>
                        </ul>
                    </details>
                    <li><a href="/user/ProfileUI.php">Profile</a></li>
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