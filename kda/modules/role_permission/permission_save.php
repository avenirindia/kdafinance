<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');

if(!isset($_POST['designation_id'])){
  die("Designation ID missing.");
}

$designation_id = $_POST['designation_id'];
$permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

mysqli_query($conn, "DELETE FROM role_permissions WHERE designation_id='$designation_id'");

foreach($permissions as $p) {
  mysqli_query($conn, "INSERT INTO role_permissions (designation_id, permission_id) VALUES ('$designation_id', '$p')");
}

header("Location: role_list.php?msg=Permissions updated successfully");
exit;
?>
