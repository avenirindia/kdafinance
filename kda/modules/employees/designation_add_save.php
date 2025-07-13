<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Check if form submitted
if(isset($_POST['designation_name'])) {
    $designation_name = mysqli_real_escape_string($conn, $_POST['designation_name']);

    // Validation: empty check
    if(empty($designation_name)) {
        $_SESSION['error'] = "Designation name cannot be empty!";
        header("Location: designation_add.php");
        exit();
    }

    // Duplicate check
    $check = mysqli_query($conn, "SELECT * FROM designations WHERE designation_name='$designation_name'");
    if(mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Designation name already exists!";
        header("Location: designation_add.php");
        exit();
    }

    // Insert query
    $result = mysqli_query($conn, "INSERT INTO designations (designation_name) VALUES ('$designation_name')");

    if($result) {
        $_SESSION['success'] = "✅ Designation added successfully!";
        header("Location: designation_list.php");
        exit();
    } else {
        $_SESSION['error'] = "❌ Something went wrong!";
        header("Location: designation_add.php");
        exit();
    }

} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: designation_add.php");
    exit();
}
?>
