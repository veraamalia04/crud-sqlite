<?php
require 'db.php';  // Pastikan koneksi database sudah dihubungkan

// Ambil semua tugas
$sql = 'SELECT id, deskripsi, waktu FROM tugas';
$statement = $conn->query($sql);
$tugas = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($tugas) {
    echo "<h1>Daftar Tugas</h1>";
    foreach ($tugas as $t) {
        echo '<a href="detail.php?id=' . $t['id'] . '">' . $t['deskripsi'] . '</a><br>';
    }
} else {
    echo "Tidak ada tugas.";
}
?>

