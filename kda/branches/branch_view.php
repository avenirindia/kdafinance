<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id='$id'");
$row = mysqli_fetch_assoc($result);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">📄 Branch Details</div>
        <div class="card-body">
            <h5>Branch Code: <?= $row['branch_code'] ?></h5>
            <p><strong>Name:</strong> <?= $row['branch_name'] ?></p>
            <p><strong>Address:</strong> <?= $row['branch_address'] ?>, <?= $row['ps'] ?>, <?= $row['district'] ?>, <?= $row['state'] ?>, <?= $row['pin_code'] ?></p>
            <p><strong>Opening Date:</strong> <?= $row['opening_date'] ?></p>
            <p><strong>Mobile:</strong> <?= $row['mobile_no'] ?></p>
            <p><strong>Landlord:</strong> <?= $row['landlord_name'] ?> (<?= $row['father_name'] ?>)</p>
            <p><strong>Land Details:</strong> <?= $row['land_details'] ?></p>
            <p><strong>Rent:</strong> ₹<?= $row['rent_amount'] ?> | Advance ₹<?= $row['rent_advance'] ?></p>
            <p><strong>Electricity Price:</strong> ₹<?= $row['electricity_unit_price'] ?> | Start Unit: <?= $row['start_unit'] ?></p>

            <a href="branch_list.php" class="btn btn-secondary">🔙 Back</a>
        </div>
    </div>
</div>
