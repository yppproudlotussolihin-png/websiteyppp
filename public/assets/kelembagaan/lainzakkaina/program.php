<?php
// File: program.php
require_once 'config/database.php';

// Ambil filter kategori jika ada dari URL
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

// Query dasar untuk mengambil program aktif
$sql = "SELECT p.*, k.nama_kategori, k.tipe FROM program p JOIN kategori k ON p.kategori_id = k.id WHERE p.status = 'aktif'";
$params = [];

// Tambahkan kondisi jika ada filter kategori
if (!empty($kategori_filter)) {
    $sql .= " AND p.kategori_id = :kat";
    $params[':kat'] = $kategori_filter;
}

// Tambahkan kondisi jika ada pencarian judul
if (!empty($cari)) {
    $sql .= " AND p.judul LIKE :cari";
    $params[':cari'] = "%$cari%";
}

$sql .= " ORDER BY p.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$programs = $stmt->fetchAll();

// Ambil semua kategori untuk tombol filter
$kategoriList = $pdo->query("SELECT * FROM kategori")->fetchAll();

require_once 'includes/header.php';
?>

<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Program Kebaikan</h1>
        <p class="text-emerald-100 text-lg">Pilih jalan kebaikan Anda hari ini. Bersama kita wujudkan harapan bagi sesama.</p>
        
        <!-- Kotak Pencarian -->
        <form action="program.php" method="GET" class="mt-8 max-w-xl mx-auto flex">
            <input type="text" name="cari" value="<?php echo htmlspecialchars($cari); ?>" placeholder="Cari program (cth: Yatim, Pendidikan, Sembako)..." class="flex-grow px-4 py-3 rounded-l-xl text-gray-800 focus:outline-none">
            <button type="submit" class="bg-lzGold hover:bg-yellow-500 text-lzGreen font-bold px-6 rounded-r-xl transition">Cari</button>
        </form>
    </div>
</section>

<section class="py-16 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Tombol Kategori -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <a href="program.php" class="px-5 py-2 rounded-full text-sm font-semibold transition <?php echo empty($kategori_filter) && empty($cari) ? 'bg-lzGreen text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'; ?>">
                Semua Program
            </a>
            <?php foreach($kategoriList as $kat): ?>
                <a href="program.php?kategori=<?php echo $kat['id']; ?>" class="px-5 py-2 rounded-full text-sm font-semibold transition <?php echo ($kategori_filter == $kat['id']) ? 'bg-lzGreen text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'; ?>">
                    <?php echo htmlspecialchars($kat['nama_kategori']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Grid Program -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if(count($programs) > 0): ?>
                <?php foreach($programs as $prog): 
                    $persen = ($prog['target_dana'] > 0) ? ($prog['dana_terkumpul'] / $prog['target_dana']) * 100 : 0;
                    if($persen > 100) $persen = 100;
                ?>
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden flex flex-col">
                    
                    <!-- Kotak Banner / Gambar Program -->
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        <?php if(!empty($prog['gambar'])): ?>
                            <img src="assets/uploads/<?php echo htmlspecialchars($prog['gambar']); ?>" alt="<?php echo htmlspecialchars($prog['judul']); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm font-medium bg-gray-100">
                                <span>Tanpa Foto Banner</span>
                            </div>
                        <?php endif; ?>
                        
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 text-xs font-bold text-lzGreen rounded-full shadow">
                            <?php echo htmlspecialchars($prog['nama_kategori']); ?>
                        </span>
                    </div>

                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            <a href="detail-program.php?slug=<?php echo $prog['slug']; ?>" class="hover:text-lzEmerald transition">
                                <?php echo htmlspecialchars($prog['judul']); ?>
                            </a>
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-4"><?php echo htmlspecialchars($prog['deskripsi']); ?></p>
                        
                        <div class="mt-auto">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-500">Terkumpul</span>
                                <span class="font-bold text-lzGreen">Rp <?php echo number_format($prog['dana_terkumpul'], 0, ',', '.'); ?></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                <div class="bg-lzEmerald h-2.5 rounded-full" style="width: <?php echo $persen; ?>%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>Target: Rp <?php echo number_format($prog['target_dana'], 0, ',', '.'); ?></span>
                                <span><?php echo round($persen); ?>%</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 pt-0 mt-auto space-y-2">
                        <a href="detail-program.php?slug=<?php echo $prog['slug']; ?>" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 rounded-lg transition text-sm">
                            Lihat Detail
                        </a>
                        <a href="donasi.php?program=<?php echo $prog['id']; ?>" class="block w-full text-center border-2 border-lzGreen text-lzGreen hover:bg-lzGreen hover:text-white font-semibold py-2 rounded-lg transition text-sm">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-20 bg-gray-50 rounded-2xl">
                    <p class="text-gray-500 text-lg">Maaf, program yang Anda cari tidak ditemukan.</p>
                    <a href="program.php" class="inline-block mt-4 text-lzEmerald font-semibold hover:underline">Reset Pencarian</a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>