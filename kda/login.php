<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/Project/kda/config/db.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['designation_id'] = $user['designation_id'];
        $_SESSION['username'] = $user['username'];

        header("Location: modules/admin/dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>KDA ERP Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            border-radius: 1rem;
            overflow: hidden;
        }
        .card-header {
            background-color:rgb(102, 74, 204);
        }
        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin: 0 auto 10px;
            display: block;
        }
    </style>
</head>
<body>

<div class="card shadow login-card">
    <div class="card-header text-center text-white">
        <img src="assets/images/logo.png" alt="Logo" class="logo">
        <h4>🔐 KDA Microfinance </h4>
        <small>Login to your account</small>
    </div>
    <div class="card-body">
        <?php if ($error) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus/>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required/>
            </div>
            <button type="submit" class="btn btn-primary w-100">🔓 Login</button>
        </form>
    </div>
    <div class="card-footer text-center small text-muted">
        © 2025 KDA Microfinance ERP
    </div>
</div>

</body>
</html>
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'session_expired') {
    echo "<div class='alert alert-danger'>Session Expired. Please login again.</div>";
}
?>
