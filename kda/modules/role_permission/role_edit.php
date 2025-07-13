<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');
include(BASE_PATH . '/includes/header.php');

// Check if id is provided
if(!isset($_GET['id'])){
  die("Designation ID not provided.");
}

$designation_id = $_GET['id'];

// Fetch current designation data
$result = mysqli_query($conn, "SELECT * FROM designations WHERE id='$designation_id'");
if(mysqli_num_rows($result) == 0){
  die("Designation not found.");
}
$data = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">
  <h4 class="mb-4">Edit Designation</h4>

  <form action="role_edit_save.php" method="post">
    <input type="hidden" name="designation_id" value="<?php echo $designation_id; ?>">

    <div class="mb-3">
      <label for="designation_name" class="form-label">Designation Name</label>
      <input type="text" class="form-control" id="designation_name" name="designation_name" value="<?php echo htmlspecialchars($data['designation_name']); ?>" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="role_list.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php include(BASE_PATH . '/includes/footer.php'); ?>
