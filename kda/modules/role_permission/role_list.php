<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');
include(BASE_PATH . '/includes/header.php');
?>

<div class="container mt-5">
  <h4 class="mb-4">Designation List</h4>

  <?php if(isset($_GET['msg'])) { ?>
    <div class="alert alert-success"><?php echo $_GET['msg']; ?></div>
  <?php } ?>

  <a href="role_add.php" class="btn btn-primary mb-3">+ Add New Designation</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Designation Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM designations ORDER BY id ASC");
      $sl = 1;
      while($row = mysqli_fetch_assoc($result)){
      ?>
      <tr>
        <td><?php echo $sl++; ?></td>
        <td><?php echo htmlspecialchars($row['designation_name']); ?></td>
        <td>
          <a href="permission_manage.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Manage Permissions</a>
          <a href="role_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</div>

<?php include(BASE_PATH . '/includes/footer.php'); ?>
