<?php
include $_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php';

// Auto Employee Code
$emp_code_result = $conn->query("SELECT MAX(id) AS last_id FROM employees");
$last_id = $emp_code_result->fetch_assoc()['last_id'];
$new_emp_code = "EMP" . str_pad($last_id + 1, 5, "0", STR_PAD_LEFT);

// Fetch Designations
$designation_result = $conn->query("SELECT id, designation_name FROM designations");

// Fetch Branches
$branch_result = $conn->query("SELECT id, branch_name FROM branches");
?>

<!DOCTYPE html>
<html>
<head>
<title>Employee Application Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.section-title { background: #f8f9fa; padding: 10px; margin: 20px 0 10px; font-weight: 600; border-radius: 5px; }
</style>
</head>
<body class="bg-light">
<div class="container mt-4 mb-5">
<div class="card shadow">
<div class="card-header bg-dark text-white">
<h4>📋 Employee Application Form</h4>
</div>
<div class="card-body">
<form action="emp_add_save.php" method="POST" enctype="multipart/form-data">

<!-- Employee Code -->
<div class="mb-3">
<label>Employee Code</label>
<input type="text" name="emp_code" value="<?= $new_emp_code ?>" class="form-control" readonly>
</div>

<!-- Personal Details -->
<div class="section-title">👤 Personal Details</div>
<div class="row">
<?php
$fields = [
  'Employee Name'=>'emp_name',
  'Father\'s Name'=>'father_name',
  'Date of Birth'=>'dob',
  'Mobile No'=>'mobile_no',
  'WhatsApp No'=>'whatsapp_no',
  'Email'=>'email',
  'Occupation'=>'occupation',
  'Qualification'=>'qualification'
];
foreach($fields as $label=>$name){
echo "<div class='col-md-4 mb-3'><label>$label</label><input type='text' name='$name' class='form-control'></div>";
}
?>
</div>

<!-- Address -->
<div class="section-title">🏠 Address</div>
<div class="mb-3">
<label>Permanent Address</label>
<input type="text" name="permanent_address" class="form-control">
</div>
<div class="mb-3">
<label>Present Address</label>
<input type="text" name="present_address" class="form-control">
</div>

<!-- IDs -->
<div class="section-title">🪪 Identity Details</div>
<div class="row">
<?php
$id_fields = ['Aadhar No'=>'aadhar_no','PAN No'=>'pan_no','Voter ID'=>'voter_id'];
foreach($id_fields as $label=>$name){
echo "<div class='col-md-4 mb-3'><label>$label</label><input type='text' name='$name' class='form-control'></div>";
}
?>
</div>

<!-- Bank -->
<div class="section-title">🏦 Bank Details</div>
<div class="row">
<?php
$bank_fields = ['Account No'=>'account_no','IFSC'=>'ifsc','Branch Name'=>'branch_name','Account Type'=>'account_type'];
foreach($bank_fields as $label=>$name){
echo "<div class='col-md-3 mb-3'><label>$label</label><input type='text' name='$name' class='form-control'></div>";
}
?>
</div>

<!-- Nominee -->
<div class="section-title">👥 Nominee Details</div>
<div class="row">
<div class="col-md-4 mb-3"><label>Nominee Name</label><input type="text" name="nominee_name" class="form-control"></div>
<div class="col-md-4 mb-3"><label>Nominee DOB</label><input type="date" name="nominee_dob" class="form-control"></div>
<div class="col-md-4 mb-3"><label>Nominee Relation</label><input type="text" name="nominee_relation" class="form-control"></div>
</div>

<!-- Previous Work -->
<div class="section-title">🏢 Previous Experience</div>
<div class="mb-3">
<label>Applicant Last Working Agency</label>
<input type="text" name="last_agency" class="form-control">
</div>

<!-- Joining Details -->
<div class="section-title">📝 Joining Details</div>
<div class="row">
<div class="col-md-6 mb-3"><label>Joining Date</label><input type="date" name="joining_date" class="form-control"></div>
<div class="col-md-6 mb-3"><label>Branch</label>
<select name="branch_id" class="form-select">
<option value="">Select</option>
<?php while($b = $branch_result->fetch_assoc()): ?>
<option value="<?= $b['id'] ?>"><?= $b['branch_name'] ?></option>
<?php endwhile; ?>
</select>
</div>
<div class="col-md-6 mb-3"><label>Designation</label>
<select name="designation_id" class="form-select">
<option value="">Select</option>
<?php while($d = $designation_result->fetch_assoc()): ?>
<option value="<?= $d['id'] ?>"><?= $d['designation_name'] ?></option>
<?php endwhile; ?>
</select>
</div>
</div>

<!-- 2 References -->
<div class="section-title">📞 References (2 Person)</div>
<?php for($i=1;$i<=2;$i++): ?>
<h6>Reference <?= $i ?></h6>
<div class="row">
<?php
$ref_fields = ['Name'=>'name','Profession'=>'profession','Organization'=>'org','Address'=>'address','Contact No'=>'contact','Years Known'=>'years'];
foreach($ref_fields as $label=>$name){
echo "<div class='col-md-4 mb-3'><label>$label</label><input type='text' name='ref{$i}_$name' class='form-control'></div>";
}
?>
</div>
<?php endfor; ?>

<!-- CTC -->
<div class="section-title">💰 CTC Breakup</div>
<div class="row">
<?php
$ctc_fields = ['Basic'=>'basic','HRA'=>'hra','DA'=>'da','TA'=>'ta','PTAX'=>'ptax','TDS'=>'tds','ESI'=>'esi','PF'=>'pf','Company Dev Fee %'=>'dev_fee'];
foreach($ctc_fields as $label=>$name){
echo "<div class='col-md-3 mb-3'><label>$label</label><input type='number' step='0.01' name='$name' class='form-control'></div>";
}
?>
</div>

<!-- KYC & Photo Upload -->
<div class="section-title">📑 Documents</div>
<div class="row">
<?php
$docs = ['Aadhaar'=>'aadhaar_file','PAN'=>'pan_file','Bank Passbook'=>'passbook_file','Qualification Certificate'=>'qualification_file','Photo'=>'photo'];
foreach($docs as $label=>$name){
echo "<div class='col-md-4 mb-3'><label>$label</label><input type='file' name='$name' class='form-control'></div>";
}
?>
</div>

<!-- Declaration -->
<div class="section-title">📜 Declaration</div>
<div class="mb-3">
<textarea name="declaration" class="form-control" rows="3">I hereby declare that the above information is true to the best of my knowledge.</textarea>
</div>

<!-- Submit -->
<button type="submit" class="btn btn-success">➕ Add Employee</button>
<a href="emp_list.php" class="btn btn-secondary">Cancel</a>

</form>
</div>
</div>
</div>
</body>
</html>
