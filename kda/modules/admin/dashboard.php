<?php include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/includes/header.php'); ?>
<?php
$query = mysqli_query($conn, "SELECT logo FROM company_info LIMIT 1");
$row = mysqli_fetch_assoc($query);
$logo = !empty($row['logo']) ? '/Project/kda/uploads/company/'.$row['logo'] : '/Project/kda/assets/images/logo.png';
?>
<img src="<?php echo $logo; ?>" alt="Logo" width="50">
<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}
?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$query = mysqli_query($conn, "SELECT * FROM company_info LIMIT 1");
$row = mysqli_fetch_assoc($query);

echo "📧 Email: ".(isset($row['email']) ? $row['email'] : '')." | ";
echo "📞 Contact: ".(isset($row['contact_no']) ? $row['contact_no'] : '')." | ";
echo "🌐 Website: ".(isset($row['website']) ? $row['website'] : '');


// Total Branches
$branch_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM branches");
$branch_data = mysqli_fetch_assoc($branch_result);
$total_branches = $branch_data['total'] ?? 0;

// Total Employees
$emp_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM employees");
$emp_data = mysqli_fetch_assoc($emp_result);
$total_employees = $emp_data['total'] ?? 0;

// Dummy Data (pending real tables)
$today_collection = 250000;
$today_leave = 3;
$overdue_loans = 14;
$loan_pending = 5;
$loan_approved = 18;
$loan_sanctioned = 16;
$loan_disbursed = 13;
$best_branch = "Kolkata Branch";
$lowest_branch = "Egra Branch";
$notifications = 7;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | KDA ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .sidebar {
            background-color: #343a40;
            min-height: 100vh;
            padding: 20px;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 8px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #ffc107;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body><?php
// Notification fetch
$notice_result = mysqli_query($conn, "SELECT * FROM notifications WHERE status='Active' ORDER BY id DESC LIMIT 1");
$notice_data = mysqli_fetch_assoc($notice_result);
$important_notice = $notice_data['message'] ?? 'Welcome to KDA Microfinance ERP!';
?>
<div style="background-color: #dc3545; color: #fff; padding: 8px 20px; overflow:hidden; white-space:nowrap;">
    <marquee behavior="scroll" direction="left" scrollamount="5">
        📢 Important Notice: <?php echo $important_notice; ?>
    </marquee>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4>KDA ERP</h4>
            <a href="dashboard.php">📊 Dashboard</a>
            <a href="../employees/employee_list.php">👥 Employees</a>
            <a href="../branches/branch_list.php">🏢 Branches</a>
            <a href="company_info_edit.php">⚙️ Company Info Settings</a>
            <a href="../../logout.php">🚪 Logout</a>
        </div>

        <!-- Main content -->
        <div class="col-md-10 p-4">
            <h3 class="mb-4">📊 KDA Microfinance ERP Dashboard</h3>

            <div class="row g-4">
                <?php
                $cards = [
                    ['title' => 'Total Branches', 'value' => $total_branches, 'bg' => 'primary'],
                    ['title' => 'Total Employees', 'value' => $total_employees, 'bg' => 'success'],
                    ['title' => "Today's Loan Collection", 'value' => "₹ ".number_format($today_collection), 'bg' => 'info'],
                    ['title' => "Today's Leave Applications", 'value' => $today_leave, 'bg' => 'warning'],
                    ['title' => "Overdue Loans", 'value' => $overdue_loans, 'bg' => 'danger'],
                    ['title' => "Loan Approval Pending", 'value' => $loan_pending, 'bg' => 'secondary'],
                    ['title' => "Approved Loans", 'value' => $loan_approved, 'bg' => 'primary'],
                    ['title' => "Sanctioned Loans", 'value' => $loan_sanctioned, 'bg' => 'success'],
                    ['title' => "Loan Disbursed", 'value' => $loan_disbursed, 'bg' => 'info'],
                    ['title' => "Best Disbursement Branch", 'value' => $best_branch, 'bg' => 'success'],
                    ['title' => "Lowest Disbursement Branch", 'value' => $lowest_branch, 'bg' => 'danger'],
                    ['title' => "New Notifications", 'value' => $notifications, 'bg' => 'warning'],
                ];

                foreach($cards as $card){
                    echo "
                    <div class='col-md-3'>
                        <div class='card text-white bg-{$card['bg']} p-3'>
                            <h6>{$card['title']}</h6>
                            <h3>{$card['value']}</h3>
                        </div>
                    </div>
                    ";
                }
                ?>
            </div>

            <div class="footer mt-5">
                © 2025 KDA Microfinance ERP | Developed by Your Company
            </div>
        </div>
    </div>
</div>
