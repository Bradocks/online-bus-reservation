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
                        <li><a href="reportpassengerActivities.html">Passenger Activities</a></li>>
                        <li><a href="reportDriverActivities.html">Driver Activities</a></li>
                      </ul> </th>
                      <th> <ul>
                      <li><a href="reportbookingbypassenger.html">booking by passenger</a></li>
                        <li><a href="reportbookingbyvehicle.html">booking by vehicle</a></li>
                        <li><a href="repoerbookingbyroute.html">booking By route</a></li>
                        <li><a href="reportbookingbydestination.html">booking by destination </a></li>
                        <li><a href="reportbookingbydeparture.html">booking by departure</a></li>
                        <li><a href="reportbookingonagivendate.html">booking by date</a></li>
                        <li><a href="reportbookinginagivenyear.html">booking by year</a></li>
                        <li><a href="reportbookinginagivenmonth.html">booking by month</a></li>
                       
                        

                      </ul></th>
                      <th> <ul>
                        <li>  staff:
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
                        <a href="adminReportGeneratoin.php?type=listOfpassengers">list of senders</a>
                        <br></br>
                        </li>
                        
                        <li> 
                        Feedback reports: 
                        <a href="adminReportGeneration.php?type=listOfFeedbacks">list of Feedbacks</a>
                         
                        </li>

                          <li> 
                        booking reports: 
                        <a href="adminReportGeneration.php?type=listOfreports">list of reports</a>
                         
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
