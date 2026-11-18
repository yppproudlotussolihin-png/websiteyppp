<?php
// admin/berita.php
require_once '../config/database.php';

// Cek session
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Mengambil data berita beserta nama kategori dan penulisnya menggunakan JOIN
$query = "SELECT posts.*, categories.name AS kategori, users.name AS penulis 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          LEFT JOIN users ON posts.author_id = users.id 
          ORDER BY posts.created_at DESC";
$berita = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Berita - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Alpine.js untuk Toggle Sidebar Mobile -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- Overlay Gelap saat Sidebar Terbuka di HP -->
    <div @click="sidebarOpen = false" 
         x-show="sidebarOpen" 
         class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden">
    </div>

    <!-- Sidebar Responsif -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-800 text-white flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto shrink-0">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-700">
            <h1 class="text-xl font-bold">Ruang Redaksi</h1>
            <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2 text-sm overflow-y-auto">
            <a href="index.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            <a href="berita.php" class="block px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition">
                <i class="fas fa-newspaper mr-2"></i> Kelola Berita
            </a>
            <a href="kategori.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition">
                <i class="fas fa-tags mr-2"></i> Kategori & Rubrik
            </a>
            <a href="komentar.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition">
                <i class="fas fa-comments mr-2"></i> Komentar
            </a>
            <a href="pengaturan.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition">
                <i class="fas fa-cog mr-2"></i> Pengaturan
            </a>
        </nav>
        <div class="p-4 border-t border-slate-700">
            <a href="logout.php" class="block text-center px-4 py-2 bg-red-600 rounded hover:bg-red-700 transition">
                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto w-full">
        <!-- Topbar -->
        <header class="h-16 bg-white shadow flex items-center justify-between px-4 md:px-6 shrink-0">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-700 focus:outline-none text-xl p-1">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">Manajemen Berita</h2>
            </div>
            <div class="flex items-center">
                <span class="text-xs md:text-sm text-gray-600">Halo, <strong><?= $_SESSION['admin_name'] ?? 'Admin'; ?></strong></span>
            </div>
        </header>

        <div class="p-4 md:p-6">
            <!-- Tombol Tambah -->
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="text-lg font-medium text-gray-700">Daftar Artikel</h3>
                <a href="tambah_berita.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition text-sm">
                    <i class="fas fa-plus mr-2"></i> Tulis Berita Baru
                </a>
            </div>

            <!-- Tabel Data (Responsif dengan gulir horizontal otomatis di layar kecil) -->
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[650px]">
                    <thead>
                        <tr class="bg-gray-50 border-b text-xs text-gray-600 uppercase">
                            <th class="p-4 font-semibold">Judul Berita</th>
                            <th class="p-4 font-semibold">Kategori</th>
                            <th class="p-4 font-semibold">Status</th>
                            <th class="p-4 font-semibold">Tanggal</th>
                            <th class="p-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php if($berita->num_rows > 0): ?>
                            <?php while($row = $berita->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4 text-gray-800 font-medium">
                                    <?= htmlspecialchars($row['title']); ?>
                                </td>
                                <td class="p-4 text-gray-600"><?= $row['kategori'] ?? 'Tanpa Kategori'; ?></td>
                                <td class="p-4">
                                    <?php if($row['status'] == 'published'): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold uppercase">Published</span>
                                    <?php else: ?>
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold uppercase">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-gray-500 text-xs">
                                    <?= date('d M Y', strtotime($row['created_at'])); ?>
                                </td>
                                <td class="p-4 text-center space-x-2">
                                    <a href="edit_berita.php?id=<?= $row['id']; ?>" class="text-blue-500 hover:text-blue-700" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="hapus_berita.php?id=<?= $row['id']; ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Yakin hapus berita ini?');" title="Hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500 text-sm">Belum ada berita yang ditulis.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>