<?php
require 'db.php';  // Pastikan koneksi database sudah dihubungkan

// Ambil ID tugas dari query parameter
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Ambil data tugas berdasarkan ID
$sql = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :tugas_id';
$statement = $conn->prepare($sql);
$statement->bindParam(':tugas_id', $id, PDO::PARAM_INT);
$statement->execute();
$tugas = $statement->fetch(PDO::FETCH_ASSOC);

if ($tugas) {
    echo "<h1>Detail Tugas</h1>";
    echo "ID: " . $tugas['id'] . "<br>";
    echo "Deskripsi: " . $tugas['deskripsi'] . "<br>";
    echo "Waktu: " . $tugas['waktu'] . " menit<br>";
} else {
    echo "Tugas dengan ID $id tidak ditemukan.";
}
?>

