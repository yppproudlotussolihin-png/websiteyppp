<?php
// File: admin/transaksi.php
require_once '../config/database.php';
require_once 'cek_login.php';

// Ambil semua data donasi urut dari yang terbaru
$stmt = $pdo->query("SELECT d.*, p.judul as nama_program FROM donasi d LEFT JOIN program p ON d.program_id = p.id ORDER BY d.created_at DESC");
$donasiList = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Donasi - LAINZAKKAINA</title>
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
                <a href="transaksi.php" class="block py-2.5 px-4 bg-emerald-800 rounded-lg font-semibold">Kelola Donasi</a>
                <a href="program.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Kelola Program</a>
                <a href="keuangan.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Arus Keuangan</a>
            </nav>
        </div>
        <div class="mt-8 pt-6 border-t border-emerald-800">
            <a href="logout.php" class="block py-2 px-4 text-red-200 bg-red-900/40 hover:bg-red-900 rounded-lg transition text-center text-sm font-semibold">
                Keluar (Logout)
            </a>
        </div>
    </aside>

    <main class="flex-1 p-4 sm:p-8 overflow-x-hidden">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 sm:mb-8">Daftar Transaksi Masuk</h1>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu & TRX</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Donatur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal & Program</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if(count($donasiList) > 0): ?>
                            <?php foreach($donasiList as $row): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-800"><?php echo htmlspecialchars($row['transaction_id']); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo date('d M Y, H:i', strtotime($row['created_at'])); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-800">
                                        <?php echo htmlspecialchars($row['nama_donatur']); ?>
                                        <?php if($row['is_anonim']) echo '<span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded ml-1">Anonim</span>'; ?>
                                    </div>
                                    <div class="text-xs text-gray-500"><?php echo htmlspecialchars($row['whatsapp']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-emerald-600">Rp <?php echo number_format($row['nominal'], 0, ',', '.'); ?></div>
                                    <div class="text-xs text-gray-500 truncate max-w-[200px]"><?php echo htmlspecialchars($row['nama_program'] ?? 'Donasi Umum / Zakat'); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($row['status_pembayaran'] == 'pending'): ?>
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold uppercase">Pending</span>
                                    <?php elseif($row['status_pembayaran'] == 'success'): ?>
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold uppercase">Sukses</span>
                                    <?php elseif($row['status_pembayaran'] == 'cancelled'): ?>
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold uppercase">Dibatalkan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center gap-1 mb-2">
                                        <?php if($row['status_pembayaran'] == 'pending'): ?>
                                            <a href="approve.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Verifikasi dan masukkan dana ini ke kas resmi?')" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded-lg transition shadow-sm inline-block">Verifikasi</a>
                                            <a href="hapus-transaksi.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus transaksi pending ini?')" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg transition shadow-sm inline-block">Hapus</a>
                                        
                                        <?php elseif($row['status_pembayaran'] == 'success'): ?>
                                            <a href="batalkan-transaksi.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Batalkan transaksi ini dan koreksi kas?')" class="text-white bg-amber-600 hover:bg-amber-700 px-3 py-1.5 rounded-lg transition shadow-sm inline-block">Batalkan</a>
                                        
                                        <?php elseif($row['status_pembayaran'] == 'cancelled'): ?>
                                            <a href="approve-ulang.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Pulihkan dan konfirmasi ulang transaksi ini menjadi sukses?')" class="text-white bg-emerald-600 hover:bg-emerald-700 px-3 py-1.5 rounded-lg transition shadow-sm inline-block">Konfirmasi Ulang</a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex justify-center gap-2">
                                        <?php if(!empty($row['bukti_transfer'])): ?>
                                            <a href="../assets/uploads/<?php echo $row['bukti_transfer']; ?>" target="_blank" class="text-xs text-blue-600 hover:underline font-semibold bg-blue-50 px-2 py-1 rounded border border-blue-200">🔍 Bukti</a>
                                        <?php endif; ?>
                                        <a href="cetak-kwitansi-admin.php?trx=<?php echo $row['transaction_id']; ?>" target="_blank" class="text-xs text-emerald-700 hover:underline font-semibold bg-emerald-50 px-2 py-1 rounded border border-emerald-200">📄 Kuitansi</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">Belum ada transaksi masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>