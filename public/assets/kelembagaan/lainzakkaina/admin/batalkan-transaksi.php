<?php
// File: admin/batalkan-transaksi.php
require_once '../config/database.php';
require_once 'cek_login.php';

if (isset($_GET['id'])) {
    $id_donasi = $_GET['id'];

    try {
        // Ambil data transaksi yang sukses
        $stmt = $pdo->prepare("SELECT * FROM donasi WHERE id = :id AND status_pembayaran = 'success'");
        $stmt->execute([':id' => $id_donasi]);
        $donasi = $stmt->fetch();

        if ($donasi) {
            $pdo->beginTransaction(); // Mulai transaksi aman

            // 1. Ubah status donasi menjadi 'cancelled'
            $updateDonasi = $pdo->prepare("UPDATE donasi SET status_pembayaran = 'cancelled' WHERE id = :id");
            $updateDonasi->execute([':id' => $id_donasi]);

            // 2. Kurangi dana terkumpul di program jika dulu masuk ke program tertentu
            if (!empty($donasi['program_id'])) {
                $updateProgram = $pdo->prepare("UPDATE program SET dana_terkumpul = dana_terkumpul - :nominal WHERE id = :program_id");
                $updateProgram->execute([
                    ':nominal' => $donasi['nominal'],
                    ':program_id' => $donasi['program_id']
                ]);
            }

            // 3. Catat penyesuaian di laporan keuangan sebagai pengeluaran koreksi kas
            $nama_donatur = $donasi['is_anonim'] ? 'Hamba Allah' : $donasi['nama_donatur'];
            $keterangan_koreksi = "Koreksi/Pembatalan Transaksi Sukses (TRX: " . $donasi['transaction_id'] . " - a.n " . $nama_donatur . ")";
            
            $insertKoreksi = $pdo->prepare("INSERT INTO laporan_keuangan (tanggal, keterangan, jenis, kategori, nominal) VALUES (CURDATE(), :ket, 'pengeluaran', 'Koreksi Kas', :nom)");
            $insertKoreksi->execute([
                ':ket' => $keterangan_koreksi,
                ':nom' => $donasi['nominal']
            ]);

            $pdo->commit(); // Simpan perubahan secara permanen
        }

        header("Location: transaksi.php");
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Gagal membatalkan transaksi: " . $e->getMessage());
    }
} else {
    header("Location: transaksi.php");
    exit;
}
?>