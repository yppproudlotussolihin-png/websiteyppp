<?php
// File: legalitas.php
require_once 'config/database.php';
require_once 'includes/header.php';
?>

<!-- Header Legalitas -->
<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Legalitas & Perizinan Lembaga</h1>
        <p class="text-emerald-100 text-lg">Komitmen legalitas formal LAINZAKKAINA sebagai wujud akuntabilitas dan kepercayaan publik.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Intro Card -->
        <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12 border border-gray-100 text-center max-w-3xl mx-auto">
            <h2 class="text-2xl font-serif font-bold text-gray-800 mb-4">Lembaga Resmi & Terdaftar</h2>
            <p class="text-gray-600 leading-relaxed">
                LAINZAKKAINA beroperasi di bawah payung hukum yang sah sesuai dengan peraturan perundang-undangan Republik Indonesia yang berlaku mengenai pengelolaan dana zakat, infak, dan sedekah.
            </p>
        </div>

        <!-- Grid Dokumen Legalitas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Dokumen 1 -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 bg-emerald-100 text-lzGreen rounded-2xl flex items-center justify-center font-bold text-xl mb-6">📄</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Akta Pendirian Yayasan</h3>
                    <p class="text-sm font-semibold text-lzEmerald mb-4">No. 01 Tahun 2026</p>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Akta notaris pendirian badan hukum lembaga pengelola sosial dan keagamaan.</p>
                </div>
                <div class="border-t pt-4 flex justify-between items-center text-xs">
                    <span class="text-gray-400">Status Dokumen</span>
                    <span class="bg-emerald-100 text-lzGreen font-bold px-3 py-1 rounded-full">Resmi / Sah</span>
                </div>
            </div>

            <!-- Dokumen 2 -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 bg-emerald-100 text-lzGreen rounded-2xl flex items-center justify-center font-bold text-xl mb-6">🏛️</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">SK Kemenkumham</h3>
                    <p class="text-sm font-semibold text-lzEmerald mb-4">AHU-00123.AH.01.04. Tahun 2026</p>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Pengesahan badan hukum resmi dari Kementerian Hukum dan Hak Asasi Manusia.</p>
                </div>
                <div class="border-t pt-4 flex justify-between items-center text-xs">
                    <span class="text-gray-400">Status Dokumen</span>
                    <span class="bg-emerald-100 text-lzGreen font-bold px-3 py-1 rounded-full">Terverifikasi</span>
                </div>
            </div>

            <!-- Dokumen 3 -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 bg-emerald-100 text-lzGreen rounded-2xl flex items-center justify-center font-bold text-xl mb-6">📜</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Izin Operasional BAZNAS</h3>
                    <p class="text-sm font-semibold text-lzEmerald mb-4">No. 99/LAZ/2026</p>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">Rekomendasi dan izin operasional resmi penghimpunan dana ZIS tingkat nasional.</p>
                </div>
                <div class="border-t pt-4 flex justify-between items-center text-xs">
                    <span class="text-gray-400">Status Dokumen</span>
                    <span class="bg-emerald-100 text-lzGreen font-bold px-3 py-1 rounded-full">Aktif</span>
                </div>
            </div>

        </div>

        <!-- Call to Action / Info Tambahan -->
        <div class="bg-emerald-50 border border-lzEmerald rounded-2xl p-8 text-center max-w-3xl mx-auto">
            <h3 class="font-bold text-lzGreen text-lg mb-2">Transparansi Kredibilitas</h3>
            <p class="text-gray-600 text-sm">
                Salinan dokumen fisik legalitas lembaga dapat diperiksa secara langsung di kantor pusat LAINZAKKAINA pada jam kerja atau melalui layanan pesan singkat kami.
            </p>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>