<?php
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('Passenger');
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Passenger booking- Home</title>
    <link rel="stylesheet" href="/css/home.css" />
</head>


<body>
    <img src="/passenger/assets/bus1.jpeg" style="background-position: center; background-repeat: no-repeat;  background-size: cover; height: 100%; width: 100%" />
</body>

<?php include '../includes/footer.php'; ?>