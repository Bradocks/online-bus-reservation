<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('passenger');
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Passenger booking- Home</title>
    <link rel="stylesheet" href="/v2/css/home.css" />
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
                </p>
                <p class="userId">
                    ID
                </p>
            </div>
    </header>

    <div class="dash-image-container">
        <img src="./assets/bus10.jpg" alt="" class="image-item" style="height: 900px; width: 100%" />
    </div>

<?php include '../includes/footer.php'; ?>