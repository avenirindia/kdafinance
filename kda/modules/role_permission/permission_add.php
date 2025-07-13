<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Permission</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h4>➕ Add Permission</h4>

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

  <form method="POST" action="permission_add_save.php">
    <div class="mb-3">
      <label>Permission Name</label>
      <input type="text" name="permission_name" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="permission_list.php" class="btn btn-secondary">Back to List</a>
  </form>
</div>

</body>
</html>
