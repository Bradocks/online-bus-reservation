<?php
ob_start(); // Start output buffering
include '../includes/db.php';
include '../includes/auth.php';
include '../includes/header.php';
check_auth();

// Handle form submission for creating feedback
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $source = $_SESSION['role']; 
    $feedback = $_POST['feedback'];
    $date_time = date('Y-m-d H:i:s');

    // Insert feedback into database
    $sql = "INSERT INTO feedback (date_time, source, feedback) VALUES ('$date_time', '$source', '$feedback')";
    $conn->query($sql);
    header('Location: /index.php');
    exit();
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">Submit Feedback</div>
        <div class="card-body">
            <form method="POST" action="/passenger/feedback.php">
                <div class="form-group">
                    <label>Feedback</label>
                    <textarea class="form-control" name="feedback" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
