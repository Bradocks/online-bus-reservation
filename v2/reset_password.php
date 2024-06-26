<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container mt-4">
        <div class="card" style="max-width: 600px; margin: auto;">
            <div class="card-body">
                <form method="POST" action="reset_password.php">
                    <p class="text-center mt-4" style="font-size: 32px; font-weight: 700; font-family: 'Poppins', sans-serif;">Reset Password</p>
                    
                    <div class="form-group">
                        <label for="user_name">Username</label>
                        <input type="text" id="user_name" name="user_name" required placeholder="snow">
                    </div>

                    <div class="form-group">
                        <label for="new_password">Enter New Password</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '../includes/db.php';

        $user_name = $_POST['user_name'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Server-side validation
        $errors = [];

        if (empty($user_name)) {
            $errors[] = "Username is required.";
        }

        if (empty($new_password)) {
            $errors[] = "New password is required.";
        } elseif (strlen($new_password) < 8 || !preg_match('/[A-Z]/', $new_password) || !preg_match('/[a-z]/', $new_password) || !preg_match('/[0-9]/', $new_password) || !preg_match('/[@$!%*?&]/', $new_password)) {
            $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        }

        if (empty($confirm_password)) {
            $errors[] = "Confirm password is required.";
        } elseif ($new_password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        }

        if (count($errors) > 0) {
            echo "<div class='container'>";
            foreach ($errors as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
            echo "</div>";
        } else {
            // Update password in database
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            $sql = "UPDATE user SET password='$hashed_password' WHERE user_name='$user_name'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Password reset successful!'); window.location.href='/user/login.php';</script>";
            } else {
                echo "<div class='container'><p style='color: red;'>Error updating record: " . $conn->error . "</p></div>";
            }

            $conn->close();
        }
    }
    ?>
</body>
</html>
