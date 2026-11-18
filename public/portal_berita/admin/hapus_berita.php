<?php
// admin/hapus_berita.php
require_once '../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Ambil nama file gambar untuk dihapus dari folder assets
    $query_gambar = $conn->query("SELECT image FROM posts WHERE id = $id");
    if ($query_gambar->num_rows > 0) {
        $row = $query_gambar->fetch_assoc();
        if (!empty($row['image'])) {
            $path = "../assets/uploads/" . $row['image'];
            if (file_exists($path)) {
                unlink($path); // Menghapus file fisik gambar
            }
        }
    }

    // Hapus data dari database
    $conn->query("DELETE FROM posts WHERE id = $id");
}

// Kembalikan ke halaman berita
header("Location: berita.php");
exit;
?>