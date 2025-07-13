<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM branches WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $branch_name = $_POST['branch_name'];
    $branch_address = $_POST['branch_address'];
    $mobile_no = $_POST['mobile_no'];
    $rent_amount = $_POST['rent_amount'];

    $sql = "UPDATE branches SET 
        branch_name='$branch_name',
        branch_address='$branch_address',
        mobile_no='$mobile_no',
        rent_amount='$rent_amount'
        WHERE id='$id'";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Branch Updated!');window.location.href='branch_list.php';</script>";
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">✏️ Edit Branch</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Branch Name</label>
                    <input type="text" name="branch_name" value="<?= $row['branch_name'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Branch Address</label>
                    <textarea name="branch_address" class="form-control"><?= $row['branch_address'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile No</label>
                    <input type="text" name="mobile_no" value="<?= $row['mobile_no'] ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Rent Amount</label>
                    <input type="text" name="rent_amount" value="<?= $row['rent_amount'] ?>" class="form-control">
                </div>
                <button type="submit" name="update" class="btn btn-primary">💾 Update Branch</button>
                <a href="branch_list.php" class="btn btn-secondary">🔙 Back</a>
            </form>
        </div>
    </div>
</div>
