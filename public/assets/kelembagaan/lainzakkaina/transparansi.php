<?php
// File: transparansi.php
require_once 'config/database.php';

// 1. Menghitung ringkasan dana masuk berdasarkan jenis_dana dari transaksi yang sukses
$stmt = $pdo->query("SELECT jenis_dana, SUM(nominal) as total FROM donasi WHERE status_pembayaran = 'success' GROUP BY jenis_dana");
$dana = [];
$total_masuk_donasi = 0;

while ($row = $stmt->fetch()) {
    $dana[$row['jenis_dana']] = $row['total'];
    $total_masuk_donasi += $row['total'];
}

$zakat = $dana['zakat'] ?? 0;
$infak = $dana['infak'] ?? 0;
$sedekah = $dana['sedekah'] ?? 0;

// Hitung persentase untuk bar visual
$persen_zakat = $total_masuk_donasi > 0 ? ($zakat / $total_masuk_donasi) * 100 : 0;
$persen_infak = $total_masuk_donasi > 0 ? ($infak / $total_masuk_donasi) * 100 : 0;
$persen_sedekah = $total_masuk_donasi > 0 ? ($sedekah / $total_masuk_donasi) * 100 : 0;

// 2. Mengambil total pengeluaran / penyaluran dari tabel laporan_keuangan
$stmtKeluar = $pdo->query("SELECT SUM(nominal) as total_keluar FROM laporan_keuangan WHERE jenis = 'pengeluaran'");
$total_penyaluran = $stmtKeluar->fetch()['total_keluar'] ?? 0;

// 3. Mengambil riwayat 5 penyaluran dana terbaru
$stmtRiwayatPenyaluran = $pdo->query("SELECT * FROM laporan_keuangan WHERE jenis = 'pengeluaran' ORDER BY tanggal DESC, id DESC LIMIT 5");
$riwayatPenyaluran = $stmtRiwayatPenyaluran->fetchAll();

require_once 'includes/header.php';
?>

<!-- Header Transparansi -->
<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Transparansi Dana Umat</h1>
        <p class="text-emerald-100 text-lg">Komitmen LAINZAKKAINA untuk menyajikan laporan penghimpunan dan penyaluran dana secara akurat dan akuntabel.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Grid Ringkasan Utama (Total Masuk & Total Disalurkan) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl shadow-sm p-8 border-l-4 border-lzEmerald">
                <p class="text-gray-500 font-semibold mb-1">Total Penghimpunan (Dana Masuk)</p>
                <h2 class="text-4xl font-bold text-lzGreen">Rp <?php echo number_format($total_masuk_donasi, 0, ',', '.'); ?></h2>
                <p class="text-xs text-gray-400 mt-2">Akumulasi dari seluruh transaksi Zakat, Infak, dan Sedekah sukses.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-8 border-l-4 border-lzGold">
                <p class="text-gray-500 font-semibold mb-1">Total Dana Disalurkan</p>
                <h2 class="text-4xl font-bold text-yellow-600">Rp <?php echo number_format($total_penyaluran, 0, ',', '.'); ?></h2>
                <p class="text-xs text-gray-400 mt-2">Akumulasi alokasi program kebaikan dan bantuan sosial.</p>
            </div>
        </div>

        <!-- Rincian per Jenis Dana & Visualisasi Proporsi -->
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <h3 class="text-2xl font-serif font-bold text-gray-800 mb-6">Komposisi Dana Umat</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-50 p-6 rounded-xl border">
                    <span class="text-xs font-bold text-blue-600 uppercase">Zakat</span>
                    <h4 class="text-2xl font-bold text-gray-800 mt-1 mb-2">Rp <?php echo number_format($zakat, 0, ',', '.'); ?></h4>
                    <span class="text-xs text-gray-500"><?php echo round($persen_zakat, 1); ?>% dari total dana</span>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl border">
                    <span class="text-xs font-bold text-lzEmerald uppercase">Infak</span>
                    <h4 class="text-2xl font-bold text-gray-800 mt-1 mb-2">Rp <?php echo number_format($infak, 0, ',', '.'); ?></h4>
                    <span class="text-xs text-gray-500"><?php echo round($persen_infak, 1); ?>% dari total dana</span>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl border">
                    <span class="text-xs font-bold text-yellow-600 uppercase">Sedekah</span>
                    <h4 class="text-2xl font-bold text-gray-800 mt-1 mb-2">Rp <?php echo number_format($sedekah, 0, ',', '.'); ?></h4>
                    <span class="text-xs text-gray-500"><?php echo round($persen_sedekah, 1); ?>% dari total dana</span>
                </div>
            </div>

            <!-- Multi-color Progress Bar Proporsi -->
            <div>
                <div class="flex justify-between text-xs text-gray-500 mb-2 font-semibold">
                    <span>Proporsi Pemasukan</span>
                    <span>100%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4 flex overflow-hidden">
                    <div class="bg-blue-600 h-full" style="width: <?php echo $persen_zakat; ?>%" title="Zakat: <?php echo round($persen_zakat, 1); ?>%"></div>
                    <div class="bg-lzEmerald h-full" style="width: <?php echo $persen_infak; ?>%" title="Infak: <?php echo round($persen_infak, 1); ?>%"></div>
                    <div class="bg-yellow-500 h-full" style="width: <?php echo $persen_sedekah; ?>%" title="Sedekah: <?php echo round($persen_sedekah, 1); ?>%"></div>
                </div>
                <div class="flex flex-wrap gap-4 text-xs text-gray-600 mt-3">
                    <div class="flex items-center"><span class="w-3 h-3 bg-blue-600 rounded-full inline-block mr-1.5"></span> Zakat</div>
                    <div class="flex items-center"><span class="w-3 h-3 bg-lzEmerald rounded-full inline-block mr-1.5"></span> Infak</div>
                    <div class="flex items-center"><span class="w-3 h-3 bg-yellow-500 rounded-full inline-block mr-1.5"></span> Sedekah</div>
                </div>
            </div>
        </div>

        <!-- Tabel Penyaluran Dana Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-8 border-b">
                <h3 class="text-2xl font-serif font-bold text-gray-800">Penyaluran Dana Terbaru</h3>
                <p class="text-gray-500 text-sm mt-1">Rekapitulasi alokasi penyaluran yang tercatat di pembukuan lembaga.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori & Uraian Penyaluran</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah Disalurkan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        <?php if(count($riwayatPenyaluran) > 0): ?>
                            <?php foreach($riwayatPenyaluran as $rp): ?>
                            <tr>
                                <td class="px-6 py-4 text-gray-600 whitespace-nowrap"><?php echo date('d M Y', strtotime($rp['tanggal'])); ?></td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800"><?php echo htmlspecialchars($rp['kategori']); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo htmlspecialchars($rp['keterangan']); ?></div>
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-red-600 whitespace-nowrap">
                                    - Rp <?php echo number_format($rp['nominal'], 0, ',', '.'); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-400 italic">Belum ada catatan penyaluran dana yang dipublikasikan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Catatan Keterangan -->
        <div class="bg-blue-50 text-blue-900 p-6 rounded-2xl text-center text-sm border border-blue-100">
            <p><strong>Komitmen Transparansi:</strong> Seluruh data di atas disinkronkan secara langsung dari basis data transaksi dan pembukuan internal LAINZAKKAINA guna menjaga amanah dari para donatur.</p>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>