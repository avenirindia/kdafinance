<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(isset($_POST['id']) && isset($_POST['permission_name'])) {
  $id = $_POST['id'];
  $name = mysqli_real_escape_string($conn, $_POST['permission_name']);

  if(empty($name)) {
    $_SESSION['error'] = "Permission name cannot be empty!";
    header("Location: permission_edit.php?id=$id");
    exit();
  }

  $check = mysqli_query($conn, "SELECT * FROM permissions WHERE permission_name='$name' AND id!=$id");
  if(mysqli_num_rows($check) > 0) {
    $_SESSION['error'] = "Permission already exists!";
    header("Location: permission_edit.php?id=$id");
    exit();
  }

  $update = mysqli_query($conn, "UPDATE permissions SET permission_name='$name' WHERE id=$id");
  if($update) {
    $_SESSION['success'] = "Permission updated successfully!";
  } else {
    $_SESSION['error'] = "Something went wrong!";
  }
  header("Location: permission_list.php");
  exit();

} else {
  $_SESSION['error'] = "Invalid request!";
  header("Location: permission_list.php");
  exit();
}
?>
