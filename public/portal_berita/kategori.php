<?php
// kategori.php
require_once 'config/database.php';

// Ambil pengaturan situs
$settings_query = $conn->query("SELECT * FROM settings");
$settings = [];
while($row = $settings_query->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Ambil slug kategori dari URL
$slug = isset($_GET['slug']) ? $conn->real_escape_string($_GET['slug']) : '';

// Ambil data kategori
$cat_query = $conn->query("SELECT * FROM categories WHERE slug = '$slug'");
if ($cat_query->num_rows == 0) {
    header("Location: index.php");
    exit;
}
$category = $cat_query->fetch_assoc();
$cat_id = $category['id'];

// Ambil semua berita berdasarkan kategori ini
$query = "SELECT posts.*, users.name AS penulis 
          FROM posts 
          LEFT JOIN users ON posts.author_id = users.id 
          WHERE posts.category_id = $cat_id AND posts.status = 'published' 
          ORDER BY posts.created_at DESC";
$berita = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrik <?= $category['name'] ?> - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Header Sederhana -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-lg overflow-hidden flex items-center justify-center bg-white shadow-sm border">
                    <img src="assets/ypp.png" alt="Logo Pesantren" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-lg font-bold text-emerald-900"><?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></h1>
                    <p class="text-xs text-gray-500">Rubrik Khusus</p>
                </div>
            </a>
            <a href="index.php" class="text-sm text-emerald-700 font-semibold hover:underline"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <!-- Judul Rubrik -->
        <div class="bg-emerald-900 text-white rounded-xl p-8 mb-8 shadow-sm">
            <span class="text-xs uppercase tracking-widest bg-emerald-700 px-3 py-1 rounded font-bold">Rubrik Khusus</span>
            <h2 class="text-3xl font-bold mt-2"><?= $category['name'] ?></h2>
            <p class="text-emerald-200 text-xs mt-1">Kumpulan artikel, catatan, dan informasi seputar <?= strtolower($category['name']) ?>.</p>
        </div>

        <!-- Daftar Artikel -->
        <div class="space-y-4">
            <?php if($berita->num_rows > 0): ?>
                <?php while($row = $berita->fetch_assoc()): ?>
                <div class="bg-white rounded-lg shadow-sm border p-4 flex flex-col md:flex-row gap-4 items-start hover:shadow-md transition">
                    <div class="w-full md:w-48 h-32 bg-gray-100 rounded overflow-hidden shrink-0">
                        <?php $img = !empty($row['image']) ? "assets/uploads/" . $row['image'] : "https://via.placeholder.com/300x200"; ?>
                        <img src="<?= $img ?>" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="font-bold text-base text-gray-900 mb-2">
                            <a href="artikel.php?slug=<?= $row['slug'] ?>" class="hover:text-emerald-700"><?= $row['title'] ?></a>
                        </h3>
                        <p class="text-xs text-gray-600 line-clamp-2 mb-3"><?= strip_tags($row['content']) ?></p>
                        <div class="flex items-center text-[10px] text-gray-400 space-x-3">
                            <span><i class="fas fa-calendar-alt mr-1"></i> <?= date('d M Y', strtotime($row['created_at'])) ?></span>
                            <span><i class="fas fa-user mr-1"></i> <?= $row['penulis'] ?? 'Admin' ?></span>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="bg-white rounded-lg shadow-sm border p-8 text-center text-gray-500">
                    <p class="text-sm">Belum ada artikel yang diterbitkan dalam rubrik ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>
</body>
</html>