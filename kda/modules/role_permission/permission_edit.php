<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(!isset($_GET['id'])) {
  $_SESSION['error'] = "Invalid request!";
  header("Location: permission_list.php");
  exit();
}

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM permissions WHERE id=$id");
$data = mysqli_fetch_assoc($res);

if(!$data) {
  $_SESSION['error'] = "Permission not found!";
  header("Location: permission_list.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Permission</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h4>✏️ Edit Permission</h4>

  <form method="POST" action="permission_edit_save.php">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <div class="mb-3">
      <label>Permission Name</label>
      <input type="text" name="permission_name" value="<?php echo $data['permission_name']; ?>" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="permission_list.php" class="btn btn-secondary">Back to List</a>
  </form>
</div>

</body>
</html>
