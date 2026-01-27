<?php
require_once __DIR__ . '/connection.php';

$nis            = trim($_POST['nis']);
$fullName       = trim($_POST['full_name']);
$class          = trim($_POST['class']);
$categoryId     = trim($_POST['category']);
$location       = trim($_POST['location']);
$description    = trim($_POST['description']);

$sqlSiswa = "INSERT INTO siswa (nis, full_name, class) VALUES ($nis, '$fullName', '$class')"
    . "ON DUPLICATE KEY UPDATE full_name = VALUES(full_name), class = VALUES (class)";
mysqli_query($conn, $sqlSiswa);

$sqlAspirasi = "INSERT INTO input_aspirasi (nis, category_id, location, description)"
    .  "VALUES ($nis, $categoryId, '$location', '$description')";
    mysqli_query($conn, $sqlAspirasi);

$aspirationId = mysqli_insert_id($conn);
$sqlAspirasiDetail = "INSERT INTO aspirasi (aspiration_id) VALUES ($aspirationId)";
mysqli_query($conn, $sqlAspirasiDetail);

header('Location: index.php?message=succes');
?>  