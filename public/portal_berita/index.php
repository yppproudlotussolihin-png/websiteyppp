<?php
// index.php
require_once 'config/database.php';

// Ambil pengaturan situs dari database
$settings_query = $conn->query("SELECT * FROM settings");
$settings = [];
while($row = $settings_query->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Ambil data untuk Ticker Berita (Breaking News)
$ticker_query = $conn->query("SELECT title, slug FROM posts WHERE is_breaking_news = 1 AND status = 'published' ORDER BY created_at DESC LIMIT 5");

// Ambil data untuk Slider Hero
$slider_query = $conn->query("SELECT posts.*, categories.name AS kategori FROM posts LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.is_slider = 1 AND posts.status = 'published' ORDER BY posts.created_at DESC LIMIT 4");

// Ambil Grid Berita Terbaru
$berita_terbaru = $conn->query("SELECT posts.*, categories.name AS kategori, users.name AS penulis FROM posts LEFT JOIN categories ON posts.category_id = categories.id LEFT JOIN users ON posts.author_id = users.id WHERE posts.status = 'published' ORDER BY posts.created_at DESC LIMIT 6");

// Ambil Berita Pilihan Redaksi
$editors_pick = $conn->query("SELECT posts.*, categories.name AS kategori FROM posts LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.is_editors_pick = 1 AND posts.status = 'published' ORDER BY posts.created_at DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
    <link rel="icon"
          type="image/png"
          href="assets/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- CSS LOADER KHUSUS -->
    <style>
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999999;
            transition: opacity 0.8s ease, visibility 0.8s ease;
        }

        .loader-container {
            position: relative;
            width: 180px;
            height: 180px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader-logo {
            position: absolute;
            width: 90px;
            height: 90px;
            object-fit: contain;
            z-index: 10;
        }

        .spinner-blue {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 6px solid transparent;
            border-top-color: #2563eb;
            animation: spin 2s linear infinite;
            z-index: 5;
        }

        .spinner-orange {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 6px solid transparent;
            border-bottom-color: #f97316;
            animation: spin-reverse 1.5s linear infinite;
            z-index: 5;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes spin-reverse {
            0% { transform: rotate(360deg); }
            100% { transform: rotate(0deg); }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans overflow-x-hidden" x-data="{ mobileMenuOpen: false }">

    <!-- LOADER (Diletakkan paling atas di dalam body agar menutupi layar penuh) -->
    <div id="loader">
        <div class="loader-container">
            <div class="spinner-blue"></div>
            <div class="spinner-orange"></div>
            <img src="assets/ypp.png" alt="Logo Yayasan" class="loader-logo">
        </div>
    </div>

    <!-- TOPBAR / HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-50 w-full">
        <div class="bg-emerald-900 text-white text-xs py-2 px-4">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-1 sm:gap-0 text-center sm:text-left">
                <span><i class="fas fa-map-marker-alt mr-1"></i> <?= $settings['alamat'] ?? 'Alamat Pesantren' ?></span>
                <div class="space-x-3">
                    <a href="<?= $settings['instagram'] ?? '#' ?>" target="_blank" class="hover:text-emerald-300"><i class="fab fa-instagram"></i></a>
                    <a href="<?= $settings['youtube'] ?? '#' ?>" target="_blank" class="hover:text-emerald-300"><i class="fab fa-youtube"></i></a>
                    <a href="<?= $settings['facebook'] ?? '#' ?>" target="_blank" class="hover:text-emerald-300"><i class="fab fa-facebook"></i></a>
                    <a href="<?= $settings['tiktok'] ?? '#' ?>" target="_blank" class="hover:text-emerald-300"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3 overflow-hidden">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg overflow-hidden flex items-center justify-center bg-white shadow-sm border shrink-0">
                    <img src="assets/ypp.png" alt="Logo Pesantren" class="w-full h-full object-contain">
                </div>
                <div class="truncate">
                    <h1 class="text-base sm:text-xl font-bold text-emerald-900 truncate"><?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></h1>
                    <p class="text-[10px] sm:text-xs text-gray-500 truncate">Media Informasi & Dakwah Resmi</p>
                </div>
            </div>

            <!-- Bilah Pencarian Desktop -->
            <div class="hidden md:flex items-center">
                <form action="pencarian.php" method="GET" class="flex border rounded-lg overflow-hidden">
                    <input type="text" name="q" placeholder="Cari berita..." class="px-4 py-1.5 text-sm focus:outline-none">
                    <button type="submit" class="bg-emerald-700 text-white px-4 hover:bg-emerald-800"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <!-- Tombol Hamburger Mobile -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-emerald-900 focus:outline-none text-2xl p-1">
                    <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
                </button>
            </div>
        </div>

        <!-- Menu Navigasi Utama (Desktop) -->
        <nav class="bg-emerald-800 text-white shadow-md hidden md:block">
            <div class="max-w-7xl mx-auto px-4 flex flex-wrap text-sm font-medium">
                <a href="../index.html" class="px-4 py-3 hover:bg-emerald-700 transition">Beranda</a>
                <a href="tentang.php" class="px-4 py-3 hover:bg-emerald-700 transition">Tentang Kami</a>
                <a href="ppdb.php" class="px-4 py-3 hover:bg-emerald-700 transition">Program & PPDB</a>

                <!-- Dropdown Berita -->
                <div class="relative group py-3 px-4 hover:bg-emerald-700 cursor-pointer">
                    <span>Berita <i class="fas fa-chevron-down text-xs ml-1"></i></span>
                    <div class="absolute left-0 mt-3 w-48 bg-white text-gray-800 shadow-lg hidden group-hover:block rounded-b-lg border-t-2 border-emerald-600 z-50">
                        <a href="kategori.php?slug=berita-terkini" class="block px-4 py-2 hover:bg-gray-100 text-xs">Berita Terkini</a>
                        <a href="kategori.php?slug=pengumuman" class="block px-4 py-2 hover:bg-gray-100 text-xs">Pengumuman</a>
                        <a href="kategori.php?slug=kegiatan" class="block px-4 py-2 hover:bg-gray-100 text-xs">Kegiatan</a>
                    </div>
                </div>

                <!-- Dropdown Rubrik Khusus -->
                <div class="relative group py-3 px-4 hover:bg-emerald-700 cursor-pointer">
                    <span>Rubrik Khusus <i class="fas fa-chevron-down text-xs ml-1"></i></span>
                    <div class="absolute left-0 mt-3 w-52 bg-white text-gray-800 shadow-lg hidden group-hover:block rounded-b-lg border-t-2 border-emerald-600 z-50">
                        <a href="kategori.php?slug=artikel" class="block px-4 py-2 hover:bg-gray-100 text-xs">Artikel Umum</a>
                        <a href="kategori.php?slug=opini" class="block px-4 py-2 hover:bg-gray-100 text-xs">Opini</a>
                        <a href="kategori.php?slug=kajian" class="block px-4 py-2 hover:bg-gray-100 text-xs">Kajian Keislaman</a>
                        <a href="kategori.php?slug=kisah-inspiratif-alumni" class="block px-4 py-2 hover:bg-gray-100 text-xs">Kisah Inspiratif Alumni</a>
                    </div>
                </div>

                <!-- Dropdown Dawuh & Tuntunan -->
                <div class="relative group py-3 px-4 hover:bg-emerald-700 cursor-pointer">
                    <span>Dawuh & Tuntunan <i class="fas fa-chevron-down text-xs ml-1"></i></span>
                    <div class="absolute left-0 mt-3 w-48 bg-white text-gray-800 shadow-lg hidden group-hover:block rounded-b-lg border-t-2 border-emerald-600 z-50">
                        <a href="kategori.php?slug=dawuh-masyayikh" class="block px-4 py-2 hover:bg-gray-100 text-xs">Dawuh Masyayikh</a>
                        <a href="kategori.php?slug=tuntunan-ibadah" class="block px-4 py-2 hover:bg-gray-100 text-xs">Tuntunan Ibadah</a>
                    </div>
                </div>

                <a href="galeri.php" class="px-4 py-3 hover:bg-emerald-700 transition">Galeri</a>
                <a href="donasi.php" class="px-4 py-3 hover:bg-emerald-700 transition">Donasi</a>
                <a href="kontak.php" class="px-4 py-3 hover:bg-emerald-700 transition">Kontak</a>
            </div>
        </nav>

        <!-- Menu Navigasi Mobile (Full Animasi Dropdown dengan Alpine.js) -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-emerald-900 text-white px-4 pt-2 pb-6 space-y-2 text-sm shadow-xl border-t border-emerald-700 max-h-[80vh] overflow-y-auto">
            
            <!-- Pencarian Mobile -->
            <form action="pencarian.php" method="GET" class="flex border border-emerald-700 rounded-lg overflow-hidden bg-emerald-800 mb-4">
                <input type="text" name="q" placeholder="Cari berita..." class="w-full px-4 py-2 text-sm bg-transparent text-white placeholder-emerald-300 focus:outline-none">
                <button type="submit" class="bg-emerald-700 px-4 text-white"><i class="fas fa-search"></i></button>
            </form>

            <a href="../index.html" class="block py-2 px-3 rounded hover:bg-emerald-800 transition">Beranda</a>
            <a href="tentang.php" class="block py-2 px-3 rounded hover:bg-emerald-800 transition">Tentang Kami</a>
            <a href="ppdb.php" class="block py-2 px-3 rounded hover:bg-emerald-800 transition">Program & PPDB</a>

            <!-- Sub-menu Mobile: Berita -->
            <div x-data="{ openSub: false }" class="border-t border-emerald-800 pt-2">
                <button @click="openSub = !openSub" class="flex justify-between items-center w-full py-2 px-3 rounded hover:bg-emerald-800 transition text-left">
                    <span>Berita</span>
                    <i :class="openSub ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                </button>
                <div x-show="openSub" class="pl-4 space-y-1 mt-1 bg-emerald-950/40 rounded-lg py-2">
                    <a href="kategori.php?slug=berita-terkini" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Berita Terkini</a>
                    <a href="kategori.php?slug=pengumuman" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Pengumuman</a>
                    <a href="kategori.php?slug=kegiatan" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Kegiatan</a>
                </div>
            </div>

            <!-- Sub-menu Mobile: Rubrik Khusus -->
            <div x-data="{ openSub: false }" class="border-t border-emerald-800 pt-2">
                <button @click="openSub = !openSub" class="flex justify-between items-center w-full py-2 px-3 rounded hover:bg-emerald-800 transition text-left">
                    <span>Rubrik Khusus</span>
                    <i :class="openSub ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                </button>
                <div x-show="openSub" class="pl-4 space-y-1 mt-1 bg-emerald-950/40 rounded-lg py-2">
                    <a href="kategori.php?slug=artikel" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Artikel Umum</a>
                    <a href="kategori.php?slug=opini" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Opini</a>
                    <a href="kategori.php?slug=kajian" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Kajian Keislaman</a>
                    <a href="kategori.php?slug=kisah-inspiratif-alumni" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Kisah Inspiratif Alumni</a>
                </div>
            </div>

            <!-- Sub-menu Mobile: Dawuh & Tuntunan -->
            <div x-data="{ openSub: false }" class="border-t border-emerald-800 pt-2">
                <button @click="openSub = !openSub" class="flex justify-between items-center w-full py-2 px-3 rounded hover:bg-emerald-800 transition text-left">
                    <span>Dawuh & Tuntunan</span>
                    <i :class="openSub ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-xs"></i>
                </button>
                <div x-show="openSub" class="pl-4 space-y-1 mt-1 bg-emerald-950/40 rounded-lg py-2">
                    <a href="kategori.php?slug=dawuh-masyayikh" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Dawuh Masyayikh</a>
                    <a href="kategori.php?slug=tuntunan-ibadah" class="block py-1.5 px-3 rounded text-xs text-emerald-200 hover:text-white">Tuntunan Ibadah</a>
                </div>
            </div>

            <div class="border-t border-emerald-800 pt-2 space-y-1">
                <a href="galeri.php" class="block py-2 px-3 rounded hover:bg-emerald-800 transition">Galeri</a>
                <a href="donasi.php" class="block py-2 px-3 rounded hover:bg-emerald-800 transition">Donasi</a>
                <a href="kontak.php" class="block py-2 px-3 rounded hover:bg-emerald-800 transition">Kontak</a>
            </div>
        </div>
    </header>

    <!-- BREAKING NEWS TICKER -->
    <?php if($ticker_query->num_rows > 0): ?>
    <div class="bg-amber-100 border-b border-amber-200 py-2 px-4 text-xs">
        <div class="max-w-7xl mx-auto flex items-center overflow-hidden">
            <span class="bg-amber-600 text-white font-bold px-2 py-1 rounded mr-3 uppercase tracking-wider shrink-0">Breaking News</span>
            <marquee behavior="scroll" direction="left" class="text-amber-900 font-medium">
                <?php while($t = $ticker_query->fetch_assoc()): ?>
                    <span class="mx-6"><i class="fas fa-circle text-[6px] mr-2 text-amber-600"></i><a href="artikel.php?slug=<?= $t['slug'] ?>" class="hover:underline"><?= $t['title'] ?></a></span>
                <?php endwhile; ?>
            </marquee>
        </div>
    </div>
    <?php endif; ?>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- KOLOM UTAMA (KIRI & TENGAH - 2 COL) -->
        <div class="lg:col-span-2 space-y-10 min-w-0">
            
            <!-- HERO SLIDER / BERITA UTAMA -->
            <?php if($slider_query->num_rows > 0): ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden relative">
                <div class="relative h-72 sm:h-96 bg-gray-900">
                    <?php 
                    $slider_first = $slider_query->fetch_assoc();
                    $img_src = !empty($slider_first['image']) ? "assets/uploads/" . $slider_first['image'] : "https://via.placeholder.com/800x400";
                    ?>
                    <img src="<?= $img_src ?>" alt="Hero Image" class="w-full h-full object-cover opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-4 sm:p-6 text-white">
                        <span class="bg-emerald-600 text-[10px] sm:text-xs px-2.5 py-1 rounded w-max mb-2 font-semibold uppercase"><?= $slider_first['kategori'] ?? 'Umum' ?></span>
                        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold leading-tight mb-2">
                            <a href="artikel.php?slug=<?= $slider_first['slug'] ?>" class="hover:underline"><?= $slider_first['title'] ?></a>
                        </h2>
                        <p class="text-gray-300 text-xs sm:text-sm line-clamp-2"><?= strip_tags($slider_first['content']) ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- GRID BERITA TERBARU -->
            <section>
                <div class="flex justify-between items-center mb-6 border-b pb-2 border-gray-200">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 border-l-4 border-emerald-600 pl-3">Berita Terbaru</h3>
                    <a href="berita.php" class="text-emerald-700 text-xs sm:text-sm font-semibold hover:underline">Lihat Semua &rarr;</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <?php if($berita_terbaru->num_rows > 0): ?>
                        <?php while($b = $berita_terbaru->fetch_assoc()): ?>
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                            <div>
                                <div class="h-48 bg-gray-200 overflow-hidden">
                                    <?php $img = !empty($b['image']) ? "assets/uploads/" . $b['image'] : "https://via.placeholder.com/400x200"; ?>
                                    <img src="<?= $img ?>" alt="Thumbnail" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center text-xs text-gray-500 mb-2 space-x-2">
                                        <span class="text-emerald-700 font-bold"><?= $b['kategori'] ?? 'Umum' ?></span>
                                        <span>&bull;</span>
                                        <span><?= date('d M Y', strtotime($b['created_at'])) ?></span>
                                    </div>
                                    <h4 class="font-bold text-gray-800 text-sm sm:text-base mb-2 line-clamp-2">
                                        <a href="artikel.php?slug=<?= $b['slug'] ?>" class="hover:text-emerald-700"><?= $b['title'] ?></a>
                                    </h4>
                                    <p class="text-gray-600 text-xs line-clamp-2"><?= strip_tags($b['content']) ?></p>
                                </div>
                            </div>
                            <div class="px-4 pb-4 pt-0 text-xs text-gray-400">
                                Ditulis oleh: <?= $b['penulis'] ?? 'Admin' ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-gray-500 italic col-span-2">Belum ada berita dipublikasikan.</p>
                    <?php endif; ?>
                </div>
            </section>

        </div>

        <!-- SIDEBAR (KANAN - 1 COL) -->
        <aside class="space-y-8 min-w-0">
            
            <!-- KOTAK PILIHAN REDAKSI -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 border-emerald-600">Pilihan Redaksi</h3>
                <div class="space-y-4">
                    <?php if($editors_pick->num_rows > 0): ?>
                        <?php while($ep = $editors_pick->fetch_assoc()): ?>
                        <div class="flex space-x-3 items-start">
                            <div class="w-20 h-16 bg-gray-200 rounded shrink-0 overflow-hidden">
                                <?php $ep_img = !empty($ep['image']) ? "assets/uploads/" . $ep['image'] : "https://via.placeholder.com/100x80"; ?>
                                <img src="<?= $ep_img ?>" class="w-full h-full object-cover">
                            </div>
                            <div class="min-w-0">
                                <span class="text-[10px] text-emerald-700 font-bold uppercase"><?= $ep['kategori'] ?? 'Rubrik' ?></span>
                                <h4 class="text-xs font-bold text-gray-800 leading-snug line-clamp-2">
                                    <a href="artikel.php?slug=<?= $ep['slug'] ?>" class="hover:text-emerald-700"><?= $ep['title'] ?></a>
                                </h4>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-xs text-gray-500">Belum ada pilihan redaksi.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- WIDGET INFORMASI PESANTREN / PPDB -->
            <div class="bg-emerald-900 text-white rounded-xl shadow-md p-6 text-center">
                <h3 class="text-lg font-bold mb-2">Pendaftaran Santri Baru</h3>
                <p class="text-xs text-emerald-200 mb-4">Telah dibuka pendaftaran santri/santriwati baru tahun ajaran <?= date('Y') ?>/<?= date('Y')+1 ?>.</p>
                <a href="ppdb.php" class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs py-2.5 px-6 rounded-lg transition shadow">Daftar Sekarang</a>
            </div>

            <!-- KOTAK INFO / DAWUH MASYAYIKH -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-3 border-b pb-2 border-emerald-600">Dawuh Masyayikh</h3>
                <blockquote class="text-xs italic text-gray-600 border-l-2 border-amber-500 pl-3 py-1">
                    "Menuntut ilmu bukan sekadar mengisi kepala dengan pengetahuan, tapi membersihkan hati agar cahaya hikmah mudah masuk."
                </blockquote>
                <p class="text-right text-[10px] text-gray-400 mt-2">— Pengasuh Pondok</p>
            </div>

        </aside>

    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white mt-16 pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 text-sm">
            <div>
                <h4 class="font-bold text-base mb-3 text-emerald-400"><?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></h4>
                <p class="text-gray-400 text-xs leading-relaxed">Pusat informasi pendidikan, dakwah Islam Ahlussunnah wal Jamaah, dan kegiatan santri sehari-hari.</p>
            </div>
            <div>
                <h4 class="font-bold text-base mb-3 text-emerald-400">Kontak Kami</h4>
                <p class="text-gray-400 text-xs mb-2"><i class="fas fa-map-marker-alt mr-2"></i> <?= $settings['alamat'] ?? '-' ?></p>
                <p class="text-gray-400 text-xs mb-2"><i class="fab fa-whatsapp mr-2"></i> <?= $settings['whatsapp'] ?? '-' ?></p>
            </div>
            <div>
                <h4 class="font-bold text-base mb-3 text-emerald-400">Tautan Cepat</h4>
                <ul class="text-gray-400 text-xs space-y-1.5">
                    <li><a href="tentang.php" class="hover:text-white">Profil Yayasan</a></li>
                    <li><a href="ppdb.php" class="hover:text-white">Informasi PPDB</a></li>
                    <li><a href="kebijakan-privasi.php" class="hover:text-white">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-800 text-center text-xs text-gray-500 pt-6">
            &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?>. All Rights Reserved. | Developed by Miftah Fauzi
        </div>
    </footer>

    <!-- JAVASCRIPT LOADER -->
    <script>
        window.addEventListener("load", () => {
            const loader = document.getElementById("loader");
            if (loader) {
                setTimeout(() => {
                    loader.style.opacity = "0";
                    loader.style.visibility = "hidden";
                }, 800); // Loader menghilang mulus setelah 0.8 detik
            }
        });
    </script>
</body>
</html>