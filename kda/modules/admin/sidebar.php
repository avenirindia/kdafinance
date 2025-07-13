<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<div class="col-md-2 bg-light sidebar p-3" style="height: 100vh;">
  <h5>Menu</h5>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link" href="/Project/kda/dashboard.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Project/kda/modules/employees/employee_list.php">Employees</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Project/kda/modules/branches/branch_list.php">Branches</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Project/kda/modules/loans/loan_list.php">Loans</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Project/kda/modules/accounts/transaction_list.php">Accounts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/Project/kda/modules/reports/employee_report.php">Reports</a>
    </li>
  </ul>
</div>
<div class="col-md-10 p-4">
<div class="col-md-2 bg-dark text-white p-3" style="height:100vh;">
  <h5>KDA ERP</h5>
  <a class="nav-link <?php if($currentPage == 'dashboard.php') echo 'text-warning'; ?>" href="/Project/kda/dashboard.php">📊 Dashboard</a>
  <a class="nav-link <?php if($currentPage == 'employee_list.php') echo 'text-warning'; ?>" href="/Project/kda/modules/employees/employee_list.php">👥 Employees</a>
  <a class="nav-link <?php if($currentPage == 'branch_list.php') echo 'text-warning'; ?>" href="/Project/kda/modules/branches/branch_list.php">🏢 Branches</a>
  <a class="nav-link <?php if($currentPage == 'company_info_edit.php') echo 'text-warning'; ?>" href="/Project/kda/modules/company/company_info_edit.php">⚙️ Company Settings</a>
  <a class="nav-link" href="/Project/kda/logout.php">🚪 Logout</a>
</div>
