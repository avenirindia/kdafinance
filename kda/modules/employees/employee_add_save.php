<?php
include $_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php';

// Function: upload file and return path
function uploadFile($fieldName, $folder){
    if(isset($_FILES[$fieldName]) && $_FILES[$fieldName]['name'] != ''){
        $fileName = time().'_'.$_FILES[$fieldName]['name'];
        $filePath = 'uploads/'.$folder.'/'.$fileName;
        move_uploaded_file($_FILES[$fieldName]['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/project/kda/'.$filePath);
        return $filePath;
    }
    return '';
}

// Receive values safely
function post($key){
    return $_POST[$key] ?? '';
}

// Basic employee info
$emp_code       = post('emp_code');
$emp_name       = post('emp_name');
$father_name    = post('father_name');
$dob            = post('dob');
$mobile_no      = post('mobile_no');
$whatsapp_no    = post('whatsapp_no');
$email          = post('email');
$occupation     = post('occupation');
$qualification  = post('qualification');
$permanent_address = post('permanent_address');
$present_address   = post('present_address');
$aadhar_no      = post('aadhar_no');
$pan_no         = post('pan_no');
$voter_id       = post('voter_id');
$account_no     = post('account_no');
$ifsc           = post('ifsc');
$branch_name    = post('branch_name');
$account_type   = post('account_type');
$nominee_name   = post('nominee_name');
$nominee_dob    = post('nominee_dob');
$nominee_relation = post('nominee_relation');
$last_agency    = post('last_agency');
$joining_date   = post('joining_date');
$designation_id = post('designation_id');
$branch_id      = post('branch_id');

// Reference 1
$ref1_name      = post('ref1_name');
$ref1_profession= post('ref1_profession');
$ref1_org       = post('ref1_org');
$ref1_address   = post('ref1_address');
$ref1_contact   = post('ref1_contact');
$ref1_years     = post('ref1_years');

// Reference 2
$ref2_name      = post('ref2_name');
$ref2_profession= post('ref2_profession');
$ref2_org       = post('ref2_org');
$ref2_address   = post('ref2_address');
$ref2_contact   = post('ref2_contact');
$ref2_years     = post('ref2_years');

// CTC
$basic      = post('basic');
$hra        = post('hra');
$da         = post('da');
$ta         = post('ta');
$ptax       = post('ptax');
$tds        = post('tds');
$esi        = post('esi');
$pf         = post('pf');
$dev_fee    = post('dev_fee');

// Declaration
$declaration = post('declaration');

// Files
$aadhaar_file       = uploadFile('aadhaar_file', 'employee_docs');
$pan_file           = uploadFile('pan_file', 'employee_docs');
$passbook_file      = uploadFile('passbook_file', 'employee_docs');
$qualification_file = uploadFile('qualification_file', 'employee_docs');
$photo              = uploadFile('photo', 'employee_photos');

// Insert Query
$stmt = $conn->prepare("INSERT INTO employees 
(emp_code, emp_name, father_name, dob, mobile_no, whatsapp_no, email, occupation, qualification, permanent_address, present_address, aadhar_no, pan_no, voter_id, account_no, ifsc, branch_name, account_type, nominee_name, nominee_dob, nominee_relation, last_agency, joining_date, designation_id, branch_id, ref1_name, ref1_profession, ref1_org, ref1_address, ref1_contact, ref1_years, ref2_name, ref2_profession, ref2_org, ref2_address, ref2_contact, ref2_years, basic, hra, da, ta, ptax, tds, esi, pf, dev_fee, declaration, aadhaar_file, pan_file, passbook_file, qualification_file, photo)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$stmt->bind_param("ssssssssssssssssssssssssssssssssddddddddsssssss",
$emp_code, $emp_name, $father_name, $dob, $mobile_no, $whatsapp_no, $email, $occupation, $qualification, $permanent_address, $present_address, $aadhar_no, $pan_no, $voter_id, $account_no, $ifsc, $branch_name, $account_type, $nominee_name, $nominee_dob, $nominee_relation, $last_agency, $joining_date, $designation_id, $branch_id, $ref1_name, $ref1_profession, $ref1_org, $ref1_address, $ref1_contact, $ref1_years, $ref2_name, $ref2_profession, $ref2_org, $ref2_address, $ref2_contact, $ref2_years, $basic, $hra, $da, $ta, $ptax, $tds, $esi, $pf, $dev_fee, $declaration, $aadhaar_file, $pan_file, $passbook_file, $qualification_file, $photo);

if($stmt->execute()){
    header("Location: emp_list.php?msg=Employee Added Successfully");
} else {
    echo "Failed: ".$conn->error;
}
?>
