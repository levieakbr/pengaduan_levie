    <?php
    require_once __DIR__ . '/../connection.php';
    session_start();
    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: login.php');
        exit();
    }
    ?>
<html>
<div>
    <a href="../index.php">Halaman Utama</a> |
    <a href="index.php">Dashboard Utama</a> |
    <a href="manage_categories.php">Kelola Kategori</a> |
    <a href="manage_student.php">kelola Siswa</a> |
    <a href="manage_admin.php">Kelola Admin</a> |
    <a href="logout.php">Logout</a>
</div>
<h1>Daftar Admin</h1>
<a href="add_admin.php">Tambah Admin BAru</a>
<form action="save_admin.php" method="post">
    <label for="full_name">Nama Lengkap:</label>
    <input type="text" id="full_name" name="full_name" required>
    <br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <input type="submit" value="Simpan">
</form>
</html>

