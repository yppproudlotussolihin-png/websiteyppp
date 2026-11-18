<?php
// File: detail-berita.php
require_once 'config/database.php';

if (!isset($_GET['slug'])) {
    header("Location: berita.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM berita WHERE slug = :slug LIMIT 1");
$stmt->execute([':slug' => $_GET['slug']]);
$artikel = $stmt->fetch();

if (!$artikel) {
    die("Artikel tidak ditemukan.");
}

require_once 'includes/header.php';
?>

<section class="py-16 bg-white min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Artikel -->
        <div class="mb-8 text-center">
            <span class="bg-emerald-100 text-lzGreen text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-4 inline-block">
                <?php echo str_replace('_', ' ', $artikel['kategori']); ?>
            </span>
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-4 leading-tight">
                <?php echo htmlspecialchars($artikel['judul']); ?>
            </h1>
            <p class="text-sm text-gray-500">
                Oleh <span class="font-semibold text-gray-700"><?php echo htmlspecialchars($artikel['penulis']); ?></span> | Dipublikasikan pada <?php echo date('d M Y', strtotime($artikel['created_at'])); ?>
            </p>
        </div>

        <div class="h-72 bg-gray-200 rounded-2xl mb-8"></div>

        <!-- Konten Artikel -->
        <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6 text-lg">
            <p><?php echo nl2br(htmlspecialchars($artikel['konten'])); ?></p>
        </div>

        <div class="mt-12 pt-6 border-t">
            <a href="berita.php" class="text-lzEmerald font-semibold hover:underline">&larr; Kembali ke Berita & Artikel</a>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>