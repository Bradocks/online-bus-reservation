
<!DOCTYPE html>
<html>
    <head>
        <title>Delete vehicle </title>
        <link rel="stylesheet" href="../form.css">
    </head>
    <body>

        <style>
            body {
              background-image: url('/photo1.jpeg');
            }
            </style>

     <div> 
        <form  method="POST" action="DeleteVehicle.php" onsubmit="return NotNullAndNan()">
            
            <header class="header">
                <div class="logo-container">
                    <img src="/driver/assets/logo.png" alt="Logo" class="logo">
                </div>

            <p style="text-align: center;">delete vehicle</p>
        <label>enter vehicle ID</label>
          <input type="text" id="searchid" name="vehicleId" required placeholder="HVC-889"><br>
           
       <button type="submit">delete vehicle</button>  
       <br>
       <h5><a href="index.php" style="text-decoration: none; color: black;">Back</a></h5><br>
        </form>
        <script src="../js/validation.js"></script>
     </div>
    </body>
</html>