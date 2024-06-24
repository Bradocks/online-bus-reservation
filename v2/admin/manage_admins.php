<?php
ob_start(); // Start output buffering
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();
check_role('admin');

// Handle form submission for create and update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];
    $role = 'admin';
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $id_no = $_POST['id_no'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $staff_id = $_POST['staff_id'];

    if ($id) {
        // Update existing user
        $sql = "UPDATE user SET `name`='$name', mobile_number='$mobile_number', email='$email', `role`='$role', `user_name`='$user_name', id_no='$id_no', dob='$dob', gender='$gender', staff_id='$staff_id' WHERE id=$id";
        echo "Admin updated successfully.";
    } else {
        // Create new user
        $sql = "INSERT INTO user (`name`, mobile_number, email, `role`, `user_name`, `password`, id_no, dob, gender, staff_id) VALUES ('$name', '$mobile_number', '$email', '$role', '$user_name', '$password', '$id_no', '$dob', '$gender', '$staff_id')";
    }
    $conn->query($sql);
    header('Location: /admin/manage_admins.php');
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM user WHERE id=$id";
    $conn->query($sql);
    header('Location: /admin/manage_admins.php');
    exit();
}

// Fetch user for update
$user_to_update = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT id, `name`, mobile_number, email, `role`, `user_name`, `password`, id_no, dob, gender, staff_id FROM user WHERE id=$id";
    $result_edit = $conn->query($sql);
    $user_to_update = $result_edit->fetch_assoc();
}

// Fetch all users
$sql = "SELECT id, `name`, mobile_number, email, `role`, `user_name`, `password`, id_no, dob, gender, staff_id FROM user WHERE `role` = 'admin'";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header"><?php echo $user_to_update ? 'Update User' : 'Create User'; ?></div>
        <div class="card-body">
            <form method="POST" action="/admin/manage_admins.php?edit=<?php echo $user_to_update['id']; ?>">
                <input type="hidden" name="id" value="<?php echo $user_to_update ? $user_to_update['id'] : ''; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $user_to_update ? $user_to_update['name'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_number" value="<?php echo $user_to_update ? $user_to_update['mobile_number'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user_to_update ? $user_to_update['email'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input type="text" class="form-control" name="role" disabled value="<?php echo $user_to_update ? $user_to_update['role'] : 'admin'; ?>" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="user_name" value="<?php echo $user_to_update ? $user_to_update['user_name'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>ID No</label>
                    <input type="text" class="form-control" name="id_no" value="<?php echo $user_to_update ? $user_to_update['id_no'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="text" class="form-control" placeholder="DD/MM/YYYY" name="dob" value="<?php echo $user_to_update ? $user_to_update['dob'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" class="form-control" name="gender" value="<?php echo $user_to_update ? $user_to_update['gender'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Staff ID</label>
                    <input type="text" class="form-control" name="staff_id" value="<?php echo $user_to_update ? $user_to_update['staff_id'] : ''; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary"><?php echo $user_to_update ? 'Update' : 'Create'; ?></button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Admin List</div>
        <div class="card-body" style="overflow-x: scroll;">
            <table class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>ID No</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Staff ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['mobile_number']}</td>
                                    <td>{$row['email']}</td>
                                  
                                    <td>{$row['user_name']}</td>
                                    
                                    <td>{$row['id_no']}</td>
                                    <td>{$row['dob']}</td>
                                    <td>{$row['gender']}</td>
                                    <td>{$row['staff_id']}</td>
                                    <td>
                                        <a href='/admin/manage_admins.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='javascript:void(0);' onclick='confirmDelete({$row['id']})' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No Admins available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = '/admin/manage_admins.php?delete=' + id;
        }
    }
</script>




<?php include '../includes/footer.php'; ?>