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

    mysqli_query($conn, $sql);
    echo "<script>alert('Branch Added Successfully!');window.location.href='branch_list.php';</script>";
}
?>
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Styling -->
<style>
    body {
        background: #f4f7fa;
    }
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.08);
    }
    .card-header {
        background: #3f51b5;
        color: #fff;
        padding: 20px;
        font-size: 20px;
        font-weight: 600;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .form-label {
        font-weight: 600;
    }
    .section-title {
        font-size: 18px;
        color: #3f51b5;
        margin-top: 20px;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
    }
    .btn-primary {
        background-color: #00897b;
        border: none;
        font-weight: 600;
    }
    .btn-primary:hover {
        background-color: #00695c;
    }
</style>

<div class="container my-5">
    <div class="card">
        <div class="card-header">➕ Add New Branch</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="section-title">📍 Branch Details</div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Branch Code</label>
                        <input type="text" name="branch_code" value="<?= $branch_code ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Branch Name</label>
                        <input type="text" name="branch_name" class="form-control" required>
                    </div>
                </div>

                <label class="form-label">Branch Address</label>
                <textarea name="branch_address" class="form-control mb-3" required></textarea>

                <div class="row mb-3">
                    <div class="col-md-3"><label class="form-label">PS</label><input type="text" name="ps" class="form-control"></div>
                    <div class="col-md-3"><label class="form-label">District</label><input type="text" name="district" class="form-control"></div>
                    <div class="col-md-3"><label class="form-label">State</label><input type="text" name="state" class="form-control"></div>
                    <div class="col-md-3"><label class="form-label">PIN</label><input type="text" name="pin_code" class="form-control"></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4"><label class="form-label">Latitude</label><input type="text" name="latitude" id="lat" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Longitude</label><input type="text" name="longitude" id="lng" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Opening Date</label><input type="date" name="opening_date" class="form-control" required></div>
                </div>

                <div id="map" style="height:300px;border-radius:8px; margin-bottom:20px;"></div>

                <div class="section-title">🏠 Landlord & Rent</div>
                <div class="row mb-3">
                    <div class="col-md-4"><label class="form-label">Landlord Name</label><input type="text" name="landlord_name" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Father's Name</label><input type="text" name="father_name" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Mobile No</label><input type="text" name="mobile_no" class="form-control"></div>
                </div>

                <div class="mb-3"><label class="form-label">Landlord Address</label><textarea name="landlord_address" class="form-control"></textarea></div>
                <div class="mb-3"><label class="form-label">Land Details</label><textarea name="land_details" class="form-control"></textarea></div>

                <div class="row mb-3">
                    <div class="col-md-3"><label class="form-label">Rent Amount</label><input type="text" name="rent_amount" class="form-control"></div>
                    <div class="col-md-3"><label class="form-label">Advance Amount</label><input type="text" name="rent_advance" class="form-control"></div>
                    <div class="col-md-3"><label class="form-label">Electricity Unit Price</label><input type="text" name="electricity_unit_price" class="form-control"></div>
                    <div class="col-md-3"><label class="form-label">Start Unit</label><input type="text" name="start_unit" class="form-control"></div>
                </div>

                <div class="section-title">📂 Upload Documents</div>
                <div class="row mb-3">
                    <div class="col-md-4"><label class="form-label">Aadhaar Copy</label><input type="file" name="aadhaar_copy" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">PAN Copy</label><input type="file" name="pan_copy" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Passbook Copy</label><input type="file" name="passbook_copy" class="form-control"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><label class="form-label">Tax Receipt</label><input type="file" name="tax_receipt" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Agreement Copy</label><input type="file" name="agreement_copy" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Police Letter</label><input type="file" name="police_letter" class="form-control"></div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100 py-2">➕ Save Branch</button>
            </form>
        </div>
    </div>
</div>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIV5ATUvb1UVaDw32lhTZqbn2v51qEMkU"></script>
<script>
    var map;
    function initMap() {
        var initialLatLng = { lat: 22.5726, lng: 88.3639 };
        map = new google.maps.Map(document.getElementById('map'), {
            center: initialLatLng,
            zoom: 12
        });
        var marker = new google.maps.Marker({
            position: initialLatLng,
            map: map,
            draggable: true
        });

        google.maps.event.addListener(marker, 'dragend', function(event){
            document.getElementById("lat").value = event.latLng.lat();
            document.getElementById("lng").value = event.latLng.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initMap);
</script>
