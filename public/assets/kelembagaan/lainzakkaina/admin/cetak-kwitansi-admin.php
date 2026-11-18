<?php
// File: admin/cetak-kwitansi-admin.php
require_once '../config/database.php';
require_once 'cek_login.php';

if (!isset($_GET['trx'])) {
    die("Nomor transaksi tidak valid.");
}

$trx = $_GET['trx'];

// Ambil data donasi dan program terkait
$stmt = $pdo->prepare("SELECT d.*, p.judul as nama_program FROM donasi d LEFT JOIN program p ON d.program_id = p.id WHERE d.transaction_id = :trx LIMIT 1");
$stmt->execute([':trx' => $trx]);
$donasi = $stmt->fetch();

if (!$donasi) {
    die("Data transaksi tidak ditemukan.");
}

$namaDonatur = $donasi['is_anonim'] ? 'Hamba Allah' : $donasi['nama_donatur'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Digital - <?php echo $donasi['transaction_id']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 py-12 flex justify-center items-center min-h-screen">

    <div class="bg-white w-full max-w-2xl p-8 md:p-12 rounded-3xl shadow-xl border border-gray-200 relative overflow-hidden">
        
        <!-- Aksen Dekorasi Atas -->
        <div class="absolute top-0 left-0 right-0 h-3 bg-gradient-to-r from-emerald-800 via-emerald-600 to-yellow-500"></div>

        <!-- Header Kuitansi -->
        <div class="flex justify-between items-start border-b pb-6 mb-8 mt-2">
            <div>
                <h1 class="text-2xl font-serif font-bold text-emerald-900">LAINZAKKAINA<span class="text-yellow-500">.</span></h1>
                <p class="text-xs text-gray-500">Lembaga Amil Zakat, Infak, & Sedekah Resmi</p>
            </div>
            <div class="text-right">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold uppercase px-3 py-1 rounded-full">Kuitansi Resmi</span>
                <p class="text-xs text-gray-400 mt-2">No. TRX: <span class="font-bold text-gray-700"><?php echo $donasi['transaction_id']; ?></span></p>
            </div>
        </div>

        <!-- Detail Informasi Kuitansi -->
        <div class="space-y-6 text-sm">
            <div class="grid grid-cols-2 gap-4 bg-gray-50 p-6 rounded-2xl border">
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase">Nama Donatur</p>
                    <p class="font-bold text-gray-800 text-base mt-1"><?php echo htmlspecialchars($namaDonatur); ?></p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase">Tanggal Transaksi</p>
                    <p class="font-semibold text-gray-800 text-base mt-1"><?php echo date('d M Y, H:i', strtotime($donasi['created_at'])); ?></p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase">Jenis Dana</p>
                    <p class="font-semibold text-gray-800 uppercase mt-1"><?php echo $donasi['jenis_dana']; ?></p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs font-semibold uppercase">Alokasi Program</p>
                    <p class="font-semibold text-gray-800 mt-1"><?php echo htmlspecialchars($donasi['nama_program'] ?? 'Donasi Umum / Zakat Mutlak'); ?></p>
                </div>
            </div>

            <!-- Nominal Kuitansi -->
            <div class="border-2 border-dashed border-emerald-200 bg-emerald-50/50 p-6 rounded-2xl text-center">
                <p class="text-xs text-emerald-800 font-semibold uppercase tracking-wider mb-1">Jumlah Dana Diterima</p>
                <h2 class="text-4xl font-extrabold text-emerald-900">Rp <?php echo number_format($donasi['nominal'], 0, ',', '.'); ?></h2>
            </div>

            <!-- Status Pembayaran -->
            <div class="flex justify-between items-center text-xs text-gray-500 pt-2 border-t">
                <span>Metode Pembayaran: <strong class="text-gray-700"><?php echo $donasi['metode_pembayaran']; ?></strong></span>
                <span>Status: 
                    <strong class="<?php echo $donasi['status_pembayaran'] == 'success' ? 'text-green-600' : 'text-yellow-600'; ?> uppercase">
                        <?php echo $donasi['status_pembayaran']; ?>
                    </strong>
                </span>
            </div>
        </div>

        <!-- Tanda Tangan & Pengesahan Amil -->
        <div class="flex justify-between items-end mt-12 pt-6 border-t text-xs text-gray-600">
            <div>
                <p class="italic">Terima kasih atas kebaikan Anda.</p>
                <p class="font-semibold text-emerald-900 mt-1">"Semoga harta diberkahi dan mensucikan jiwa."</p>
            </div>
            <div class="text-center">
                <p class="mb-12 font-bold text-gray-800">Amil Pengelola,</p>
                <p class="font-bold text-emerald-900 border-b border-gray-400 pb-1 px-6">( LAINZAKKAINA )</p>
            </div>
        </div>

        <!-- Tombol Aksi (Hilang Saat Diprint) -->
        <div class="mt-8 text-center no-print flex gap-4">
            <button onclick="window.print()" class="flex-1 bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3 rounded-xl transition shadow">
                🖨️ Cetak / Unduh Kuitansi PDF
            </button>
            <a href="transaksi.php" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition text-center">
                Kembali ke Daftar Transaksi
            </a>
        </div>

    </div>

</body>
</html>