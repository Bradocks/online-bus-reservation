<?php
session_start();
if (isset($_GET['ticket'])) {

    require_once __DIR__ . "/../config/database.php";
    require_once __DIR__ . '/../utils/auth/Auth.php';
    require_once __DIR__ . '/../utils/orm/BaseModel.php';
    $order_ref = $_GET['ticket'];

    if (empty($order_ref)) {
        $order_ref = $_SESSION['ORDERREF'];
    };
    $data = mysqli_query($conn, "SELECT * FROM booking WHERE order_ref='$order_ref'");
    if (($data) && (mysqli_num_rows($data) > 0)) { ?>
        <html>
        <style>
            .ticketbox {

                border: 2px dashed grey;
                font-family: tahoma;
                font-size: 14px;
                display: inline-block;
                width: 330px;
                height: auto;
                border-radius: 7px;
                padding: 21px;
                color: grey;

            }

            .ref {
                font-family: inherit;
                font-weight: bold;
                color: green;
            }
        </style>

        <body>
    <?php


        //generating fields
        $row = mysqli_fetch_assoc($data);     
        $name = $row['name'];
        $mobileNumber = $row['mobileNumber'];
        $email = $row['email'];
        $IdNO = $row['IdNo'];
        $date_of_departure = $row['date_of_departure'];
        $place_of_departure = $row['place_of_departure'];
        $destination = $row['destination'];
        $category = $row['category'];
        $seats = $row['seats_reserved'];
        $amount = $row['amount'];
    
        mysqli_close($conn);
        while ($seats > 0) {
            echo ("<div class='ticketbox'>");
            echo ("<a> ORDER REF:</a> <span class='ref'>$order_ref</span>");
            echo ("<ul><li>TICKET OWNER: " . $fullname . "</li>
<li>DESTINATION: " . $destination . "</li>
<li>DATE OF TRAVEL: " . $date_of_departure . "</li>
<li>TRAVEL CLASS: " .  $category . "</li>
<li>SEAT ID: " . $seats . " of " . $all . "</li>
<li>AMOUNT PAYING: " . $amount .  "</li>
</ul>");
            echo ("</div>");
            $seats--;
        }
        echo ("</body></html>");
    }
}

    ?>