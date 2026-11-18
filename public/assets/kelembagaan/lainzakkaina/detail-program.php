<?php
// File: detail-program.php
require_once 'config/database.php';

if (!isset($_GET['slug'])) {
    header("Location: program.php");
    exit;
}

// Ambil data program
$stmt = $pdo->prepare("SELECT * FROM program WHERE slug = :slug");
$stmt->execute([':slug' => $_GET['slug']]);
$program = $stmt->fetch();

if (!$program) die("Program tidak ditemukan.");

// Hitung persentase
$persen = ($program['target_dana'] > 0) ? ($program['dana_terkumpul'] / $program['target_dana']) * 100 : 0;
if ($persen > 100) $persen = 100;

// Ambil daftar 5 donatur terakhir yang sukses di program ini
$stmtDonatur = $pdo->prepare("SELECT nama_donatur, nominal, is_anonim, created_at FROM donasi WHERE program_id = :pid AND status_pembayaran = 'success' ORDER BY created_at DESC LIMIT 5");
$stmtDonatur->execute([':pid' => $program['id']]);
$donatur = $stmtDonatur->fetchAll();

require_once 'includes/header.php';
?>

<section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col md:flex-row">
            <!-- Bagian Kiri: Gambar & Cerita -->
            <div class="md:w-2/3 p-8 border-r border-gray-100">
                
                <!-- Kotak Gambar Program -->
                <div class="h-64 md:h-80 bg-gray-200 rounded-xl mb-6 flex items-center justify-center text-gray-400 overflow-hidden relative shadow-inner">
                    <?php if(!empty($program['gambar'])): ?>
                        <img src="assets/uploads/<?php echo htmlspecialchars($program['gambar']); ?>" alt="<?php echo htmlspecialchars($program['judul']); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-medium">Tanpa Foto Dokumentasi</span>
                        </div>
                    <?php endif; ?>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo htmlspecialchars($program['judul']); ?></h1>
                <div class="prose max-w-none text-gray-600">
                    <p><?php echo nl2br(htmlspecialchars($program['deskripsi'])); ?></p>
                </div>
            </div>

            <!-- Bagian Kanan: Progress & Donasi -->
            <div class="md:w-1/3 p-8 bg-gray-50">
                <p class="text-gray-500 mb-1">Dana Terkumpul</p>
                <h2 class="text-3xl font-bold text-emerald-600 mb-4">Rp <?php echo number_format($program['dana_terkumpul'], 0, ',', '.'); ?></h2>
                
                <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                    <div class="bg-emerald-500 h-3 rounded-full" style="width: <?php echo $persen; ?>%"></div>
                </div>
                
                <div class="flex justify-between text-sm text-gray-500 mb-8">
                    <span>Terkumpul <?php echo round($persen); ?>%</span>
                    <span>Target: Rp <?php echo number_format($program['target_dana'], 0, ',', '.'); ?></span>
                </div>

                <a href="donasi.php?program=<?php echo $program['id']; ?>" class="block w-full text-center bg-yellow-400 hover:bg-yellow-500 text-emerald-900 font-bold py-3 rounded-xl mb-8 transition shadow-sm">
                    Donasi Sekarang
                </a>

                <!-- Riwayat Donatur -->
                <h3 class="font-bold text-gray-800 mb-4">Donatur Terbaru</h3>
                <div class="space-y-4">
                    <?php if(count($donatur) > 0): ?>
                        <?php foreach($donatur as $d): ?>
                        <div class="flex items-center border-b pb-2">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-bold mr-3">
                                <?php echo $d['is_anonim'] ? 'H' : substr($d['nama_donatur'], 0, 1); ?>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-gray-800"><?php echo $d['is_anonim'] ? 'Hamba Allah' : htmlspecialchars($d['nama_donatur']); ?></p>
                                <p class="text-xs text-emerald-600">Berdonasi Rp <?php echo number_format($d['nominal'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 italic">Belum ada donatur. Jadilah yang pertama!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>