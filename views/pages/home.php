<?php
    require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
    $result = mysqli_query($conn, "SELECT id, category_name FROM kategori ORDER BY id");
?>
<!-- HTML -->
    <h1>Aplikasi Pengaduan Sarana Sekolah</h1>

    <form action="<?= BASE_PATH ?>/save_aspirasi" method="post">

        <label for="NIS">NIS</label>
        <input type="text" name="nis">
        <br>

        <label for="Nama Lengkap">Nama Lengkap</label>
        <input type="text" name="full_name">
        <br>

        <label for="Kelas">Kelas</label>
        <input type="text" name="class">
        <br>

        <label for="Kelas">Kategori</label>
        <select name="category" id="">
        <?php while ($row = mysqli_fetch_assoc($result)) {?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['category_name']; ?>
                </option>
            <?php } ?>
        </select>
        <br>
        
        <label for="">Lokasi</label>
        <input type="text" name="location">
        <br>

        <label for="">Deskripsi</label>
        <textarea name="description" id="" cols="30" rows="10"></textarea>
        <br>

        
        <input type="submit"  value="Submit">
    </form>

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
        </thead>
        <tbody>
            <?php
            $sql = "SELECT s.nis, s.full_name, s.class, k.category_name, ia.location, ia.description, a.status, a.feedback "
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
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>