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
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <header>
        <section><img src="/driver/assets/logo.png" alt="" style="width: 100px; height: 100px;"></section>
        <section style=" background-color: transparent;"></section>
        <section> UserName:<?php echo $userName; ?>
            IdNO:<?php echo $userId; ?>
        </section>
        <section><a href="/app/user/logout.php">logout</a></section>
    </header>
    <main>

        <p style="color: blue; font-size:large; text-align: center;">Experience a great trip, new smart world.</p>

        <div id="home" style="height: 350px; ">

            <table>
                <tr>
                    <th colspan="1">REPORTS</th>

                </tr>
                <tr>
                    <th>
                        <ul>
                            <li> staff:
                                <a href="adminReportGeneration.php?type=listOfStaff">list of staffs</a>
                                <br></br>
                            </li>
                            <li>
                                Vehicles:
                                <a href="adminReportGeneration.php?type=listOfVehicles">list of vehicles</a>
                                <br></br>
                            </li>

                            <li>
                                user:
                                <a href="adminReportGeneration.php?type=listOfUsers">list of users</a>
                                <br></br>
                            </li>

                            <li>
                                passenger reports:
                                <a href="adminReportGeneration.php?type=listOfpassengers">list of passengers</a>
                                <br></br>
                            </li>

                            <li>
                                Feedback reports:
                                <a href="adminReportGeneration.php?type=listOfFeedbacks">list of Feedbacks</a>

                            </li>

                            <li>
                                booking reports:
                                <a href="adminReportGeneration.php?type=listOfbookings">list of bookings</a>

                            </li>
                        </ul>
                    </th>

                </tr>
            </table>
        </div>
        <br><h5><a href="index.php" style="text-decoration: none; color: black;">Back</a></h5><br>

    </main>
    

    <footer>
        <h2>Contact Us</h2>
        <p>Have questions? Contact our support team.</p>
        <address>
            Email: alluretravels@gmail.com<br>
            Phone: 0710371315
        </address>

        <div id="copy">
            &copy; 2024. All rights reserved.
        </div>
    </footer>

</body>

</html>