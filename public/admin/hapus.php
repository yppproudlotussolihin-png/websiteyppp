<?php
require_once 'koneksi.php';

// Cek apakah ada ID yang dikirim
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Perintah SQL untuk hapus
    $query = "DELETE FROM tb_santri WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, balik ke halaman admin dengan pesan sukses
        header("Location: admin.php?pesan=berhasil_hapus");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada ID, kembali saja
    header("Location: admin.php");
}
?>