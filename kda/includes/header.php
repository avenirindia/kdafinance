<?php
// Session Start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Connection
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

// Constants Load
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/constants.php');

// Session Validation (future)
if (!isset($_SESSION['user_id'])) {
    header("Location: /Project/kda/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>KDA Microfinance ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Project/kda/assets/css/style.css" rel="stylesheet">
</head>
<body>
