<?php
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');
?>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #f4f7fa;
    }
    .table th {
        background-color: #3f51b5;
        color: #fff;
        text-align: center;
    }
    .table td {
        text-align: center;
    }
    .btn-action {
        font-size: 14px;
        padding: 5px 10px;
        margin: 2px;
    }
</style>

<div class="container my-5">
    <h2 class="mb-4 text-center text-primary">📋 Branch List</h2>
    <a href="branch_add.php" class="btn btn-success mb-3">➕ Add New Branch</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Branch Code</th>
                <th>Branch Name</th>
                <th>Address</th>
                <th>Opening Date</th>
                <th>District</th>
                <th>State</th>
                <th>Mobile No</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM branches ORDER BY id DESC");
        $sl = 1;
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$sl++."</td>";
            echo "<td>".$row['branch_code']."</td>";
            echo "<td>".$row['branch_name']."</td>";
            echo "<td>".$row['branch_address']."</td>";
            echo "<td>".$row['opening_date']."</td>";
            echo "<td>".$row['district']."</td>";
            echo "<td>".$row['state']."</td>";
            echo "<td>".$row['mobile_no']."</td>";
            echo "<td>
                <a href='branch_view.php?id=".$row['id']."' class='btn btn-info btn-action'>View</a>
                <a href='branch_edit.php?id=".$row['id']."' class='btn btn-warning btn-action'>Edit</a>
                <a href='branch_delete.php?id=".$row['id']."' onclick='return confirm(\"Are you sure?\")' class='btn btn-danger btn-action'>Delete</a>
            </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
