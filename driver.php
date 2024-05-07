<?php
session_start();
$userId = $_SESSION['userId'];
$userName = $_SESSION['userName'];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./driver.css" />
    <link rel="stylesheet" href="../home.css" />
    <title>Driver</title>
  </head>
  <body>
    <div class="driver_container">
      <h2>Driver Dashboard</h2>
      <header class="passenger-header">
         <div class="logo-container">
            <img src="/driver/assets/logo.png" alt=" Logo" class="logo" style="height: 100px;">
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
              <!--Check on the list of active bookings and history of all passed bookings -->
              <li><a href="/user/history.php">History</a></li>
              <li><a href="/user/Profile.html">Profile</a></li>
              <li><a href="/user/feedback.html">Feedback</a></li>
              <li><a href="/user/home.html">logout</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <!-- <div class="search_driver">
       <img class="search_img" src="./assets/icons8-search.svg" alt="" />
        <input
          type="text"
          name="searchDriver"
          id="driver_id"
          placeholder="Search"
        />

        <button>Add Driver</button>
      </div>

    <div class="driver_map">
        <img
          class="driver_map_image"
          src="./assets/taxi-drivers-map-2.png"
          alt=""
        />
      </div>-->

      <div class="driver_bus_details">
        <div class="bus_image_wrapper">
          <img src="/driver/assets/driver.jpg" alt="" id="bus_icon" />
        </div>
        <div class="bus_details">
          <div class="bus_details_header">
            <h2>263e</h2>
            <a href="">Edit</a>
          </div>
          <div class="car_credentials">
            <p>License plate: <span>KBK 878K</span></p>
            <p>Brand: <span>Mercedes</span></p>
            <p>Model: <span>Benz</span></p>
            <p>Passenger Capacity: <span>48</span></p>
            <p>Today (pas cap): <span>300</span></p>
            <p>Yesterday (pas cap): <span>678</span></p>
          </div>
        </div>
      </div>
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
