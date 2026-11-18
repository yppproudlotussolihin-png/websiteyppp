<?php
// File: admin/hapus-transaksi.php
require_once '../config/database.php';
require_once 'cek_login.php';

if (isset($_GET['id'])) {
    $id_donasi = $_GET['id'];

    try {
        // Pastikan hanya transaksi yang masih pending yang bisa dihapus untuk keamanan audit
        $stmt = $pdo->prepare("DELETE FROM donasi WHERE id = :id AND status_pembayaran = 'pending'");
        $stmt->execute([':id' => $id_donasi]);
    } catch (PDOException $e) {
        // Abaikan atau log error jika gagal
    }
}

header("Location: transaksi.php");
exit;
?>