<?php
    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: ' . BASE_PATH . '/admin/login');
        exit();
    }
?>
<?php if (!isset($_GET['message']) && $_GET['message'] === 'updated') { ?>
    <div class="alert alert-succes">Aspirasi Berhasil Diperbarui.</div>
<?php } ?>

<html>
<h1>Daftar Aspirasi Siswa</h1>
<table border="1" cellpadding="10" cellspacing="0">
        <thead >
            <th>NIS</th>
            <th>Nama Lengkap</th>
            <th>Kelas</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Feedback</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT s.nis, s.full_name, s.class, k.category_name, ia.location, ia.description, a.aspiration_id, a.status, a.feedback "
                . "FROM input_aspirasi ia "
                . "JOIN siswa s ON ia.nis = s.nis "
                . "JOIN kategori k ON ia.category_id = k.id "
                . "JOIN aspirasi a ON ia.id = a.aspiration_id "
                . "ORDER BY ia.id DESC ";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {  
                echo '<tr>';
                echo '<td>' . $row['nis']           . '</td>';
                echo '<td>' . $row['full_name']     . '</td>';
                echo '<td>' . $row['class']         . '</td>';  
                echo '<td>' . $row['category_name'] . '</td>';
                echo '<td>' . $row['location']      . '</td>';
                echo '<td>' . $row['description']   . '</td>';
                echo '<td>' . $row['status']        . '</td>';
                echo '<td>' . $row['feedback']      . '</td>';
                echo '<td>
                    <a href="edit_aspirasi.php?aspiration=' . $row['aspiration_id'] . '">Edit</a> |
                    <a href="delete_aspirasi.php?aspiration=' . $row['aspiration_id'] . '" onclick="return confirm(\'Are you sure?\')">Delete</a>'
                . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</html>

