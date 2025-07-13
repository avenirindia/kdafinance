<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(isset($_POST['permission_name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['permission_name']);

    if(empty($name)) {
        $_SESSION['error'] = "Permission name cannot be empty!";
        header("Location: permission_add.php");
        exit();
    }

    $check = mysqli_query($conn, "SELECT * FROM permissions WHERE permission_name='$name'");
    if(mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Permission already exists!";
        header("Location: permission_add.php");
        exit();
    }

    $insert = mysqli_query($conn, "INSERT INTO permissions (permission_name) VALUES ('$name')");
    if($insert) {
        $_SESSION['success'] = "Permission added successfully!";
    } else {
        $_SESSION['error'] = "Something went wrong!";
    }
    header("Location: permission_list.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: permission_add.php");
    exit();
}
?>
