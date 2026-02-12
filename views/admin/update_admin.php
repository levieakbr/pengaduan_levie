<?php
require_once __DIR__ . '/../connection.php';
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: login.php');
        exit();
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
     header('Location: manage_admin.php');
        exit();
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$username = isset($_POST['username']) ? trim($_POST['username']) : '';

if ($id <= 0 || $username === '') {
    header('Location: edit_admin.php?id=' . urlencode((string) $id));
    exit();
}

$defaultPasssword = '12345';
$hash = password_hash($defaultPasssword, PASSWORD_BCRYPT);

$stmt = mysqli_prepare($conn, 'UPDATE admin SET username = ?, password = ? WHERE id = ?');
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssi', $username, $hash, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header('Location: manage_admin.php');
exit();


?>