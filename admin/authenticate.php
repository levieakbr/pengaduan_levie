<?php
session_start();
require_once __DIR__ . '/../connection.php';
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$sql = "SELECT * FROM admins WHERE username = '$username' AND password ='$password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
    $_SESSION['admin_logged_in'] = true;
    header('Location: index.php');
} else {
    header('Location: login.php?error=invalid_credentials');
}
?>