<?php
// File: tentang.php
require_once 'config/database.php';
require_once 'includes/header.php';
?>

<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Tentang LAINZAKKAINA</h1>
        <p class="text-emerald-100 text-lg">Lembaga pengelola zakat, infak, dan sedekah yang amanah, profesional, dan transparan.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Visi Misi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-2xl font-serif font-bold text-lzGreen mb-4">Visi Lembaga</h2>
                <p class="text-gray-600 leading-relaxed bg-emerald-50 p-6 rounded-2xl border-l-4 border-lzEmerald">
                    "Menjadi lembaga pengelola zakat, infak, dan sedekah yang amanah, profesional, transparan, dan memberikan manfaat nyata bagi masyarakat."
                </p>
            </div>
            <div>
                <h2 class="text-2xl font-serif font-bold text-lzGreen mb-4">Misi Utama</h2>
                <ul class="space-y-3 text-gray-600 list-disc list-inside">
                    <li>Menghimpun dana ZIS secara profesional dan luas.</li>
                    <li>Menyalurkan tepat sasaran kepada asnaf dan dhuafa.</li>
                    <li>Menjaga transparansi laporan keuangan berbasis digital.</li>
                    <li>Memberdayakan umat melalui program ekonomi dan pendidikan.</li>
                </ul>
            </div>
        </div>

        <hr class="border-gray-200">

        <!-- Legalitas -->
        <div>
            <h2 class="text-2xl font-serif font-bold text-lzGreen mb-6 text-center">Legalitas Resmi</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div class="p-6 bg-gray-50 rounded-2xl border">
                    <h3 class="font-bold text-gray-800 mb-2">Akta Pendirian</h3>
                    <p class="text-sm text-gray-500 mb-4">No. 01 Tahun 2026</p>
                    <span class="text-xs bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full font-semibold">Terverifikasi</span>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl border">
                    <h3 class="font-bold text-gray-800 mb-2">SK Kemenkumham</h3>
                    <p class="text-sm text-gray-500 mb-4">AHU-00123.AH.01.04</p>
                    <span class="text-xs bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full font-semibold">Resmi</span>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl border">
                    <h3 class="font-bold text-gray-800 mb-2">Izin Operasional BAZNAS</h3>
                    <p class="text-sm text-gray-500 mb-4">No. 99/LAZ/2026</p>
                    <span class="text-xs bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full font-semibold">Aktif</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>