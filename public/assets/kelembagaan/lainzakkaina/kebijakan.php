<?php
// File: kebijakan.php
require_once 'config/database.php';
require_once 'includes/header.php';
?>

<!-- Header Kebijakan Privasi -->
<section class="bg-lzGreen py-16 text-center text-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-serif font-bold mb-4">Kebijakan Privasi</h1>
        <p class="text-emerald-100 text-lg">Komitmen kami dalam melindungi kerahasiaan dan keamanan data pribadi para donatur.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12 border border-gray-100 space-y-6 text-gray-700 leading-relaxed">
            
            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-800 mb-3">1. Pendahuluan</h2>
                <p>
                    LAINZAKKAINA sangat menghargai privasi setiap donatur dan pengunjung situs web kami. Kebijakan Privasi ini menjelaskan jenis informasi yang kami kumpulkan, cara kami menggunakan, serta langkah-langkah yang kami ambil untuk memastikan data Anda aman bersama kami.
                </p>
            </div>

            <hr class="border-gray-100">

            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-800 mb-3">2. Informasi yang Kami Kumpulkan</h2>
                <p class="mb-2">Saat Anda menggunakan platform kami untuk berdonasi atau menghitung zakat, kami dapat mengumpulkan:</p>
                <ul class="list-disc list-inside space-y-1 text-gray-600 pl-2">
                    <li>Nama lengkap atau informasi identitas (kecuali Anda memilih opsi anonim / Hamba Allah).</li>
                    <li>Informasi kontak seperti nomor WhatsApp dan alamat email untuk keperluan pengiriman kwitansi dan informasi penyaluran.</li>
                    <li>Detail transaksi donasi, termasuk nominal, pilihan program, dan metode pembayaran.</li>
                </ul>
            </div>

            <hr class="border-gray-100">

            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-800 mb-3">3. Penggunaan Informasi</h2>
                <p class="mb-2">Informasi yang Anda berikan hanya digunakan untuk keperluan internal lembaga, meliputi:</p>
                <ul class="list-disc list-inside space-y-1 text-gray-600 pl-2">
                    <li>Memverifikasi dan mencatat transaksi donasi ke dalam sistem keuangan lembaga.</li>
                    <li>Mengirimkan bukti transaksi atau kwitansi resmi digital kepada donatur.</li>
                    <li>Memberikan laporan berkala terkait penyaluran dana kebaikan melalui program yang Anda dukung.</li>
                </ul>
            </div>

            <hr class="border-gray-100">

            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-800 mb-3">4. Keamanan Data</h2>
                <p>
                    Kami menerapkan standar keamanan teknis dan administratif yang ketat (termasuk enkripsi basis data dan pembatasan akses khusus pengelola) untuk melindungi data pribadi Anda dari akses yang tidak sah, penyalahgunaan, atau kebocoran informasi.
                </p>
            </div>

            <hr class="border-gray-100">

            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-800 mb-3">5. Hak Donatur & Anonimitas</h2>
                <p>
                    Anda memiliki hak penuh untuk memilih opsi berdonasi secara anonim (**Hamba Allah**) pada formulir donasi, sehingga nama Anda tidak akan dipublikasikan di ringkasan program atau daftar donatur publik.
                </p>
            </div>

            <hr class="border-gray-100">

            <div>
                <h2 class="text-2xl font-serif font-bold text-gray-800 mb-3">6. Hubungi Kami</h2>
                <p>
                    Jika Anda memiliki pertanyaan seputar Kebijakan Privasi ini, Anda dapat menghubungi tim layanan amil kami melalui kontak resmi yang tertera di situs web LAINZAKKAINA.
                </p>
            </div>

        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>