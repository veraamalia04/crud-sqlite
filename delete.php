<?php
require 'db.php';  // Pastikan koneksi ke database

// Ambil ID tugas dari query parameter
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id) {
    // Query untuk menghapus tugas berdasarkan ID
    $sql = 'DELETE FROM tugas WHERE id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($statement->execute()) {
        echo "Tugas dengan ID $id berhasil dihapus!";
    } else {
        echo "Gagal menghapus tugas dengan ID $id.";
    }
} else {
    echo "ID tidak valid.";
}
?>

