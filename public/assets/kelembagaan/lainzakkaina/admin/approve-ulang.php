<?php
// File: admin/approve-ulang.php
require_once '../config/database.php';
require_once 'cek_login.php';

if (isset($_GET['id'])) {
    $id_donasi = $_GET['id'];

    try {
        // Cek data transaksi yang berstatus cancelled
        $stmt = $pdo->prepare("SELECT * FROM donasi WHERE id = :id AND status_pembayaran = 'cancelled'");
        $stmt->execute([':id' => $id_donasi]);
        $donasi = $stmt->fetch();

        if ($donasi) {
            $pdo->beginTransaction();

            // 1. Ubah kembali status menjadi 'success'
            $updateDonasi = $pdo->prepare("UPDATE donasi SET status_pembayaran = 'success' WHERE id = :id");
            $updateDonasi->execute([':id' => $id_donasi]);

            // 2. Kembalikan/tambahkan kembali saldo ke program terkait
            if (!empty($donasi['program_id'])) {
                $updateProgram = $pdo->prepare("UPDATE program SET dana_terkumpul = dana_terkumpul + :nominal WHERE id = :program_id");
                $updateProgram->execute([
                    ':nominal' => $donasi['nominal'],
                    ':program_id' => $donasi['program_id']
                ]);
            }

            // 3. Catat kembali sebagai pemasukan kas di laporan keuangan
            $nama_donatur = $donasi['is_anonim'] ? 'Hamba Allah' : $donasi['nama_donatur'];
            $keterangan_kas = "Pemulihan/Konfirmasi Ulang Transaksi Sukses (TRX: " . $donasi['transaction_id'] . ")";
            
            $insertKas = $pdo->prepare("INSERT INTO laporan_keuangan (tanggal, keterangan, jenis, kategori, nominal) VALUES (CURDATE(), :ket, 'pemasukan', :kat, :nom)");
            $insertKas->execute([
                ':ket' => $keterangan_kas,
                ':kat' => ucfirst($donasi['jenis_dana']),
                ':nom' => $donasi['nominal']
            ]);

            $pdo->commit();
        }

        header("Location: transaksi.php");
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Gagal memulihkan transaksi: " . $e->getMessage());
    }
} else {
    header("Location: transaksi.php");
    exit;
}
?>