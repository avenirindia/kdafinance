<?php
include $_SERVER['DOCUMENT_ROOT'].'/project/kda/config/db.php';

$result = $conn->query("SELECT e.id, e.emp_code, e.emp_name, e.mobile_no, b.branch_name, d.designation_name 
FROM employees e 
LEFT JOIN branches b ON e.branch_id = b.id 
LEFT JOIN designations d ON e.designation_id = d.id 
ORDER BY e.id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Employee List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow">
<div class="card-header bg-dark text-white d-flex justify-content-between">
<h4>📋 Employee List</h4>
<a href="emp_add.php" class="btn btn-success btn-sm">➕ Add New Employee</a>
</div>
<div class="card-body">
<table class="table table-bordered table-hover">
<thead class="table-dark">
<tr>
<th>Code</th>
<th>Name</th>
<th>Mobile</th>
<th>Branch</th>
<th>Designation</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['emp_code'] ?></td>
<td><?= $row['emp_name'] ?></td>
<td><?= $row['mobile_no'] ?></td>
<td><?= $row['branch_name'] ?></td>
<td><?= $row['designation_name'] ?></td>
<td>
<a href="emp_edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">✏️ Edit</a>
<a href="emp_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">🗑️ Delete</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
</body>
</html>
