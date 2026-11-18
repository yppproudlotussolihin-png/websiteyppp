<?php
// File: index.php
require_once 'config/database.php';

// --- 1. QUERY STATISTIK REAL-TIME ---
// Mengambil total dana dari donasi yang sukses
$stmtDana = $pdo->query("SELECT SUM(nominal) as total FROM donasi WHERE status_pembayaran = 'success'");
$totalDana = $stmtDana->fetch()['total'] ?? 0;

// Mengambil total transaksi/donatur sukses
$stmtDonatur = $pdo->query("SELECT COUNT(id) as total FROM donasi WHERE status_pembayaran = 'success'");
$totalDonatur = $stmtDonatur->fetch()['total'] ?? 0;

// Mengambil jumlah program aktif
$stmtProgram = $pdo->query("SELECT COUNT(id) as total FROM program WHERE status = 'aktif'");
$totalProgram = $stmtProgram->fetch()['total'] ?? 0;

// --- 2. QUERY PROGRAM UNGGULAN ---
// Mengambil 3 program terbaru yang statusnya aktif
$stmtFeatured = $pdo->query("SELECT * FROM program WHERE status = 'aktif' ORDER BY id DESC LIMIT 3");
$programs = $stmtFeatured->fetchAll();

require_once 'includes/header.php';
?>

<!-- ===================================
     LOADER STYLING & HTML
=================================== -->
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

<!-- LOADER (Diletakkan di posisi paling atas setelah body) -->
<div id="loader">
    <div class="loader-container">
        <div class="spinner-blue"></div>
        <div class="spinner-orange"></div>
        <img src="../../images/ypp.png" alt="Logo Yayasan" class="loader-logo">
    </div>
</div>

<!-- HERO SECTION -->
<section class="relative bg-lzGreen py-24 overflow-hidden">
    <!-- Dekorasi Background -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
            <defs><pattern id="pattern" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M0 40L40 0H20L0 20M40 40V20L20 40" fill="#ffffff" fill-opacity="0.4" fill-rule="evenodd"/></pattern></defs>
            <rect width="100%" height="100%" fill="url(#pattern)"/>
        </svg>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-serif font-bold text-white leading-tight mb-6">
            Tunaikan Zakat, <br> <span class="text-lzGold">Tebarkan Manfaat</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto mb-10">
            Bersama LAINZAKKAINA, salurkan zakat, infak, dan sedekah Anda untuk menghadirkan manfaat dan harapan nyata bagi sesama.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
            <a href="#kalkulator" class="bg-lzEmerald hover:bg-emerald-600 text-white px-8 py-3 rounded-full font-bold text-lg shadow-lg transition">
                Tunaikan Zakat
            </a>
            <a href="program.php" class="bg-white hover:bg-gray-100 text-lzGreen px-8 py-3 rounded-full font-bold text-lg shadow-lg transition">
                Donasi Sekarang
            </a>
        </div>
    </div>
</section>

<!-- STATISTIK SECTION -->
<section class="bg-white py-12 -mt-8 relative z-10 mx-4 md:mx-auto max-w-5xl rounded-2xl shadow-xl">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center px-4">
        <div>
            <h3 class="text-3xl font-bold text-lzGreen">Rp <?php echo number_format($totalDana / 1000000, 1, ',', '.'); ?>M+</h3>
            <p class="text-gray-500 font-medium mt-1">Dana Terhimpun</p>
        </div>
        <div>
            <h3 class="text-3xl font-bold text-lzGreen"><?php echo number_format($totalDonatur, 0, ',', '.'); ?>+</h3>
            <p class="text-gray-500 font-medium mt-1">Donatur</p>
        </div>
        <div>
            <h3 class="text-3xl font-bold text-lzGreen">12.800+</h3> <!-- Bisa dinamis jika ada tabel penerima manfaat -->
            <p class="text-gray-500 font-medium mt-1">Penerima Manfaat</p>
        </div>
        <div>
            <h3 class="text-3xl font-bold text-lzGreen"><?php echo $totalProgram; ?></h3>
            <p class="text-gray-500 font-medium mt-1">Program Aktif</p>
        </div>
    </div>
</section>

<!-- KALKULATOR ZAKAT SECTION -->
<section id="kalkulator" class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-lzGreen mb-4">Kalkulator Zakat Penghasilan</h2>
            <p class="text-gray-600">Hitung kewajiban zakat Anda berdasarkan standar nisab (Setara 85 gram emas/tahun).</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Penghasilan per bulan (Rp)</label>
                    <input type="number" id="penghasilan" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald" placeholder="Contoh: 8000000">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Pendapatan lain per bulan (Rp)</label>
                    <input type="number" id="pendapatan_lain" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald" placeholder="Contoh: 1000000">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Pengeluaran / Kebutuhan Pokok (Rp)</label>
                    <input type="number" id="pengeluaran" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald" placeholder="Contoh: 3000000">
                </div>
                
                <button onclick="hitungZakat()" class="w-full bg-lzGreen text-white font-bold py-4 rounded-lg hover:bg-emerald-800 transition">
                    Hitung Zakat Saya
                </button>
            </div>

            <div id="hasil-box" class="mt-8 bg-emerald-50 border border-lzEmerald rounded-lg p-6 text-center hidden">
                <p class="text-gray-600 mb-2">Zakat yang harus ditunaikan per bulan:</p>
                <h3 id="hasil-zakat" class="text-4xl font-bold text-lzGreen mb-4">Rp 0</h3>
                <a href="zakat.php" class="inline-block bg-lzGold hover:bg-yellow-500 text-lzGreen font-bold px-8 py-3 rounded-full transition shadow">
                    Bayar Zakat Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAM UNGGULAN SECTION -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-serif font-bold text-lzGreen mb-2">Program Kebaikan</h2>
                <p class="text-gray-600">Pilih program dan jadilah jalan kebaikan bagi mereka.</p>
            </div>
            <a href="program.php" class="text-lzEmerald font-semibold hover:underline hidden sm:block">Lihat Semua Program &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if(count($programs) > 0): ?>
                <?php foreach($programs as $prog): 
                    $persen = ($prog['target_dana'] > 0) ? ($prog['dana_terkumpul'] / $prog['target_dana']) * 100 : 0;
                    if($persen > 100) $persen = 100;
                ?>
                <!-- Card Program -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden">
                    <!-- Placeholder gambar (karena gambar aslinya belum diupload) -->
                    <div class="h-48 bg-gray-200 relative">
                        <span class="absolute top-4 left-4 bg-white px-3 py-1 text-xs font-bold text-lzGreen rounded-full shadow">Program Sosial</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($prog['judul']); ?></h3>
                        
                        <div class="mt-6">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-500">Terkumpul</span>
                                <span class="font-bold text-lzGreen">Rp <?php echo number_format($prog['dana_terkumpul'], 0, ',', '.'); ?></span>
                            </div>
                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                <div class="bg-lzEmerald h-2.5 rounded-full" style="width: <?php echo $persen; ?>%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>Target: Rp <?php echo number_format($prog['target_dana'], 0, ',', '.'); ?></span>
                                <span><?php echo round($persen); ?>%</span>
                            </div>
                        </div>
                        
                        <a href="detail-program.php?slug=<?php echo $prog['slug']; ?>" class="mt-6 block w-full text-center border-2 border-lzGreen text-lzGreen hover:bg-lzGreen hover:text-white font-semibold py-2 rounded-lg transition">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-10 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Belum ada program aktif saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="mt-8 text-center sm:hidden">
            <a href="program.php" class="text-lzEmerald font-semibold hover:underline">Lihat Semua Program &rarr;</a>
        </div>
    </div>
</section>

<!-- SCRIPT KALKULATOR ZAKAT & LOADER -->
<script>
function hitungZakat() {
    let penghasilan = parseFloat(document.getElementById('penghasilan').value) || 0;
    let pendapatanLain = parseFloat(document.getElementById('pendapatan_lain').value) || 0;
    let pengeluaran = parseFloat(document.getElementById('pengeluaran').value) || 0;

    let totalPendapatan = (penghasilan + pendapatanLain) - pengeluaran;
    
    // Standar Nisab Zakat Penghasilan (Misal: Rp 8.231.272/bulan berdasarkan SK Baznas 2024)
    let nisabBulanan = 8231272; 
    let hasilZakat = 0;

    let hasilBox = document.getElementById('hasil-box');
    let hasilText = document.getElementById('hasil-zakat');

    if (totalPendapatan >= nisabBulanan) {
        hasilZakat = totalPendapatan * 0.025; // 2.5%
        hasilText.innerText = formatRupiah(hasilZakat);
        hasilText.classList.remove('text-red-500');
        hasilText.classList.add('text-lzGreen');
    } else {
        hasilText.innerText = "Belum mencapai Nisab";
        hasilText.classList.remove('text-lzGreen');
        hasilText.classList.add('text-red-500');
    }

    // Tampilkan box hasil
    hasilBox.classList.remove('hidden');
}

function formatRupiah(angka) {
    return 'Rp ' + angka.toLocaleString('id-ID', {maximumFractionDigits: 0});
}

// SCRIPT LOADER (Menghilangkan loader saat halaman selesai dimuat)
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

<?php require_once 'includes/footer.php'; ?>