<?php
// File: zakat.php
require_once 'config/database.php';
require_once 'includes/header.php';
?>

<!-- Header Zakat -->
<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Layanan & Kalkulator Zakat</h1>
        <p class="text-emerald-100 text-lg">Tunaikan kewajiban penyucian harta Anda dengan mudah, transparan, dan tepat sasaran.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Bagian 1: Kalkulator Zakat Interaktif -->
        <div id="kalkulator" class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <div class="text-center mb-10">
                <span class="bg-emerald-100 text-lzGreen text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full mb-3 inline-block">Kalkulator Digital</span>
                <h2 class="text-3xl font-serif font-bold text-gray-800">Kalkulator Zakat Penghasilan</h2>
                <p class="text-gray-500 mt-2">Hitung besaran zakat profesi berdasarkan standar nisab bulanan (Setara 85 gram emas).</p>
            </div>

            <div class="space-y-6 max-w-2xl mx-auto">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Pendapatan / Gaji per Bulan (Rp)</label>
                    <input type="number" id="penghasilan" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald" placeholder="Contoh: 10000000">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Pendapatan Lain / Bonus per Bulan (Rp)</label>
                    <input type="number" id="pendapatan_lain" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald" placeholder="Contoh: 2000000">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Pengeluaran / Kebutuhan Pokok per Bulan (Rp)</label>
                    <input type="number" id="pengeluaran" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-lzEmerald focus:ring-1 focus:ring-lzEmerald" placeholder="Contoh: 4000000">
                </div>
                
                <button onclick="hitungZakatZakatPage()" class="w-full bg-lzGreen hover:bg-emerald-800 text-white font-bold py-4 rounded-xl transition shadow-md">
                    Hitung Zakat Saya
                </button>
            </div>

            <!-- Hasil Kalkulator -->
            <div id="hasil-box-zakat" class="mt-8 bg-emerald-50 border border-lzEmerald rounded-2xl p-8 text-center hidden max-w-2xl mx-auto">
                <p class="text-gray-600 mb-2">Zakat yang wajib ditunaikan per bulan:</p>
                <h3 id="hasil-zakat-text" class="text-4xl font-bold text-lzGreen mb-6">Rp 0</h3>
                <a href="donasi.php?jenis=zakat" class="inline-block bg-lzGold hover:bg-yellow-500 text-lzGreen font-bold px-8 py-3 rounded-xl transition shadow">
                    Tunaikan Zakat Sekarang
                </a>
            </div>
        </div>

        <!-- Bagian 2: Jenis-jenis Zakat -->
        <div>
            <div class="text-center mb-10">
                <h2 class="text-3xl font-serif font-bold text-gray-800">Jenis-Jenis Zakat</h2>
                <p class="text-gray-500 mt-2">Mengenal berbagai macam kewajiban zakat dalam Islam.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Zakat Penghasilan -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-emerald-100 text-lzGreen rounded-xl flex items-center justify-center font-bold text-xl mb-4">01</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Zakat Penghasilan</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Zakat yang dikenakan atas setiap pekerjaan atau keahlian profesional tertentu yang mendatangkan penghasilan rutin dengan syarat mencapai nisab.</p>
                </div>

                <!-- Zakat Maal -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-emerald-100 text-lzGreen rounded-xl flex items-center justify-center font-bold text-xl mb-4">02</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Zakat Maal (Harta)</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Zakat yang dikenakan atas harta yang dimiliki seperti emas, perak, uang simpanan, surat berharga, dan aset kekayaan lainnya yang telah mencapai haul dan nisab.</p>
                </div>

                <!-- Zakat Perdagangan -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-emerald-100 text-lzGreen rounded-xl flex items-center justify-center font-bold text-xl mb-4">03</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Zakat Perdagangan</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Zakat yang dikeluarkan dari harta niaga (aset perdagangan yang diperjualbelikan) setelah berjalan selama satu tahun penuh (haul) dan mencapai nisab.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Script Kalkulator Halaman Zakat -->
<script>
function hitungZakatZakatPage() {
    let penghasilan = parseFloat(document.getElementById('penghasilan').value) || 0;
    let pendapatanLain = parseFloat(document.getElementById('pendapatan_lain').value) || 0;
    let pengeluaran = parseFloat(document.getElementById('pengeluaran').value) || 0;

    let totalPendapatan = (penghasilan + pendapatanLain) - pengeluaran;
    let nisabBulanan = 8231272; // Standar nisab bulanan
    let hasilZakat = 0;

    let hasilBox = document.getElementById('hasil-box-zakat');
    let hasilText = document.getElementById('hasil-zakat-text');

    if (totalPendapatan >= nisabBulanan) {
        hasilZakat = totalPendapatan * 0.025; // 2.5%
        hasilText.innerText = 'Rp ' + hasilZakat.toLocaleString('id-ID', {maximumFractionDigits: 0});
        hasilText.classList.remove('text-red-500');
        hasilText.classList.add('text-lzGreen');
    } else {
        hasilText.innerText = "Belum mencapai Nisab (Min. Rp 8,2 Juta/bulan)";
        hasilText.classList.remove('text-lzGreen');
        hasilText.classList.add('text-red-500');
    }

    hasilBox.classList.remove('hidden');
}
</script>

<?php require_once 'includes/footer.php'; ?>