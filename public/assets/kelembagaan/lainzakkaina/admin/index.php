<?php
// File: admin/index.php
require_once '../config/database.php';
require_once 'cek_login.php';

// 1. Hitung total donasi sukses & jumlah donatur
$stmtDonasi = $pdo->query("SELECT COUNT(*) as total_transaksi, SUM(CASE WHEN status_pembayaran = 'success' THEN nominal ELSE 0 END) as total_dana_sukses FROM donasi");
$rekapDonasi = $stmtDonasi->fetch();

// 2. Hitung total program aktif
$stmtProgram = $pdo->query("SELECT COUNT(*) as total_program FROM program WHERE status = 'aktif'");
$totalProgram = $stmtProgram->fetch()['total_program'];

// 3. Hitung total saldo kas bersih dari laporan keuangan
$stmtKas = $pdo->query("SELECT 
    SUM(CASE WHEN jenis = 'pemasukan' THEN nominal ELSE 0 END) as masuk,
    SUM(CASE WHEN jenis = 'pengeluaran' THEN nominal ELSE 0 END) as keluar
    FROM laporan_keuangan");
$rekapKas = $stmtKas->fetch();
$saldoKasBersih = ($rekapKas['masuk'] ?? 0) - ($rekapKas['keluar'] ?? 0);

// 4. Ambil 5 transaksi terbaru yang perlu perhatian (pending)
$stmtPending = $pdo->query("SELECT * FROM donasi WHERE status_pembayaran = 'pending' ORDER BY created_at DESC LIMIT 5");
$pendingList = $stmtPending->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - LAINZAKKAINA</title>
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
                <a href="index.php" class="block py-2.5 px-4 bg-emerald-800 rounded-lg font-semibold">Dashboard</a>
                <a href="transaksi.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Kelola Donasi</a>
                <a href="program.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Kelola Program</a>
                <a href="keuangan.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Arus Keuangan</a>
            </nav>
        </div>
        <div class="mt-8 pt-6 border-t border-emerald-800">
            <div class="mb-3 px-2">
                <p class="text-xs text-emerald-300">Masuk sebagai:</p>
                <p class="font-bold text-sm truncate text-white"><?php echo htmlspecialchars($_SESSION['admin_nama'] ?? 'Administrator'); ?></p>
            </div>
            <a href="logout.php" class="block py-2 px-4 text-red-200 bg-red-900/40 hover:bg-red-900 rounded-lg transition text-center text-sm font-semibold">
                Keluar (Logout)
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-8 overflow-x-hidden">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Dashboard Utama</h1>
                <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, Amil Pengelola LAINZAKKAINA.</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-xl shadow-sm text-sm text-gray-600 font-medium border whitespace-nowrap">
                📅 <?php echo date('d M Y'); ?>
            </div>
        </div>

        <!-- Kartu Statistik Utama -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-emerald-600">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Dana Masuk</p>
                <h3 class="text-xl sm:text-2xl font-bold text-emerald-700 mt-2">Rp <?php echo number_format($rekapDonasi['total_dana_sukses'] ?? 0, 0, ',', '.'); ?></h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-600">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Saldo Kas Bersih</p>
                <h3 class="text-xl sm:text-2xl font-bold text-blue-700 mt-2">Rp <?php echo number_format($saldoKasBersih, 0, ',', '.'); ?></h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-yellow-500">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Program Aktif</p>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mt-2"><?php echo $totalProgram; ?> Program</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-purple-600">
                <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Transaksi</p>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mt-2"><?php echo $rekapDonasi['total_transaksi']; ?> TRX</h3>
            </div>
        </div>

        <!-- Tabel Perhatian: Donasi Pending -->
        <div class="bg-white rounded-2xl shadow-sm mb-8 border border-gray-100">
            <div class="p-6 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Menunggu Verifikasi</h3>
                    <p class="text-xs text-gray-500">Daftar donasi terbaru yang statusnya masih pending.</p>
                </div>
                <a href="transaksi.php" class="text-xs text-emerald-700 font-bold hover:underline">Lihat Semua &rarr;</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu & TRX</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Donatur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        <?php if(count($pendingList) > 0): ?>
                            <?php foreach($pendingList as $row): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-bold text-gray-800"><?php echo $row['transaction_id']; ?></span>
                                    <div class="text-xs text-gray-400"><?php echo date('d M Y, H:i', strtotime($row['created_at'])); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-bold text-gray-800"><?php echo htmlspecialchars($row['nama_donatur']); ?></span>
                                    <div class="text-xs text-gray-400"><?php echo $row['whatsapp']; ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-emerald-600">
                                    Rp <?php echo number_format($row['nominal'], 0, ',', '.'); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                    <a href="approve.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Verifikasi transaksi ini?')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm inline-block">Verifikasi</a>
                                    <a href="transaksi.php" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg text-xs font-bold transition inline-block">Detail</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Alhamdulillah, tidak ada antrean donasi pending.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>