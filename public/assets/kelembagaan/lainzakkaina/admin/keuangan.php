<?php
// File: admin/keuangan.php
require_once '../config/database.php';
require_once 'cek_login.php';

$pesan = '';

// Proses tambah data keuangan manual
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $jenis = $_POST['jenis']; // pemasukan / pengeluaran
    $kategori = htmlspecialchars($_POST['kategori']);
    $nominal = filter_var($_POST['nominal'], FILTER_SANITIZE_NUMBER_FLOAT);

    try {
        $stmt = $pdo->prepare("INSERT INTO laporan_keuangan (tanggal, keterangan, jenis, kategori, nominal) VALUES (:tgl, :ket, :jenis, :kat, :nom)");
        $stmt->execute([
            ':tgl' => $tanggal,
            ':ket' => $keterangan,
            ':jenis' => $jenis,
            ':kat' => $kategori,
            ':nom' => $nominal
        ]);
        $pesan = "Catatan keuangan berhasil ditambahkan!";
    } catch (PDOException $e) {
        $pesan = "Error: " . $e->getMessage();
    }
}

// Ambil ringkasan total pemasukan & pengeluaran kas
$stmtTotal = $pdo->query("SELECT 
    SUM(CASE WHEN jenis = 'pemasukan' THEN nominal ELSE 0 end) as total_masuk,
    SUM(CASE WHEN jenis = 'pengeluaran' THEN nominal ELSE 0 end) as total_keluar
    FROM laporan_keuangan");
$rekap = $stmtTotal->fetch();
$saldoAkhir = ($rekap['total_masuk'] ?? 0) - ($rekap['total_keluar'] ?? 0);

// Ambil riwayat catatan keuangan
$riwayat = $pdo->query("SELECT * FROM laporan_keuangan ORDER BY tanggal DESC, id DESC LIMIT 50")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Keuangan - Admin LAINZAKKAINA</title>
    <link rel="icon"
          type="image/png"
          href="../../../images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col md:flex-row min-h-screen">
    
    <!-- Mobile Header -->
    <div class="md:hidden bg-emerald-900 text-white p-4 flex justify-between items-center shadow-md shrink-0">
        <h2 class="text-xl font-bold">Admin Panel</h2>
        <button onclick="document.getElementById('admin-sidebar').classList.toggle('hidden')" class="focus:outline-none p-1">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="hidden md:flex w-full md:w-64 bg-emerald-900 text-white p-6 flex-col justify-between shrink-0 min-h-screen">
        <div>
            <h2 class="text-2xl font-bold mb-8 hidden md:block">Admin Panel</h2>
            <nav class="space-y-3">
                <a href="index.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Dashboard</a>
                <a href="transaksi.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Kelola Donasi</a>
                <a href="program.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Kelola Program</a>
                <a href="keuangan.php" class="block py-2.5 px-4 bg-emerald-800 rounded-lg font-semibold">Arus Keuangan</a>
            </nav>
        </div>
        <div class="mt-8 pt-6 border-t border-emerald-800">
            <a href="logout.php" class="block py-2 px-4 text-red-200 bg-red-900/40 hover:bg-red-900 rounded-lg transition text-center text-sm font-semibold">
                Keluar (Logout)
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-8 overflow-x-hidden">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Arus Keuangan Kas</h1>
            <a href="cetak-laporan.php" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl transition shadow flex items-center text-sm whitespace-nowrap">
                📄 Download PDF
            </a>
        </div>

        <?php if($pesan): ?>
            <div class="bg-emerald-100 text-emerald-800 p-4 rounded-lg mb-6 border border-emerald-200"><?php echo $pesan; ?></div>
        <?php endif; ?>

        <!-- Kartu Ringkasan Keuangan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                <p class="text-gray-500 text-sm font-semibold">Total Pemasukan Kas</p>
                <h3 class="text-xl sm:text-2xl font-bold text-green-600 mt-1">Rp <?php echo number_format($rekap['total_masuk'] ?? 0, 0, ',', '.'); ?></h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500">
                <p class="text-gray-500 text-sm font-semibold">Total Pengeluaran</p>
                <h3 class="text-xl sm:text-2xl font-bold text-red-600 mt-1">Rp <?php echo number_format($rekap['total_keluar'] ?? 0, 0, ',', '.'); ?></h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                <p class="text-gray-500 text-sm font-semibold">Saldo Kas Bersih</p>
                <h3 class="text-xl sm:text-2xl font-bold text-blue-600 mt-1">Rp <?php echo number_format($saldoAkhir, 0, ',', '.'); ?></h3>
            </div>
        </div>

        <!-- Form Input Transaksi Kas -->
        <div class="bg-white p-6 rounded-xl shadow-sm mb-8 border border-gray-100">
            <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4">Tambah Catatan Arus Kas</h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Jenis Arus</label>
                    <select name="jenis" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran / Penyaluran</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Kategori</label>
                    <input type="text" name="kategori" placeholder="Cth: Operasional" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Keterangan / Uraian</label>
                    <input type="text" name="keterangan" placeholder="Cth: Pembelian sembako" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Nominal (Rp)</label>
                    <input type="number" name="nominal" placeholder="500000" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div class="md:col-span-3 pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-lg shadow transition">Simpan Catatan Kas</button>
                </div>
            </form>
        </div>

        <!-- Tabel Riwayat Keuangan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
            <div class="p-6 border-b">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800">Riwayat Arus Kas Terbaru</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori & Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        <?php if(count($riwayat) > 0): ?>
                            <?php foreach($riwayat as $row): ?>
                            <tr>
                                <td class="px-6 py-4 text-gray-600 whitespace-nowrap"><?php echo date('d M Y', strtotime($row['tanggal'])); ?></td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800"><?php echo htmlspecialchars($row['kategori']); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row['keterangan']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($row['jenis'] == 'pemasukan'): ?>
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold uppercase">Pemasukan</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold uppercase">Pengeluaran</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right font-bold whitespace-nowrap <?php echo $row['jenis'] == 'pemasukan' ? 'text-green-600' : 'text-red-600'; ?>">
                                    <?php echo ($row['jenis'] == 'pemasukan' ? '+ ' : '- '); ?>Rp <?php echo number_format($row['nominal'], 0, ',', '.'); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400 italic">Belum ada catatan arus kas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>