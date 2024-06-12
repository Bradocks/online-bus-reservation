<!DOCTYPE html>
<html>
  <head>
    <title>user account</title>
    <link rel="stylesheet" href="../form.css" />
  </head>

  <body>
    <style>
      body {
        background-image: url("/photo1.jpeg");
      }
    </style>

    <form
      method="POST"
      action="connection.php"
      onsubmit="return formValidation()"
    >

    
    <header class="header">
        <div class="logo-container">
            <img src="/driver/assets/logo.png" alt="Logo" class="logo">
        </div>

      <p
        style="
          text-align: center;
          margin-top: 1rem;
          font-size: 32px;
          font-weight: 700;
          font-family: 'Poppins', sans-serif;
        "
      >
        Register
      </p>
      <div class="formcontainer">
        <div class="user_details">
          <label>First Name</label>
          <input type="text" id="name" name="name" /><br />
          <label>Last Name</label>
          <input type="text" id="lname" name="lname" /><br />
          <label>MobileNumber</label>
          <input type="text" id="mobileNumber" name="mobileNumber" /><br />
          <label>Email</label>
          <input type="text" id="email" name="email" /><br />
          <label>Username</label>
          <input type="text" id="userName" name="userName" /><br />
        </div>
        <div class="user_credentials">
          <label>Password</label>
          <input type="password" id="password" name="password" /><br />
          <label>Confirm Password</label>
          <input
            type="password"
            id="confirmPassword"
            name="confirmPassword"
          /><br />
          <label>ID NO</label>
          <input type="text" id="IDNO" name="IDNO" /><br />
          <label>Year of Birth (YYYY:MM:DD)</label>
          <input type="text" id="DOB" name="DOB" /><br />
          <label>Select Gender</label>
          <select name="gender" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>
      <div>
        <label>Select role</label>
        <select name="role" id="role">
          <option value="Passenger">Passenger</option>
          >
        </select>
      </div>

      <div style="text-align: center">
        <button type="submit">Register</button>
      </div>
    </form>

    <script src="./js/registration.js"></script>
  </body>
</html>
