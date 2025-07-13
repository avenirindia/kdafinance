<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');
include(BASE_PATH . '/includes/header.php');
?>

<div class="container mt-5">
  <h4 class="mb-4">Add New Designation</h4>

  <form action="role_add_save.php" method="post">
    <div class="mb-3">
      <label for="designation_name" class="form-label">Designation Name</label>
      <input type="text" class="form-control" id="designation_name" name="designation_name" required>
    </div>

    <button type="submit" class="btn btn-success">Save Designation</button>
    <a href="role_list.php" class="btn btn-secondary">Back to List</a>
  </form>
</div>

<?php include(BASE_PATH . '/includes/footer.php'); ?>
