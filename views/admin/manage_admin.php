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
<a href="add_admin.php">Tambah Admin Baru</a>
<div><br></div>
<table border="1" cellpadding="10" cellspacing="0">
        <thead >
            <tr>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT id, username FROM admin ORDER BY id ASC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['username'] . '</td>' ;
                    echo '<td>
                        <a href="edit_admin.php?id=' . urlencode($row['id']) . '">Edit</a> |
                        <a href="delete_admin.php?id=' . urlencode($row['id']) . '">Delete</a>
                        </td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</html>

