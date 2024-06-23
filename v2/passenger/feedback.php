<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('Passenger');
?>

<body>
    <header class="passenger-header">
        <!-- <div class="logo-container">
            <img src="logo.png" alt=" Logo" class="logo" style="height: 100px" />
        </div>
        <div class="passenger-nav-details">
            <div class="user-info">
                <p class="userName">
                    Welcome
                </p>
                <p class="userId">
                    ID
                </p>
            </div> -->
    </header>

    <div class="dash-image-container">
        <textarea id="feedback" name="feedback"></textarea>
    </div>

    <?php include '../includes/footer.php'; ?>