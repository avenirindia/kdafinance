<?php include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/includes/header.php'); ?>
<?php
if (isset($conn)) {
  $query = mysqli_query($conn, "SELECT footer_info FROM company_info LIMIT 1");
  $row = mysqli_fetch_assoc($query);
}
?>
<footer class="bg-primary text-white text-center py-2 mt-4">
  <small>
    <?php
      echo isset($row['footer_info']) ? $row['footer_info'] : '© 2025 KDA Microfinance ERP';
    ?>
    | Developed by <?php echo DEVELOPED_BY; ?>
    | Version <?php echo SYSTEM_VERSION; ?>
  </small>
</footer>
