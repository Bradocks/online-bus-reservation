<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="/app/home.css" />
</head>

<body>
  <style>
    body {
      background-image: url("../user/assets/bus10.jpg");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>

  <header style="display: flex; flex-direction: row">
    <section>
      <img src="../driver/assets/logo.png" alt="" style="width: 100px; height: 100px" />
    </section>
    <section style="background-color: transparent"></section>
    <section style="margin-left: 100rem;">
      <section style="color:black; font-size:20px;">
        UserName:
        <?php echo $userName; ?><br>
        ID:
        <?php echo $userId; ?>
      </section>
  </header>
  <main style="display: flex; flex-direction: column; width: 30%; margin-left: auto; margin-right: auto;">
    <div style="display: flex; flex-direction: column; background-color: #788585; padding: 2rem; color: white; border-radius: 20px;">
      <h2>REPORTS</h2>
      <ul style="
              list-style-type: none;
              display: flex;
              flex-direction: column;
              color: white;
              gap: 2rem;
            ">
        <li>
          <a style="color: white;" href="adminReportGeneration.php?type=listOfStaff">STAFF REPORTS</a>
        </li>
        <li>
          <a style="color: white;" href="adminReportGeneration.php?type=listOfVehicles">VEHICLE REPORTS</a>
        </li>

        <li>
          <a style="color: white;" href="adminReportGeneration.php?type=listOfUsers">USER REPORTS</a>
        </li>

        <li>
          <a style="color: white;" href="adminReportGeneration.php?type=listOfpassengers">PASSENGER REPORTS</a>
        </li>

        <li>
          <a style="color: white;" href="/admin/SeatReports.php">SEAT REPORTS</a>
        </li>

        <li>
          <a style="color: white;" href="adminReportGeneration.php?type=listOfFeedbacks">FEEDBACK REPORTS</a>
        </li>

        <li>
          <a style="color: white;" href="adminReportGeneration.php?type=listOfbookings">BOOKINGS' REPORTS</a>
        </li>
      </ul>
      <h5>
        <a href="index.php" style="text-decoration: none; color: white; font-size: 16px;">Back</a>
      </h5>
    </div>
  </main>
</body>

</html>