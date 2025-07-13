<?php
include $_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php';

$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM employees WHERE id='$id'");
if($result->num_rows == 0){ die("Employee not found."); }
$emp = $result->fetch_assoc();

// Fetch Designations
$designation_result = $conn->query("SELECT id, designation_name FROM designations");

// Fetch Branches
$branch_result = $conn->query("SELECT id, branch_name FROM branches");
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Employee</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
<div class="card shadow">
<div class="card-header bg-dark text-white">
<h4>✏️ Edit Employee: <?= $emp['emp_name'] ?></h4>
</div>
<div class="card-body">
<form action="emp_update.php" method="POST">
<input type="hidden" name="id" value="<?= $emp['id'] ?>">

<div class="mb-3">
<label>Employee Name</label>
<input type="text" name="emp_name" value="<?= $emp['emp_name'] ?>" class="form-control" required>
</div>

<div class="mb-3">
<label>Mobile No</label>
<input type="text" name="mobile_no" value="<?= $emp['mobile_no'] ?>" class="form-control" required>
</div>

<div class="mb-3">
<label>Designation</label>
<select name="designation_id" class="form-select" required>
<?php while($d = $designation_result->fetch_assoc()): ?>
<option value="<?= $d['id'] ?>" <?= ($d['id']==$emp['designation_id'])?'selected':'' ?>><?= $d['designation_name'] ?></option>
<?php endwhile; ?>
</select>
</div>

<div class="mb-3">
<label>Branch</label>
<select name="branch_id" class="form-select" required>
<?php while($b = $branch_result->fetch_assoc()): ?>
<option value="<?= $b['id'] ?>" <?= ($b['id']==$emp['branch_id'])?'selected':'' ?>><?= $b['branch_name'] ?></option>
<?php endwhile; ?>
</select>
</div>

<button type="submit" class="btn btn-success">💾 Update</button>
<a href="emp_list.php" class="btn btn-secondary">Cancel</a>
</form>
</div>
</div>
</div>
</body>
</html>
