<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Fetch designations & permissions
$designations = mysqli_query($conn, "SELECT * FROM designations");
$permissions  = mysqli_query($conn, "SELECT * FROM permissions");

// Assign permission
if (isset($_POST['assign'])) {
    $designation_id = $_POST['designation_id'];
    $selected_permissions = $_POST['permissions'];

    // Old permission delete
    mysqli_query($conn, "DELETE FROM role_permissions WHERE designation_id=$designation_id");

    // New permission insert
    foreach ($selected_permissions as $pid) {
        mysqli_query($conn, "INSERT INTO role_permissions (designation_id, permission_id) VALUES ($designation_id, $pid)");
    }

    $message = "✅ Permissions assigned successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Role Permission Manage</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h4>🎛️ Role-Permission Management</h4>

  <?php if (isset($message)) { echo "<div class='alert alert-success'>$message</div>"; } ?>

  <form method="POST">
    <div class="mb-3">
      <label>Designation</label>
      <select name="designation_id" class="form-control" required>
        <option value="">Select Designation</option>
        <?php while($d = mysqli_fetch_assoc($designations)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['designation_name']; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Permissions</label>
      <?php while($p = mysqli_fetch_assoc($permissions)) { ?>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="perm<?php echo $p['id']; ?>">
        <label class="form-check-label" for="perm<?php echo $p['id']; ?>"><?php echo $p['permission_name']; ?></label>
      </div>
      <?php } ?>
    </div>

    <button type="submit" name="assign" class="btn btn-primary">Save Permissions</button>
  </form>

  <a href="../admin/dashboard.php" class="btn btn-secondary mt-3">← Back to Dashboard</a>
</div>

</body>
</html>
