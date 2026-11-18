<?php
// File: faq.php
require_once 'config/database.php';
require_once 'includes/header.php';
?>

<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Pertanyaan Umum (FAQ)</h1>
        <p class="text-emerald-100 text-lg">Temukan jawaban seputar tata cara berdonasi dan pengelolaan zakat di LAINZAKKAINA.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-[50vh]">
    <div class="max-w-3xl mx-auto px-4 space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="font-bold text-lg text-lzGreen mb-2">Bagaimana cara menghitung zakat penghasilan?</h3>
            <p class="text-gray-600 text-sm">Anda bisa menggunakan Kalkulator Zakat yang tersedia di halaman utama. Zakat dikeluarkan sebesar 2.5% dari total pendapatan bersih bulanan jika telah mencapai nisab.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="font-bold text-lg text-lzGreen mb-2">Apakah donasi bisa dilakukan secara anonim?</h3>
            <p class="text-gray-600 text-sm">Ya, tentu saja. Pada formulir donasi, Anda cukup mencentang opsi "Sembunyikan nama saya", dan sistem akan mencatat nama Anda sebagai Hamba Allah.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="font-bold text-lg text-lzGreen mb-2">Bagaimana saya tahu dana benar-benar disalurkan?</h3>
            <p class="text-gray-600 text-sm">Anda dapat memantau akumulasi dana masuk secara real-time melalui menu Transparansi, serta melihat laporan program secara berkala di platform kami.</p>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>