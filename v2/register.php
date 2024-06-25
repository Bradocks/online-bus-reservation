<!DOCTYPE html>
<html>

<head>
    <title>User Account Registration</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '/includes/db.php';

        $name = $_POST['name'];
        $lname = $_POST['lname'];
        $mobile_number = $_POST['mobile_number'];
        $email = $_POST['email'];
        $user_name = $_POST['user_name'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $id_no = $_POST['id_no'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];

        // Insert user into database
        $sql = "INSERT INTO user (name, lname, mobile_number, email, user_name, password, id_no, dob, gender)
                VALUES ('$name', '$lname', '$mobile_number', '$email', '$user_name', '$password', '$id_no', '$dob', '$gender')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registration successful!'); window.location.href='/login.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form method="POST" action="register.php" onsubmit="return formValidation()">
        <p class="text-center mt-4" style="font-size: 32px; font-weight: 700; font-family: 'Poppins', sans-serif;">Register</p>
        </header>
        <div class="container">
            <div class="user_details">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" required>

                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" id="mobile_number" name="mobile_number" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="user_name">Username</label>
                    <input type="text" id="user_name" name="user_name" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>

                    <label for="id_no">ID Number</label>
                    <input type="text" id="id_no" name="id_no" required>

                    <label for="dob">Date of Birth</label>
                    <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy"required>

                    <label for="gender">Select Gender</label>
                    <select name="gender" id="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        </select>
                </div>
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>

    <script>
        function formValidation() {
            let name = document.getElementById('name').value.trim();
            let lname = document.getElementById('lname').value.trim();
            let mobile_number = document.getElementById('mobile_number').value.trim();
            let email = document.getElementById('email').value.trim();
            let user_name = document.getElementById('user_name').value.trim();
            let password = document.getElementById('password').value.trim();
            let confirm_password = document.getElementById('confirm_password').value.trim();
            let id_no = document.getElementById('id_no').value.trim();
            let dob = document.getElementById('dob').value.trim();
            let gender = document.getElementById('gender').value;

            let errors = [];

            if (!name) errors.push("First name is required.");
            if (!lname) errors.push("Last name is required.");
            if (!mobile_number) errors.push("Mobile number is required.");
            if (!email.includes('@')) errors.push("Valid email is required.");
            if (!user_name) errors.push("Username is required.");
            if (!password) errors.push("Password is required.");
            if (password !== confirm_password) errors.push("Passwords do not match.");
            if (id_no.length !== 8) errors.push("ID number must be 8 digits.");
            if (!dob) errors.push("Date of birth is required.");
            if (!gender) errors.push("Gender is required.");

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }

            let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>