<?php
session_start();
$userId = $_SESSION['userId'];
$userName = $_SESSION['userName']
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/app/home.css">
</head>

<body>

    <style>
        body {
            background-image: url('/user/assets/bus10.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;

        }
    </style>

    <header>
        <section><img src="/driver/assets/logo.png" alt="" style="width: 100px; height: 100px;"></section>
        <section style=" background-color: transparent;"></section>
        <section> UserName:<?php echo $userName; ?>
            ID:<?php echo $userId; ?>
        </section>
        <section><a href="/user/logout.php">logout</a></section>
    </header>
    <main>

        <div id="home" style="height: 350px; ">

            <table>
                <tr>
                    <th colspan="1">REPORTS</th>

                </tr>
                <tr>
                    <th>
                        <ul>
                            <li> 
                                <a href="adminReportGeneration.php?type=listOfStaff">STAFF REPORTS</a>
                                <br></br>
                            </li>
                            <li>
                                
                                <a href="adminReportGeneration.php?type=listOfVehicles">VEHICLE REPORTS</a>
                                <br></br>
                            </li>

                            <li>
                               
                                <a href="adminReportGeneration.php?type=listOfUsers">USER REPORTS</a>
                                <br></br>
                            </li>

                            <li>
                                
                                <a href="adminReportGeneration.php?type=listOfpassengers">PASSENGER REPORTS</a>
                                <br></br>
                            </li>

                            <li>
                               
                                <a href="adminReportGeneration.php?type=listOfFeedbacks">FEEDBACK REPORTS</a>

                            </li>

                            <li>
                                
                                <a href="adminReportGeneration.php?type=listOfbookings">BOOKINGS' REPORTS</a>

                            </li>
                        </ul>
                    </th>

                </tr>
            </table>
        </div>
        <br>
        <h5><a href="index.php" style="text-decoration: none; color: black;">Back</a></h5><br>

    </main>

</body>

</html>