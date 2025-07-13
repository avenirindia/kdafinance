<?php
include $_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php';

$id = $_POST['id'];
$emp_name = $_POST['emp_name'];
$mobile_no = $_POST['mobile_no'];
$designation_id = $_POST['designation_id'];
$branch_id = $_POST['branch_id'];

$conn->query("UPDATE employees SET emp_name='$emp_name', mobile_no='$mobile_no', designation_id='$designation_id', branch_id='$branch_id' WHERE id='$id'");
header("Location: emp_list.php?msg=Updated");
?>
