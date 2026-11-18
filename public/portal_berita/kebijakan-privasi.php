<?php
// kebijakan-privasi.php
require_once 'config/database.php';
$settings_query = $conn->query("SELECT * FROM settings");
$settings = [];
while($row = $settings_query->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-lg overflow-hidden flex items-center justify-center bg-white shadow-sm border">
                    <img src="assets/ypp.png" alt="Logo Pesantren" class="w-full h-full object-contain">
                </div>
                <div><h1 class="text-lg font-bold text-emerald-900"><?= $settings['nama_yayasan'] ?></h1></div>
            </a>
            <a href="index.php" class="text-sm text-emerald-700 font-semibold hover:underline"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8 space-y-8">
        <div class="bg-white rounded-xl shadow-sm border p-8 md:p-10 space-y-6">
            <h2 class="text-2xl font-bold text-emerald-900 border-b pb-3 border-emerald-600">Kebijakan Privasi</h2>
            <p class="text-xs text-gray-500">Terakhir diperbarui: <?= date('d F Y') ?></p>

            <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
                <h3 class="font-bold text-base text-gray-900 pt-2">1. Pengumpulan Informasi</h3>
                <p>Kami mengumpulkan informasi dari Anda saat Anda mengunjungi situs web kami, menulis komentar pada artikel, atau menghubungi panitia melalui form yang tersedia. Informasi yang dikumpulkan mencakup nama, alamat email, dan isi pesan/komentar.</p>

                <h3 class="font-bold text-base text-gray-900 pt-2">2. Penggunaan Informasi</h3>
                <p>Informasi yang kami kumpulkan dari Anda dapat digunakan untuk:</p>
                <ul class="list-disc list-inside space-y-1 pl-2">
                    <li>Memoderasi dan menampilkan komentar yang relevan pada artikel berita.</li>
                    <li>Menanggapi pertanyaan atau permohonan informasi seputar pendaftaran santri baru (PPDB).</li>
                    <li>Meningkatkan kualitas konten, tata letak, dan fitur website pondok pesantren.</li>
                </ul>

                <h3 class="font-bold text-base text-gray-900 pt-2">3. Perlindungan Data</h3>
                <p>Kami menerapkan langkah-langkah pengamanan yang ketat untuk menjaga keamanan data pribadi Anda. Komentar pengunjung melalui sistem moderasi manual oleh administrator redaksi sebelum dipublikasikan untuk mencegah konten spam atau tidak pantas.</p>

                <h3 class="font-bold text-base text-gray-900 pt-2">4. Hubungi Kami</h3>
                <p>Jika ada pertanyaan terkait kebijakan privasi ini, Anda dapat menghubungi pengurus melalui halaman kontak resmi kami atau langsung melalui nomor WhatsApp yayasan.</p>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>
</body>
</html>