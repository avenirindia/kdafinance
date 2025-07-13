<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');

// Check if id is provided
if(!isset($_GET['id'])){
  die("Designation ID not provided.");
}

$designation_id = $_GET['id'];

// Delete the designation
mysqli_query($conn, "DELETE FROM designations WHERE id='$designation_id'");

// Delete related role permissions (optional, if you want to clean up)
mysqli_query($conn, "DELETE FROM role_permissions WHERE designation_id='$designation_id'");

// Redirect back to role list
header("Location: role_list.php?msg=Designation deleted successfully");
exit;
?>
