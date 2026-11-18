<?php
// File: berita.php
require_once 'config/database.php';

// Ambil filter kategori jika ada
$filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$sql = "SELECT * FROM berita";
$params = [];

if (!empty($filter)) {
    $sql .= " WHERE kategori = :kat";
    $params[':kat'] = $filter;
}

$sql .= " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$beritaList = $stmt->fetchAll();

require_once 'includes/header.php';
?>

<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Berita & Edukasi Zakat</h1>
        <p class="text-emerald-100 text-lg">Informasi terbaru seputar kegiatan penyaluran, artikel keislaman, dan edukasi zakat umat.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Kategori Artikel -->
        <div class="flex justify-center gap-3 mb-12">
            <a href="berita.php" class="px-5 py-2 rounded-full text-sm font-semibold transition <?php echo empty($filter) ? 'bg-lzGreen text-white' : 'bg-white text-gray-600 hover:bg-gray-100 shadow-sm'; ?>">
                Semua
            </a>
            <a href="berita.php?kategori=berita" class="px-5 py-2 rounded-full text-sm font-semibold transition <?php echo ($filter == 'berita') ? 'bg-lzGreen text-white' : 'bg-white text-gray-600 hover:bg-gray-100 shadow-sm'; ?>">
                Berita Kegiatan
            </a>
            <a href="berita.php?kategori=edukasi" class="px-5 py-2 rounded-full text-sm font-semibold transition <?php echo ($filter == 'edukasi') ? 'bg-lzGreen text-white' : 'bg-white text-gray-600 hover:bg-gray-100 shadow-sm'; ?>">
                Edukasi Zakat
            </a>
            <a href="berita.php?kategori=kisah_sukses" class="px-5 py-2 rounded-full text-sm font-semibold transition <?php echo ($filter == 'kisah_sukses') ? 'bg-lzGreen text-white' : 'bg-white text-gray-600 hover:bg-gray-100 shadow-sm'; ?>">
                Kisah Penerima Manfaat
            </a>
        </div>

        <!-- Grid Artikel -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(count($beritaList) > 0): ?>
                <?php foreach($beritaList as $b): ?>
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100 flex flex-col">
                    <div class="h-48 bg-gray-200"></div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-gray-400 mb-2">
                                <span class="uppercase font-bold text-lzEmerald tracking-wider"><?php echo str_replace('_', ' ', $b['kategori']); ?></span>
                                <span><?php echo date('d M Y', strtotime($b['created_at'])); ?></span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-lzEmerald transition">
                                <a href="detail-berita.php?slug=<?php echo $b['slug']; ?>"><?php echo htmlspecialchars($b['judul']); ?></a>
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4"><?php echo htmlspecialchars($b['konten']); ?></p>
                        </div>
                        <a href="detail-berita.php?slug=<?php echo $b['slug']; ?>" class="text-lzGreen font-semibold text-sm hover:underline inline-flex items-center">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-16 text-gray-400 italic">
                    Belum ada artikel atau berita yang dipublikasikan.
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>