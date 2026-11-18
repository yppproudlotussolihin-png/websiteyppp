<?php
// File: admin/approve.php
require_once '../config/database.php';
require_once 'cek_login.php';

if (isset($_GET['id'])) {
    $id_donasi = $_GET['id'];

    try {
        // Cek data transaksi yang berstatus pending
        $stmt = $pdo->prepare("SELECT * FROM donasi WHERE id = :id AND status_pembayaran = 'pending'");
        $stmt->execute([':id' => $id_donasi]);
        $donasi = $stmt->fetch();

        if ($donasi) {
            // Gunakan Transaction agar jika satu gagal, gagal semua (aman untuk keuangan)
            $pdo->beginTransaction();

            // 1. Ubah status transaksi menjadi 'success'
            $updateDonasi = $pdo->prepare("UPDATE donasi SET status_pembayaran = 'success' WHERE id = :id");
            $updateDonasi->execute([':id' => $id_donasi]);

            // 2. Tambahkan dana terkumpul ke Program yang dipilih
            if (!empty($donasi['program_id'])) {
                $updateProgram = $pdo->prepare("UPDATE program SET dana_terkumpul = dana_terkumpul + :nominal WHERE id = :program_id");
                $updateProgram->execute([
                    ':nominal' => $donasi['nominal'],
                    ':program_id' => $donasi['program_id']
                ]);
            }

            // 3. Catat pemasukan di Laporan Keuangan
            $nama_donatur = $donasi['is_anonim'] ? 'Hamba Allah' : $donasi['nama_donatur'];
            $keterangan_kas = "Donasi masuk dari " . $nama_donatur . " (TRX: " . $donasi['transaction_id'] . ")";
            
            $insertKas = $pdo->prepare("INSERT INTO laporan_keuangan (tanggal, keterangan, jenis, kategori, nominal) VALUES (CURDATE(), :ket, 'pemasukan', :kat, :nom)");
            $insertKas->execute([
                ':ket' => $keterangan_kas,
                ':kat' => ucfirst($donasi['jenis_dana']), // Misal: Zakat, Infak, Sedekah
                ':nom' => $donasi['nominal']
            ]);

            $pdo->commit();
        }
        
        header("Location: transaksi.php");
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Gagal memverifikasi transaksi: " . $e->getMessage());
    }
} else {
    header("Location: transaksi.php");
    exit;
}
?>