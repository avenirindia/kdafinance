<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if(isset($_POST['designation_id']) && isset($_POST['designation_name'])) {
    $id = $_POST['designation_id'];
    $designation_name = mysqli_real_escape_string($conn, $_POST['designation_name']);

    if(empty($designation_name)) {
        $_SESSION['error'] = "Designation name cannot be empty!";
        header("Location: designation_edit.php?id=$id");
        exit();
    }

    // Duplicate check excluding current
    $check = mysqli_query($conn, "SELECT * FROM designations WHERE designation_name='$designation_name' AND id!=$id");
    if(mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Designation name already exists!";
        header("Location: designation_edit.php?id=$id");
        exit();
    }

    // Update
    $result = mysqli_query($conn, "UPDATE designations SET designation_name='$designation_name' WHERE id=$id");

    if($result) {
        $_SESSION['success'] = "✅ Designation updated successfully!";
        header("Location: designation_list.php");
        exit();
    } else {
        $_SESSION['error'] = "❌ Something went wrong!";
        header("Location: designation_edit.php?id=$id");
        exit();
    }

} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: designation_list.php");
    exit();
}
?>
