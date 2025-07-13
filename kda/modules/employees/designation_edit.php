<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID missing!</div>";
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM designations WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(!$row) {
    echo "<div class='alert alert-danger'>Designation not found!</div>";
    exit();
}

if(isset($_POST['update'])) {
    $designation_name = $_POST['designation_name'];
    mysqli_query($conn, "UPDATE designations SET designation_name='$designation_name' WHERE id=$id");
    header("Location: designation_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Designation</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h4>✏️ Edit Designation</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Designation Name</label>
      <input type="text" name="designation_name" value="<?php echo $row['designation_name']; ?>" class="form-control" required>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update Designation</button>
    <a href="designation_list.php" class="btn btn-secondary">← Back to List</a>
  </form>
</div>

</body>
</html>
