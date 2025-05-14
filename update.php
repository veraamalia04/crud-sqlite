<?php
require 'db.php';  // Pastikan koneksi ke database

// Ambil ID tugas dari query parameter
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data baru dari form
    $deskripsi = $_POST['deskripsi'];
    $waktu = $_POST['waktu'];

    // Query untuk mengupdate tugas berdasarkan ID
    $sql = 'UPDATE tugas SET deskripsi = :deskripsi, waktu = :waktu WHERE id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':deskripsi', $deskripsi);
    $statement->bindParam(':waktu', $waktu, PDO::PARAM_INT);
    
    if ($statement->execute()) {
        // Redirect ke halaman tugas yang baru saja diupdate
        header("Location: detail.php?id=$id");
        exit;
    } else {
        echo "Gagal mengupdate tugas.";
    }
} else {
    // Ambil data tugas yang ingin diupdate
    $sql = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :id';
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $tugas = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$tugas) {
        echo "Tugas dengan ID $id tidak ditemukan.";
        exit;
    }
}
?>

<!-- Form untuk mengupdate tugas -->
<h1>Update Tugas</h1>
<form method="POST">
    <label for="deskripsi">Deskripsi:</label>
    <input type="text" name="deskripsi" id="deskripsi" value="<?php echo htmlspecialchars($tugas['deskripsi']); ?>" required><br><br>

    <label for="waktu">Waktu (menit):</label>
    <input type="number" name="waktu" id="waktu" value="<?php echo $tugas['waktu']; ?>" required><br><br>

    <button type="submit">Update Tugas</button>
</form>

