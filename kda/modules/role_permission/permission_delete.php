<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(!isset($_GET['id'])) {
  $_SESSION['error'] = "Invalid request!";
  header("Location: permission_list.php");
  exit();
}

$id = $_GET['id'];
$res = mysqli_query($conn, "DELETE FROM permissions WHERE id=$id");

if($res) {
  $_SESSION['success'] = "Permission deleted successfully!";
} else {
  $_SESSION['error'] = "Failed to delete!";
}

header("Location: permission_list.php");
exit();
?>
