<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}
?>
<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Handle form submit
if(isset($_POST['add'])){
    $message = $_POST['message'];
    $status = $_POST['status'];

    mysqli_query($conn, "INSERT INTO notifications (message, status) VALUES ('$message', '$status')");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Notification</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h4>Add New Notification</h4>
    <form method="POST">
        <div class="mb-3">
            <label>Notification Message</label>
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" name="add" class="btn btn-danger">Add Notification</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body><body>
<!-- Top Info -->
<div>📧 Email | 📞 Contact | 🌐 Website</div>

<!-- Notification Bar -->
<div><marquee>Important Notice</marquee></div>

<!-- Dashboard Cards & Sidebar -->
...
</body>

</html>
