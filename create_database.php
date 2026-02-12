<?php
require_once __DIR__ . '/public/connection.php';

$dropQueries = [
    "DROP TABLE IF EXISTS `aspirasi`",
    "DROP TABLE IF EXISTS `input_aspirasi`",
    "DROP TABLE IF EXISTS `siswa`",
    "DROP TABLE IF EXISTS `kategori`",
    "DROP TABLE IF EXISTS `admin`",
];

$queries = [
    "CREATE TABLE IF NOT EXISTS `admin` (\n"
        . " `id` int(11) NOT NULL AUTO_INCREMENT,\n"
        . " `username` varchar(20) NOT NULL,\n"
        . " `password` varchar(100) NOT NULL,\n"
        . " PRIMARY KEY (`id`)\n"
        . ") ENGINE=InnoDB DEFAULT CHARSET=utf8",
    "CREATE TABLE IF NOT EXISTS `kategori` (\n"
        ." `id` int(11) NOT NULL AUTO_INCREMENT,\n"
        ." `category_name` varchar(30) NOT NULL,\n"
        ." PRIMARY KEY (`id`)\n"
        .") ENGINE=InnoDB DEFAULT CHARSET=utf8",
    "CREATE TABLE IF NOT EXISTS `siswa` (\n"
        ." `nis` int(10) NOT NULL,\n"
        ." `full_name` char(30) NOT NULL,\n"
        ." `class` varchar(20) NOT NULL,\n"
        ." PRIMARY KEY (`nis`)\n"
        .") ENGINE=InnoDB DEFAULT CHARSET=utf8",
    "CREATE TABLE IF NOT EXISTS `input_aspirasi` (\n"
        ." `id` int(11) NOT NULL AUTO_INCREMENT,\n"                                                                                 
        ." `nis` int(10) NOT NULL,\n"
        ." `category_id` int(11) NOT NULL,\n"
        ." `location` varchar(100) NOT NULL,\n"
        ." `description` text NOT NULL,\n"
        ." PRIMARY KEY (`id`),\n"
        ." KEY `nis` (`nis`),\n"
        ." KEY `category_id` (`category_id`),\n"
        ." CONSTRAINT `input_aspirasi_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,\n"
        ." CONSTRAINT `input_aspirasi_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE\n"
        .") ENGINE=InnoDB DEFAULT CHARSET=utf8",
    "CREATE TABLE IF NOT EXISTS `aspirasi` (\n"
        ." `aspiration_id` int(11) NOT NULL,\n"
        ." `status` enum('menunggu','proses','selesai') NOT NULL DEFAULT 'menunggu',\n"
        ." `feedback` text NULL,\n" 
        ." KEY `aspiration_id` (`aspiration_id`),\n"
        ." CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`aspiration_id`) REFERENCES `input_aspirasi` (`id`) ON DELETE CASCADE\n"
        .") ENGINE=InnoDB DEFAULT CHARSET=utf8",    
];                                                                              

foreach ($dropQueries as $sql) {
    if (!mysqli_query($conn, $sql)) {
        die('Error dropping table: ' . mysqli_error($conn));
    }
}

foreach ($queries as $sql) {
    if (!mysqli_query($conn, $sql)) {
        die('Error creating table: ' . mysqli_error($conn));
    }
}

if (!mysqli_query($conn, "INSERT INTO `kategori` (`category_name`) VALUES ('Fasilitas'), ('Kebersihan'), ('Keamanan')")) {
    die('Error seeding kategori: ' . mysqli_error($conn));
}

$adminUsername = 'admin';
$adminPassword = password_hash('admin123', PASSWORD_BCRYPT);
if (!mysqli_query($conn, "INSERT INTO `admin` (`username`, `password`) VALUES ('$adminUsername', '$adminPassword')")) {
    die('Error seeding admin: ' . mysqli_error($conn));
}

echo "Tables created successfully.";
?>