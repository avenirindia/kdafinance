<?php
if(isset($_SESSION['error'])) {
  echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
  unset($_SESSION['error']);
}
if(isset($_SESSION['success'])) {
  echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
  unset($_SESSION['success']);
}
?>
<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Fetch designations
$result = mysqli_query($conn, "SELECT * FROM designations");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Designation</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h4>➕ Add New Designation</h4>
    <form method="POST" action="designation_add_save.php">
        <div class="mb-3">
            <label>Designation Name</label>
            <input type="text" name="designation_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Designation</button>
        <a href="designation_list.php" class="btn btn-secondary">← Back to List</a>
    </form>
</div>

</body>
</html>
