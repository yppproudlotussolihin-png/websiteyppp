<?php
// berita.php (Halaman Arsip Publik)
require_once 'config/database.php';

$settings_query = $conn->query("SELECT * FROM settings");
$settings = [];
while($row = $settings_query->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Ambil semua berita yang sudah dipublikasikan
$query = "SELECT posts.*, categories.name AS kategori, users.name AS penulis 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          LEFT JOIN users ON posts.author_id = users.id 
          WHERE posts.status = 'published' 
          ORDER BY posts.created_at DESC";
$berita = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Berita & Informasi - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
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
                <div>
                    <h1 class="text-lg font-bold text-emerald-900"><?= $settings['nama_yayasan'] ?></h1>
                    <p class="text-xs text-gray-500">Arsip Berita Lengkap</p>
                </div>
            </a>
            <a href="index.php" class="text-sm text-emerald-700 font-semibold hover:underline"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        <div class="mb-8 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-900">Semua Berita & Pengumuman</h2>
            <p class="text-xs text-gray-500 mt-1">Daftar seluruh artikel, kegiatan, dan informasi resmi pondok pesantren.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if($berita->num_rows > 0): ?>
                <?php while($row = $berita->fetch_assoc()): ?>
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <?php $img = !empty($row['image']) ? "assets/uploads/" . $row['image'] : "https://via.placeholder.com/400x200"; ?>
                            <img src="<?= $img ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <div class="flex items-center text-xs text-gray-500 mb-2 space-x-2">
                                <span class="text-emerald-700 font-bold"><?= $row['kategori'] ?? 'Umum' ?></span>
                                <span>&bull;</span>
                                <span><?= date('d M Y', strtotime($row['created_at'])) ?></span>
                            </div>
                            <h3 class="font-bold text-gray-800 text-base mb-2 line-clamp-2">
                                <a href="artikel.php?slug=<?= $row['slug'] ?>" class="hover:text-emerald-700"><?= $row['title'] ?></a>
                            </h3>
                            <p class="text-gray-600 text-xs line-clamp-2"><?= strip_tags($row['content']) ?></p>
                        </div>
                    </div>
                    <div class="px-4 pb-4 pt-0 text-xs text-gray-400">
                        Ditulis oleh: <?= $row['penulis'] ?? 'Admin' ?>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-500 italic col-span-2 text-center py-8">Belum ada berita yang dipublikasikan.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>

</body>
</html>