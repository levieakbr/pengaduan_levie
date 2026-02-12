<?php
require_once __DIR__ . '/../connection.php';

$sql = "SELECT s.nis, s.full_name, s.class, k.category_name, ia.location, ia.description, a.aspiration_id, a.status, a.feedback "
    . "FROM input_aspirasi ia "
    . "JOIN siswa s ON ia.nis = s.nis "
    . "JOIN kategori k ON ia.category_id = k.id "
    . "JOIN aspirasi a ON ia.id = a.aspiration_id "
    . "WHERE a.aspiration_id = " . intval($_GET['aspiration']);
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<label for="">NIS</label>
<p><?php echo $row['nis']; ?></p>
<br>
<label for="">Nama Lengkap</label>  
<p><?php echo $row['full_name']; ?></p>
<br>
<label for="">Kelas</label>
<p><?php echo $row['class']; ?></p>
<br>
<label for="">Kategori</label> 
<p><?php echo $row['category_name']; ?></p>
<br>
<label for="">Lokasi</label>
<p><?php echo $row['location']; ?></p>
<br>
<label for="">Deskripsi</label>
<p><?php echo $row['description']; ?></p>
<br>
<form action="update_aspirasi.php" method="post">
    <input type="hidden" name="aspiration_id" value="<?php echo $row['aspiration_id']; ?>">
    <label for="">status</label>
    <select name="status" id="">
        <option value="menunggu" <?php if ($row['status'] == 'menunggu') echo 'selected'; ?>>Menunggu</option>
        <option value="proses" <?php if ($row['status'] == 'proses') echo 'selected'; ?>>Proses</option>
        <option value="selesai" <?php if ($row['status'] == 'selesai') echo 'selected'; ?>>Selesai</option>
    </select>
    <br>
    <label for="">feedback</label>
    <textarea name="feedback" id="" cols="30" rows="10"><?php echo $row['feedback']; ?></textarea>
    <br>
    <input type="submit" value="Update">
</form>