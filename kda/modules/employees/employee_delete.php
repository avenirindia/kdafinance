<?php
include $_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM employees WHERE id='$id'");
header("Location: emp_list.php?msg=Deleted");
?>
