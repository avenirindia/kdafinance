<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(!isset($_GET['id'])) {
    $_SESSION['error'] = "Invalid request!";
    header("Location: designation_list.php");
    exit();
}

$id = $_GET['id'];

// Check exists
$check = mysqli_query($conn, "SELECT * FROM designations WHERE id=$id");
if(mysqli_num_rows($check) == 0) {
    $_SESSION['error'] = "Designation not found!";
    header("Location: designation_list.php");
    exit();
}

// Delete
$result = mysqli_query($conn, "DELETE FROM designations WHERE id=$id");

if($result) {
    $_SESSION['success'] = "✅ Designation deleted successfully!";
} else {
    $_SESSION['error'] = "❌ Failed to delete!";
}

header("Location: designation_list.php");
exit();
?>
