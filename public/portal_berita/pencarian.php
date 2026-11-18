<?php
// pencarian.php
require_once 'config/database.php';

$keyword = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

// Cari berita berdasarkan judul atau isi konten
$query = "SELECT posts.*, categories.name AS kategori, users.name AS penulis 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          LEFT JOIN users ON posts.author_id = users.id 
          WHERE (posts.title LIKE '%$keyword%' OR posts.content LIKE '%$keyword%') 
          AND posts.status = 'published' 
          ORDER BY posts.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian: "<?= htmlspecialchars($keyword) ?>" - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-2 font-bold text-emerald-900 text-lg">
                <img src="assets/ypp.png" alt="Logo" class="w-8 h-8 object-contain">
                <span>Portal Pesantren</span>
            </a>
            <a href="index.php" class="text-sm text-emerald-700 font-semibold hover:underline">Kembali ke Beranda</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-xl font-bold text-gray-800 mb-2">Hasil Pencarian untuk: "<span class="text-emerald-700"><?= htmlspecialchars($keyword) ?></span>"</h1>
        <p class="text-xs text-gray-500 mb-8">Ditemukan <?= $result->num_rows ?> artikel yang sesuai.</p>

        <div class="space-y-4">
            <?php if($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="bg-white rounded-lg shadow-sm border p-4 flex flex-col md:flex-row gap-4 items-start">
                    <div class="w-full md:w-48 h-32 bg-gray-100 rounded overflow-hidden shrink-0">
                        <?php $img = !empty($row['image']) ? "assets/uploads/" . $row['image'] : "https://via.placeholder.com/300x200"; ?>
                        <img src="<?= $img ?>" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded font-bold uppercase"><?= $row['kategori'] ?? 'Umum' ?></span>
                        <h2 class="font-bold text-base text-gray-900 mt-1 mb-2">
                            <a href="artikel.php?slug=<?= $row['slug'] ?>" class="hover:text-emerald-700"><?= $row['title'] ?></a>
                        </h2>
                        <p class="text-xs text-gray-600 line-clamp-2 mb-2"><?= strip_tags($row['content']) ?></p>
                        <span class="text-[10px] text-gray-400">Dipublikasikan pada <?= date('d M Y', strtotime($row['created_at'])) ?></span>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="bg-white rounded-lg shadow-sm border p-8 text-center text-gray-500">
                    <p>Maaf, artikel yang Anda cari tidak ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>