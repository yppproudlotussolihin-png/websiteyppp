<?php
// admin/komentar.php
require_once '../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($_GET['action'] == 'approve') {
        $conn->query("UPDATE comments SET status = 'approved' WHERE id = $id");
    } elseif ($_GET['action'] == 'delete') {
        $conn->query("DELETE FROM comments WHERE id = $id");
    }
    header("Location: komentar.php");
    exit;
}

$query = "SELECT comments.*, posts.title AS judul_berita FROM comments JOIN posts ON comments.post_id = posts.id ORDER BY comments.created_at DESC";
$komentar = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi Komentar - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <div @click="sidebarOpen = false" x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-800 text-white flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto shrink-0">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-700">
            <h1 class="text-xl font-bold">Ruang Redaksi</h1>
            <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white focus:outline-none"><i class="fas fa-times text-xl"></i></button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2 text-sm overflow-y-auto">
            <a href="index.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-home mr-2"></i> Dashboard</a>
            <a href="berita.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-newspaper mr-2"></i> Kelola Berita</a>
            <a href="kategori.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-tags mr-2"></i> Kategori & Rubrik</a>
            <a href="komentar.php" class="block px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition"><i class="fas fa-comments mr-2"></i> Komentar</a>
            <a href="pengaturan.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-cog mr-2"></i> Pengaturan</a>
        </nav>
        <div class="p-4 border-t border-slate-700">
            <a href="logout.php" class="block text-center px-4 py-2 bg-red-600 rounded hover:bg-red-700 transition"><i class="fas fa-sign-out-alt mr-2"></i> Keluar</a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto w-full">
        <header class="h-16 bg-white shadow flex items-center justify-between px-4 md:px-6 shrink-0">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-700 focus:outline-none text-xl p-1"><i class="fas fa-bars"></i></button>
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">Moderasi Komentar</h2>
            </div>
            <div class="flex items-center"><span class="text-xs md:text-sm text-gray-600">Halo, <strong><?= $_SESSION['admin_name'] ?? 'Admin'; ?></strong></span></div>
        </header>

        <div class="p-4 md:p-6">
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-gray-50 border-b text-xs text-gray-600 uppercase">
                            <th class="p-4">Pengirim</th>
                            <th class="p-4">Komentar & Artikel</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php if($komentar->num_rows > 0): ?>
                            <?php while($row = $komentar->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4 align-top">
                                    <p class="font-bold text-gray-800"><?= htmlspecialchars($row['name']) ?></p>
                                    <p class="text-xs text-gray-400"><?= htmlspecialchars($row['email']) ?></p>
                                    <p class="text-[10px] text-gray-400 mt-1"><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></p>
                                </td>
                                <td class="p-4 align-top max-w-md">
                                    <p class="text-xs text-emerald-700 font-semibold mb-1">Pada: <?= htmlspecialchars($row['judul_berita']) ?></p>
                                    <p class="text-gray-600 text-xs bg-gray-50 p-2.5 rounded border"><?= nl2br(htmlspecialchars($row['body'])) ?></p>
                                </td>
                                <td class="p-4 align-top">
                                    <?php if($row['status'] == 'approved'): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">Disetujui</span>
                                    <?php else: ?>
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-center align-top space-x-2">
                                    <?php if($row['status'] == 'pending'): ?>
                                        <a href="komentar.php?action=approve&id=<?= $row['id'] ?>" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700 inline-block mb-1"><i class="fas fa-check"></i> Setujui</a>
                                    <?php endif; ?>
                                    <a href="komentar.php?action=delete&id=<?= $row['id'] ?>" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 inline-block" onclick="return confirm('Hapus komentar ini?');"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="p-8 text-center text-gray-500 text-sm">Belum ada komentar masuk.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>