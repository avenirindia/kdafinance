<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

function generateBranchCode($conn) {
    $prefix = "BR" . date("Ym");
    $sql = "SELECT branch_code FROM branches WHERE branch_code LIKE '$prefix%' ORDER BY id DESC LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $last = mysqli_fetch_assoc($res)['branch_code'];
        $num = (int)substr($last, 8) + 1;
    } else {
        $num = 100;
    }
    return $prefix . $num;
}

$branch_code = generateBranchCode($conn);

if(isset($_POST['submit'])){
    $branch_name = $_POST['branch_name'];
    $branch_address = $_POST['branch_address'];
    $ps = $_POST['ps'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $pin_code = $_POST['pin_code'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $opening_date = $_POST['opening_date'];

    $landlord_name = $_POST['landlord_name'];
    $father_name = $_POST['father_name'];
    $landlord_address = $_POST['landlord_address'];
    $mobile_no = $_POST['mobile_no'];
    $land_details = $_POST['land_details'];
    $rent_amount = $_POST['rent_amount'];
    $rent_advance = $_POST['rent_advance'];
    $electricity_unit_price = $_POST['electricity_unit_price'];
    $start_unit = $_POST['start_unit'];

    $upload_dir = $_SERVER['DOCUMENT_ROOT']."/Project/kda/uploads/branch_documents/";
    if(!is_dir($upload_dir)){ mkdir($upload_dir,0777,true); }

    $aadhaar_copy = $_FILES['aadhaar_copy']['name'];
    move_uploaded_file($_FILES['aadhaar_copy']['tmp_name'], $upload_dir.$aadhaar_copy);

    $pan_copy = $_FILES['pan_copy']['name'];
    move_uploaded_file($_FILES['pan_copy']['tmp_name'], $upload_dir.$pan_copy);

    $passbook_copy = $_FILES['passbook_copy']['name'];
    move_uploaded_file($_FILES['passbook_copy']['tmp_name'], $upload_dir.$passbook_copy);

    $tax_receipt = $_FILES['tax_receipt']['name'];
    move_uploaded_file($_FILES['tax_receipt']['tmp_name'], $upload_dir.$tax_receipt);

    $agreement_copy = $_FILES['agreement_copy']['name'];
    move_uploaded_file($_FILES['agreement_copy']['tmp_name'], $upload_dir.$agreement_copy);

    $police_letter = $_FILES['police_letter']['name'];
    move_uploaded_file($_FILES['police_letter']['tmp_name'], $upload_dir.$police_letter);

    $sql = "INSERT INTO branches 
    (branch_code, branch_name, branch_address, ps, district, state, pin_code, latitude, longitude, opening_date,
    landlord_name, father_name, landlord_address, mobile_no, land_details, rent_amount, rent_advance,
    electricity_unit_price, start_unit, aadhaar_copy, pan_copy, passbook_copy, tax_receipt, agreement_copy, police_letter) 
    VALUES 
    ('$branch_code','$branch_name','$branch_address','$ps','$district','$state','$pin_code','$latitude','$longitude','$opening_date',
    '$landlord_name','$father_name','$landlord_address','$mobile_no','$land_details','$rent_amount','$rent_advance',
    '$electricity_unit_price','$start_unit','$aadhaar_copy','$pan_copy','$passbook_copy','$tax_receipt','$agreement_copy','$police_letter')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Branch Added Successfully!');window.location.href='branch_list.php';</script>";
    }else{
        echo "<script>alert('Error Occurred while saving branch.');window.history.back();</script>";
    }
}
?>
