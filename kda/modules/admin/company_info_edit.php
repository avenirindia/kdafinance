<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
  $website = mysqli_real_escape_string($conn, $_POST['website']);
  $about = mysqli_real_escape_string($conn, $_POST['about']);
  $footer_info = mysqli_real_escape_string($conn, $_POST['footer_info']);

  // Logo Upload
  if (!empty($_FILES['logo']['name'])) {
      $logoName = time().'_'.$_FILES['logo']['name'];
      $targetPath = $_SERVER['DOCUMENT_ROOT'].'/Project/kda/uploads/company/'.$logoName;
      move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath);
  } else {
      $logoName = isset($_POST['old_logo']) ? $_POST['old_logo'] : '';
  }

  // Check data exists
  $check = mysqli_query($conn, "SELECT * FROM company_info");
  if(mysqli_num_rows($check) > 0){
    // Update existing info
    $update = mysqli_query($conn, "UPDATE company_info SET 
      email='$email', 
      contact_no='$contact_no', 
      website='$website', 
      logo='$logoName', 
      about='$about', 
      footer_info='$footer_info' 
      WHERE id=1");

    if($update){
      header("Location: company_info_edit.php?msg=updated");
      exit();
    } else {
      header("Location: company_info_edit.php?msg=error");
      exit();
    }

  } else {
    // Insert new info if no record exists
    $insert = mysqli_query($conn, "INSERT INTO company_info 
      (email, contact_no, website, logo, about, footer_info) 
      VALUES 
      ('$email','$contact_no','$website','$logoName','$about','$footer_info')");

    if($insert){
      header("Location: company_info_edit.php?msg=added");
      exit();
    } else {
      header("Location: company_info_edit.php?msg=error");
      exit();
    }
  }

} else {
  header("Location: company_info_edit.php");
  exit();
}
?>
