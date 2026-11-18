<?php
// admin/index.php
require_once '../config/database.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Mengambil data ringkasan untuk Dashboard
$jml_berita = $conn->query("SELECT COUNT(*) as total FROM posts")->fetch_assoc()['total'];
$jml_kategori = $conn->query("SELECT COUNT(*) as total FROM categories")->fetch_assoc()['total'];
$jml_komentar = $conn->query("SELECT COUNT(*) as total FROM comments WHERE status='pending'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Alpine.js untuk interaksi Toggle Sidebar Mobile -->
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
           class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-800 text-white flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-700">
            <h1 class="text-xl font-bold">Ruang Redaksi</h1>
            <!-- Tombol Close khusus tampilan mobile -->
            <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
            <a href="index.php" class="block px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            <a href="berita.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition">
                <i class="fas fa-newspaper mr-2"></i> Kelola Berita
            </a>
            <a href="kategori.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition">
                <i class="fas fa-tags mr-2"></i> Kategori & Rubrik
            </a>
            <a href="komentar.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition flex justify-between items-center">
                <span><i class="fas fa-comments mr-2"></i> Komentar</span>
                <?php if($jml_komentar > 0): ?>
                    <span class="bg-red-500 text-xs px-2 py-1 rounded-full"><?= $jml_komentar ?></span>
                <?php endif; ?>
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
                <!-- Tombol Hamburger untuk memunculkan sidebar di layar kecil -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-700 focus:outline-none text-xl p-1">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">Dashboard</h2>
            </div>
            <div class="flex items-center">
                <span class="text-xs md:text-sm text-gray-600">Halo, <strong><?= $_SESSION['admin_name']; ?></strong></span>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-4 md:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold">Total Berita</p>
                            <h3 class="text-3xl font-bold text-gray-800"><?= $jml_berita; ?></h3>
                        </div>
                        <i class="fas fa-newspaper text-3xl text-gray-300"></i>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold">Kategori / Rubrik</p>
                            <h3 class="text-3xl font-bold text-gray-800"><?= $jml_kategori; ?></h3>
                        </div>
                        <i class="fas fa-tags text-3xl text-gray-300"></i>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500 sm:col-span-2 md:col-span-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold">Komentar Pending</p>
                            <h3 class="text-3xl font-bold text-gray-800"><?= $jml_komentar; ?></h3>
                        </div>
                        <i class="fas fa-comments text-3xl text-gray-300"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold border-b pb-2 mb-4">Selamat Datang di Panel Redaksi</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Gunakan menu navigasi untuk mengelola berita, menyetujui komentar, dan mengatur tampilan website pesantren dengan mudah melalui berbagai perangkat.</p>
            </div>
        </div>
    </main>

</body>
</html>