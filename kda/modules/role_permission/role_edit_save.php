<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');

// Check if data provided
if(!isset($_POST['designation_id']) || !isset($_POST['designation_name'])){
  die("Required data missing.");
}

$designation_id = $_POST['designation_id'];
$designation_name = mysqli_real_escape_string($conn, $_POST['designation_name']);

// Update query
mysqli_query($conn, "UPDATE designations SET designation_name='$designation_name' WHERE id='$designation_id'");

// Redirect
header("Location: role_list.php?msg=Designation updated successfully");
exit;
?>
