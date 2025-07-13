<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}
?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$result = mysqli_query($conn, "SELECT * FROM departments ORDER BY id ASC");
?>
<div class="container mt-4">
    <h4>Department List</h4>
    <a href="department_add.php" class="btn btn-primary mb-2">➕ Add Department</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Department</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['department_name']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="department_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="department_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this department?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
