<?php
include('../../config/constants.php');
include(BASE_PATH . '/config/db_connect.php');

if(!isset($_POST['designation_name']) || empty($_POST['designation_name'])){
  die("Designation Name missing.");
}

$designation_name = mysqli_real_escape_string($conn, $_POST['designation_name']);

mysqli_query($conn, "INSERT INTO designations (designation_name) VALUES ('$designation_name')");

header("Location: role_list.php?msg=Designation added successfully");
exit;
?>
