<?php
session_start();
$userId=$_SESSION['userId'];
$userName=$_SESSION['userName']
?>
<html>
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="home.css">
    </head>
    <body  >
        <header>                       
                   <section><img src="logo.png" alt="" style="width: 80px; height: 30px;"></section> 
                   <section style=" background-color: transparent;"></section>         
                   <section> UserName:<?php echo $userName; ?>
                    IdNO:<?php echo $userId; ?>                             
                    </section> 
                   <section><a href="logout.php">logout</a></section>           
        </header>
        <main>
        
              <p style="color: blue; font-size:large; text-align: center;">Buy, we deliver, likewise sell, and we will**</p>
    
                 <div id="home" style="height: 350px; ">
                   
                 <table>
                  <tr>
                        <th colspan="1">join report</th>

                        <th colspan="1">filtered reports</th>
                        <th colspan="1">simple report</th>
                         
                  </tr>
                  <tr>
                      <th> <ul>
                        <li><a href="reportTrackclientActivities.html">Track client Activities</a></li>
                        <li><a href="reportTrackcustomerCareActivities.html">Track customer Care Activities</a></li>
                        <li><a href="reportTrackDriverActivities.html">Track Driver Activities</a></li>
                        <li><a href="reportTrackitemdetails.html">Track item details</a></li>
                      </ul> </th>
                      <th> <ul>
                      <li><a href="reportItembysender.html">items by sender</a></li>
                        <li><a href="reportItemBycustomercare.html">items by customer Care</a></li>
                        <li><a href="reportItembyvehicle.html">Items By vehicle</a></li>
                        <li><a href="repoerItembyroute.html">items By route</a></li>
                        <li><a href="reportItembycategory.html">items By category</a></li>
                        <li><a href="reportItemBydeliverystate.html">items by delivery state</a></li>
                        <li><a href="reportItembydestination.html">items by destination </a></li>
                        <li><a href="reportItembysource.html">items by source</a></li>
                        <li><a href="reportItemInagivendate.html">items by date</a></li>
                        <li><a href="reportIteminagivenyear.html">items by year</a></li>
                        <li><a href="reportItemsinagivenmonth.html">items by month</a></li>
                        <li><a href="reportItemwherechargesaregreaterthan.html">item where charges range between</a></li>
                        

                      </ul></th>
                      <th> <ul>
                        <li>  staff:
                        <a href="adminReportGeneration.php?type=listOfStaff">list of staff's</a>
                        <br></br>
                       </li>
                        <li> 
                        Vehicles:
                        <a href="adminReportGeneration.php?type=listOfVehicles">list of vehicle's</a>
                        <br></br>
                        </li>

                        <li> 
                        user:
                        <a href="adminReportGeneration.php?type=listOfUsers">list of user's</a>
                        <br></br>
                        </li>
                       
                        <li> 
                        passenger reports:
                        <a href="adminReportGeneratoin.php?type=listOfSenders">list of sender's</a>
                        <br></br>
                        </li>
                        
                        <li> 
                        Feedback reports: 
                        <a href="adminReportGeneration.php?type=listOfFeedbacks">list of Feedback's</a>
                         
                        </li>
                      </ul> </th>                                                  
                                             
                  </tr>                   
                  </table>
                </div> 
                  
                         
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
