<?php
require_once __DIR__ . '/../connection.php';
 session_start();
    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: login.php');
        exit();
    }

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: manage_admin.php');
        exit();
}

$stmt = mysqli_prepare($conn, 'SELECT id, username FROM admin WHERE id = ?');
if (!$stmt) {
    header('Location: manage_admin.php');
    exit();
}

mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = $result ? mysqli_fetch_assoc($result) : null;
mysqli_stmt_close($stmt);

if (!$admin) {
    header('Location: manage_admin.php');
    exit();
} 
?>
<div>
    <a href="../index.php">Halaman Utama</a> |
    <a href="index.php">Dashboard Utama</a> |
    <a href="manage_categories.php">Kelola Kategori</a> |
    <a href="manage_student.php">kelola Siswa</a> |
    <a href="manage_admin.php">Kelola Admin</a> |
    <a href="logout.php">Logout</a>
</div>
<h1>Edit Admin</h1>
<form action="update_admin.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($admin['id']) ?>">
    <label for="full_name">Nama Lengkap:</label>
    <input type="text" id="full_name" name="full_name" value="" required>
    <br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']) ?>" required>
    <br>
    <input type="submit" value="Simpan Perubahan">
</form>
