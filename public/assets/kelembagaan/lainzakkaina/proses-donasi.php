<?php
// File: proses-donasi.php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Ambil & bersihkan data
    $jenis_dana = htmlspecialchars($_POST['jenis_dana']);
    $program_id = !empty($_POST['program_id']) ? $_POST['program_id'] : NULL;
    $nominal = filter_var($_POST['nominal'], FILTER_SANITIZE_NUMBER_FLOAT);
    $nama_donatur = htmlspecialchars($_POST['nama_donatur']);
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $email = htmlspecialchars($_POST['email']);
    $metode_pembayaran = htmlspecialchars($_POST['metode_pembayaran']);
    $is_anonim = isset($_POST['is_anonim']) ? 1 : 0;

    // 2. Generate Transaction ID (Format: LZK-YYYYMMDD-RANDOM)
    $tanggal_hari_ini = date('Ymd');
    $random_number = rand(1000, 9999);
    $transaction_id = "LZK-" . $tanggal_hari_ini . "-" . $random_number;

    // 3. Simpan ke database
    try {
        $sql = "INSERT INTO donasi (transaction_id, program_id, nama_donatur, email, whatsapp, nominal, metode_pembayaran, is_anonim) 
                VALUES (:trx_id, :program_id, :nama, :email, :wa, :nominal, :metode, :anonim)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':trx_id' => $transaction_id,
            ':program_id' => $program_id,
            ':nama' => $nama_donatur,
            ':email' => $email,
            ':wa' => $whatsapp,
            ':nominal' => $nominal,
            ':metode' => $metode_pembayaran,
            ':anonim' => $is_anonim
        ]);

        // 4. Redirect ke halaman Invoice/Sukses
        header("Location: invoice.php?trx=" . $transaction_id);
        exit;

    } catch (PDOException $e) {
        die("Terjadi kesalahan sistem: " . $e->getMessage());
    }
} else {
    // Jika ada yang akses file ini langsung lewat URL, lempar balik ke homepage
    header("Location: index.php");
    exit;
}
?>