<?php
// File: cetak-kwitansi.php
require_once 'config/database.php';

if (!isset($_GET['trx'])) {
    die("Akses ditolak.");
}

$trx_id = $_GET['trx'];
$stmt = $pdo->prepare("SELECT d.*, p.judul as nama_program FROM donasi d LEFT JOIN program p ON d.program_id = p.id WHERE d.transaction_id = :trx AND d.status_pembayaran = 'success' LIMIT 1");
$stmt->execute([':trx' => $trx_id]);
$donasi = $stmt->fetch();

if (!$donasi) {
    die("Transaksi tidak ditemukan atau belum diverifikasi sukses.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi Resmi - <?php echo $donasi['transaction_id']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 py-12 flex justify-center">

    <div class="bg-white w-full max-w-xl p-8 rounded-2xl shadow-lg border border-gray-200">
        <!-- Header Kwitansi -->
        <div class="flex justify-between items-center border-b pb-6 mb-6">
            <div>
                <h1 class="text-2xl font-serif font-bold text-emerald-900">LAINZAKKAINA<span class="text-yellow-500">.</span></h1>
                <p class="text-xs text-gray-500">Lembaga Pengelola Dana Umat Resmi & Transparan</p>
            </div>
            <div class="text-right">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">LUNAS / SAH</span>
            </div>
        </div>

        <!-- Detail Transaksi -->
        <div class="space-y-4 mb-8 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">No. Transaksi</span>
                <span class="font-bold text-gray-800"><?php echo $donasi['transaction_id']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Tanggal</span>
                <span class="font-bold text-gray-800"><?php echo date('d M Y, H:i', strtotime($donasi['created_at'])); ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Nama Donatur</span>
                <span class="font-bold text-gray-800"><?php echo $donasi['is_anonim'] ? 'Hamba Allah' : htmlspecialchars($donasi['nama_donatur']); ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Jenis Dana</span>
                <span class="font-bold uppercase text-emerald-700"><?php echo $donasi['jenis_dana']; ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Alokasi Program</span>
                <span class="font-bold text-gray-800"><?php echo htmlspecialchars($donasi['nama_program'] ?? 'Zakat / Infak Umum'); ?></span>
            </div>
        </div>

        <!-- Kotak Nominal -->
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 text-center mb-8">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Nominal Diterima</p>
            <p class="text-3xl font-extrabold text-emerald-900">Rp <?php echo number_format($donasi['nominal'], 0, ',', '.'); ?></p>
        </div>

        <!-- Tanda Tangan / Footer -->
        <div class="flex justify-between items-end text-xs text-gray-500 pt-6 border-t">
            <div>
                <p>Terima kasih atas kebaikan Anda.</p>
                <p>Semoga menjadi amal jariyah yang berlimpah.</p>
            </div>
            <div class="text-center">
                <p class="mb-12 font-bold text-gray-700">Amil LAINZAKKAINA</p>
                <p class="font-semibold text-emerald-800">( Resmi & Terverifikasi )</p>
            </div>
        </div>

        <!-- Tombol Cetak (Hilang saat diprint) -->
        <div class="mt-8 text-center no-print flex space-x-4">
            <button onclick="window.print()" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition shadow">
                Cetak / Simpan PDF
            </button>
            <a href="index.php" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition text-center">
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>