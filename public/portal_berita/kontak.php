<?php
// kontak.php
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
    <title>Kontak Kami - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
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

    <main class="max-w-5xl mx-auto px-4 py-8 space-y-8">
        <div class="text-center max-w-2xl mx-auto mb-6">
            <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full font-bold uppercase">Hubungi Kami</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-2">Pusat Layanan & Sekretariat</h2>
            <p class="text-xs text-gray-500 mt-1">Silakan kunjungi lokasi kami atau hubungi kontak resmi di bawah ini untuk informasi lebih lanjut.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Info Alamat -->
            <div class="bg-white rounded-xl shadow-sm border p-6 text-center space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mx-auto text-lg">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="font-bold text-sm text-gray-800">Alamat Pesantren</h3>
                <p class="text-xs text-gray-600 leading-relaxed"><?= htmlspecialchars($settings['alamat'] ?? '-') ?></p>
            </div>

            <!-- Info WhatsApp -->
            <div class="bg-white rounded-xl shadow-sm border p-6 text-center space-y-3">
                <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center mx-auto text-lg">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3 class="font-bold text-sm text-gray-800">WhatsApp Resmi</h3>
                <p class="text-xs text-gray-600"><?= htmlspecialchars($settings['whatsapp'] ?? '-') ?></p>
                <a href="https://api.whatsapp.com/send?phone=<?= $settings['whatsapp'] ?? '' ?>" target="_blank" class="inline-block bg-green-600 text-white text-[10px] font-bold py-1.5 px-4 rounded hover:bg-green-700 transition">Kirim Pesan</a>
            </div>

            <!-- Info Media Sosial -->
            <div class="bg-white rounded-xl shadow-sm border p-6 text-center space-y-3">
                <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-full flex items-center justify-center mx-auto text-lg">
                    <i class="fas fa-share-alt"></i>
                </div>
                <h3 class="font-bold text-sm text-gray-800">Media Sosial</h3>
                <div class="flex justify-center space-x-3 text-sm text-gray-600 pt-1">
                    <a href="<?= $settings['instagram'] ?? '#' ?>" target="_blank" class="hover:text-emerald-700"><i class="fab fa-instagram"></i></a>
                    <a href="<?= $settings['youtube'] ?? '#' ?>" target="_blank" class="hover:text-emerald-700"><i class="fab fa-youtube"></i></a>
                    <a href="<?= $settings['facebook'] ?? '#' ?>" target="_blank" class="hover:text-emerald-700"><i class="fab fa-facebook"></i></a>
                    <a href="<?= $settings['tiktok'] ?? '#' ?>" target="_blank" class="hover:text-emerald-700"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi (Google Maps Embed) -->
        <div class="bg-white rounded-xl shadow-sm border p-4">
            <h3 class="text-base font-bold text-gray-800 mb-3 px-2">Peta Lokasi Pesantren</h3>
            <div class="w-full h-80 rounded-lg overflow-hidden border">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1985.4347598607237!2d105.64142078559816!3d-5.586296279745731!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4103f9d3218bfb%3A0xdcc94505257d0392!2sPP%20MUS%20Roudlotussolihin!5e0!3m2!1sid!2sid!4v1788185324594!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>
</body>
</html>