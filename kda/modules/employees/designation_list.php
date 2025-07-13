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

// Fetch all designations
$result = mysqli_query($conn, "SELECT * FROM designations ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Designation List</title>
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h4>📋 Designation List</h4>

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

  <a href="designation_add.php" class="btn btn-primary mb-3">➕ Add New Designation</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Designation Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sl = 1;
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$sl++."</td>";
        echo "<td>".$row['designation_name']."</td>";
        echo "<td>
                <a href='designation_edit.php?id=".$row['id']."' class='btn btn-sm btn-warning'>✏️ Edit</a>
                <a href='designation_delete.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure to delete?\")'>🗑️ Delete</a>
              </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

  <a href="../admin/dashboard.php" class="btn btn-secondary mt-3">← Back to Dashboard</a>

</div>

</body>
</html>
