<?php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['action']) && isset($_GET['id'])) {$id = (int)$_GET['id'];$action = $_GET['action'];$status = 'pending';
    
    if ($action == 'approve')$status = 'approved';
    if ($action == 'reject')$status = 'rejected';

    $stmt =$conn->prepare("UPDATE `iktsaro-alumni-tb` SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);$stmt->execute();
    header("Location: index.php");
    exit;
}

$result =$conn->query("SELECT * FROM `iktsaro-alumni-tb` ORDER BY created_at DESC");
$admin_name = htmlspecialchars($_SESSION['admin_username'] ?? 'Admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin IKTSARO</title>
    <link rel="icon"
          type="image/png"
          href="../../../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800">

    <nav class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <img src="../../../images/iktsaro.png" alt="Logo" class="w-15 h-10 object-cover rounded-2xl ">
                    <span class="font-bold text-xl text-slate-800">Admin <span class="text-green-600">IKTSARO</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Menampilkan Sesi Admin -->
                    <div class="text-sm font-medium text-slate-600 border-r border-slate-200 pr-4">
                        Halo, <span class="text-green-600 font-bold"><?= $admin_name ?></span>
                    </div>
                    <a href="logout.php" class="text-sm font-medium text-slate-500 hover:text-red-600 transition-colors duration-200 px-3 py-1.5 rounded-lg hover:bg-red-50">Log Out</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Kisah Inspiratif Masuk</h1>
                <p class="text-slate-500 mt-1">Kelola dan tinjau data alumni yang telah mendaftar.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-sm uppercase tracking-wider text-slate-500 font-semibold">
                            <th class="p-5">Nama & Kontak</th>
                            <th class="p-5">Lulusan</th>
                            <th class="p-5">Pekerjaan</th>
                            <th class="p-5 text-center">Status</th>
                            <th class="p-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php while($row =$result->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <td class="p-5">
                                <div class="font-semibold text-slate-800"><?= htmlspecialchars($row['nama_lengkap']) ?></div>
                                <div class="text-sm text-slate-500"><?= htmlspecialchars($row['no_wa']) ?></div>
                            </td>
                            <td class="p-5">
                                <div class="font-medium text-slate-700"><?= htmlspecialchars($row['lembaga']) ?></div>
                                <div class="text-sm text-slate-500">Angkatan <?= htmlspecialchars($row['tahun_lulus']) ?></div>
                            </td>
                            <td class="p-5 text-slate-700"><?= htmlspecialchars($row['pekerjaan']) ?></td>
                            <td class="p-5 text-center">
                                <?php if($row['status'] == 'pending'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu</span>
                                <?php elseif($row['status'] == 'approved'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Dipublikasi</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-5 text-right space-x-2">
                                <a href="detail.php?id=<?= $row['id'] ?>" class="inline-block px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-sm font-medium transition-colors">Detail Lengkap</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>