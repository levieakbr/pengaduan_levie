<?php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

$stmt = mysqli_prepare($conn, "SELECT password FROM admin WHERE username = ? LIMIT 1");

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hash);
    $hasUser = mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($hasUser && password_verify($password, $hash)) {
    $_SESSION['admin_logged_in'] = true;
    header('Location:' . BASE_PATH .'/admin');
    exit();
    }
    }
    
header('Location: login.php?error=invalid_credentials ');
exit();
?>