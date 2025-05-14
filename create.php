<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deskripsi = $_POST['deskripsi'];
    $waktu = $_POST['waktu'];

    $sql = 'INSERT INTO tugas(deskripsi, waktu) VALUES(:deskripsi, :waktu)';
    $statement = $conn->prepare($sql);
    $statement->execute([
        ':deskripsi' => $deskripsi,
        ':waktu' => $waktu
    ]);

    header('Location: index.php');
    exit;
}
?>

<form method="POST">
    <input name="deskripsi" placeholder="Deskripsi">
    <input name="waktu" placeholder="Waktu (menit)" type="number">
    <button type="submit">Simpan</button>
</form>

