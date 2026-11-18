<?php
// galeri.php
require_once 'config/database.php';
$settings_query = $conn->query("SELECT * FROM settings");
$settings = [];
while($row = $settings_query->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto & Video - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-lg overflow-hidden flex items-center justify-center bg-white shadow-sm border">
                    <img src="assets/ypp.png" alt="Logo Pesantren" class="w-full h-full object-contain">
                </div>
                <div><h1 class="text-lg font-bold text-emerald-900"><?= $settings['nama_yayasan'] ?></h1></div>
            </a>
            <a href="index.php" class="text-sm text-emerald-700 font-semibold hover:underline"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 space-y-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full font-bold uppercase">Dokumentasi</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2">Galeri Kegiatan Santri</h2>
            <p class="text-xs text-gray-500 mt-1">Potret kesehabatan, kegiatan belajar, kajian rutin, dan suasana asrama pondok pesantren.</p>
        </div>

        <!-- Grid Galeri Foto -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden group">
                <div class="h-56 bg-gray-200 overflow-hidden relative">
                    <img src="https://via.placeholder.com/600x400" alt="Kegiatan Santri" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-4">
                    <span class="text-[10px] text-emerald-700 font-bold uppercase">Kajian Kitab</span>
                    <h3 class="font-bold text-sm text-gray-800 mt-1">Pengajian Bandongan Kitab Kuning Bersama Pengasuh</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden group">
                <div class="h-56 bg-gray-200 overflow-hidden relative">
                    <img src="https://via.placeholder.com/600x400" alt="Ekstrakurikuler" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-4">
                    <span class="text-[10px] text-emerald-700 font-bold uppercase">Ekstrakurikuler</span>
                    <h3 class="font-bold text-sm text-gray-800 mt-1">Pelatihan Khitobah & Pidato Tiga Bahasa Santri</h3>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden group">
                <div class="h-56 bg-gray-200 overflow-hidden relative">
                    <img src="https://via.placeholder.com/600x400" alt="Fasilitas" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-4">
                    <span class="text-[10px] text-emerald-700 font-bold uppercase">Fasilitas</span>
                    <h3 class="font-bold text-sm text-gray-800 mt-1">Suasana Asrama Putra dan Perpustakaan Pesantren</h3>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>
</body>
</html>