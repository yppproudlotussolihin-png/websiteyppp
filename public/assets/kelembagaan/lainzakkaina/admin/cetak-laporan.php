<?php
// File: admin/cetak-laporan.php
require_once '../config/database.php';
require_once 'cek_login.php';

// Ambil filter bulan/tahun jika ada (opsional), atau tampilkan semua
$stmtTotal = $pdo->query("SELECT 
    SUM(CASE WHEN jenis = 'pemasukan' THEN nominal ELSE 0 END) as total_masuk,
    SUM(CASE WHEN jenis = 'pengeluaran' THEN nominal ELSE 0 END) as total_keluar
    FROM laporan_keuangan");
$rekap = $stmtTotal->fetch();
$saldoAkhir = ($rekap['total_masuk'] ?? 0) - ($rekap['total_keluar'] ?? 0);

// Ambil seluruh data catatan keuangan
$riwayat = $pdo->query("SELECT * FROM laporan_keuangan ORDER BY tanggal DESC, id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Resmi - LAINZAKKAINA</title>
    <link rel="icon"
          type="image/png"
          href="../../../images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100 py-10 flex justify-center">

    <div class="bg-white w-full max-w-4xl p-10 rounded-2xl shadow-lg border border-gray-200">
        
        <!-- Kop Laporan / Header -->
        <div class="flex justify-between items-center border-b-2 border-emerald-900 pb-6 mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-emerald-900">LAINZAKKAINA<span class="text-yellow-500">.</span></h1>
                <p class="text-xs text-gray-500 mt-1">Lembaga Amil Zakat, Infak, dan Sedekah Resmi & Transparan</p>
                <p class="text-xs text-gray-500">Jl. Kebaikan No. 99, Jakarta | Email: halo@lainzakkaina.com</p>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold text-gray-800">LAPORAN ARUS KAS</h2>
                <p class="text-xs text-gray-500 mt-1">Dicetak pada: <?php echo date('d M Y, H:i'); ?></p>
            </div>
        </div>

        <!-- Ringkasan Angka (Summary Cards) -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-xl text-center">
                <p class="text-xs text-gray-500 font-semibold uppercase">Total Pemasukan</p>
                <p class="text-xl font-bold text-emerald-700 mt-1">Rp <?php echo number_format($rekap['total_masuk'] ?? 0, 0, ',', '.'); ?></p>
            </div>
            <div class="bg-red-50 border border-red-200 p-4 rounded-xl text-center">
                <p class="text-xs text-gray-500 font-semibold uppercase">Total Pengeluaran</p>
                <p class="text-xl font-bold text-red-600 mt-1">Rp <?php echo number_format($rekap['total_keluar'] ?? 0, 0, ',', '.'); ?></p>
            </div>
            <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-center">
                <p class="text-xs text-gray-500 font-semibold uppercase">Saldo Kas Bersih</p>
                <p class="text-xl font-bold text-blue-700 mt-1">Rp <?php echo number_format($saldoAkhir, 0, ',', '.'); ?></p>
            </div>
        </div>

        <!-- Tabel Rincian Keuangan -->
        <div class="mb-10">
            <h3 class="font-bold text-gray-800 mb-4 text-lg">Rincian Transaksi Keuangan</h3>
            <table class="min-w-full divide-y divide-gray-300 border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Kategori & Uraian</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700">Jenis</th>
                        <th class="px-4 py-3 text-right font-semibold text-gray-700">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if(count($riwayat) > 0): ?>
                        <?php foreach($riwayat as $row): ?>
                        <tr>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap"><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                            <td class="px-4 py-3">
                                <div class="font-bold text-gray-800"><?php echo htmlspecialchars($row['kategori']); ?></div>
                                <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row['keterangan']); ?></div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="font-semibold uppercase text-xs <?php echo $row['jenis'] == 'pemasukan' ? 'text-emerald-700' : 'text-red-600'; ?>">
                                    <?php echo $row['jenis']; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right font-bold whitespace-nowrap <?php echo $row['jenis'] == 'pemasukan' ? 'text-emerald-700' : 'text-red-600'; ?>">
                                <?php echo ($row['jenis'] == 'pemasukan' ? '+ ' : '- '); ?>Rp <?php echo number_format($row['nominal'], 0, ',', '.'); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-400 italic">Belum ada data keuangan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tanda Tangan Pengurus -->
        <div class="flex justify-between items-end text-sm text-gray-600 pt-6 border-t mt-12">
            <div>
                <p>Laporan ini sah dan dihasilkan secara otomatis oleh sistem.</p>
                <p>LAINZAKKAINA Digital Platform.</p>
            </div>
            <div class="text-center">
                <p class="mb-16 font-bold text-gray-800">Mengetahui, <br>Direktur Keuangan / Amil</p>
                <p class="font-bold text-emerald-900 border-b border-gray-400 pb-1 px-8">( Tim Pengelola )</p>
            </div>
        </div>

        <!-- Tombol Aksi (Hilang saat diprint) -->
        <div class="mt-8 text-center no-print flex space-x-4">
            <button onclick="window.print()" class="flex-1 bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3 rounded-xl transition shadow">
                🖨️ Download / Cetak ke PDF
            </button>
            <a href="keuangan.php" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition text-center">
                Kembali ke Panel Keuangan
            </a>
        </div>

    </div>

</body>
</html>