<?php
// donasi.php
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
    <title>Donasi & Wakaf - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
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
        <div class="bg-emerald-900 text-white rounded-xl p-8 shadow-md text-center">
            <span class="bg-amber-500 text-white text-xs px-3 py-1 rounded font-bold uppercase">Infaq & Wakaf</span>
            <h2 class="text-3xl font-bold mt-3 mb-2">Mari Beramal Jariyah</h2>
            <p class="text-emerald-200 text-xs max-w-xl mx-auto">Dukung pembangunan sarana pendidikan santri, asrama, dan operasional dakwah pesantren melalui donasi terbaik Anda.</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Informasi Rekening Resmi Yayasan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-5 bg-gray-50 rounded-lg border border-gray-200 flex items-center space-x-4">
                    <div class="bg-blue-600 text-white p-4 rounded-lg font-bold text-xl"><i class="fas fa-university"></i></div>
                    <div>
                        <span class="text-xs text-gray-400 block font-semibold">Bank Syariah Indonesia (BSI)</span>
                        <h4 class="font-bold text-base text-gray-800">7123-4567-89</h4>
                        <p class="text-xs text-gray-600">A.N. Yayasan Pondok Pesantren</p>
                    </div>
                </div>
                <div class="p-5 bg-gray-50 rounded-lg border border-gray-200 flex items-center space-x-4">
                    <div class="bg-emerald-600 text-white p-4 rounded-lg font-bold text-xl"><i class="fas fa-university"></i></div>
                    <div>
                        <span class="text-xs text-gray-400 block font-semibold">Bank Muamalat</span>
                        <h4 class="font-bold text-base text-gray-800">1098-7654-32</h4>
                        <p class="text-xs text-gray-600">A.N. Pembangunan Pesantren</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Konfirmasi Donasi</h3>
            <p class="text-xs text-gray-600 mb-6">Setelah melakukan transfer donasi atau wakaf, mohon lakukan konfirmasi melampirkan bukti transfer via WhatsApp agar tercatat oleh bendahara yayasan.</p>
            <a href="https://api.whatsapp.com/send?phone=<?= $settings['whatsapp'] ?? '' ?>&text=Halo%20Admin,%20saya%20sudah%20berdonasi%20untuk%20pesantren.%20Berikut%20bukti%20transfernya." target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold text-xs py-3 px-6 rounded-lg inline-block transition shadow"><i class="fab fa-whatsapp mr-2"></i> Konfirmasi via WhatsApp</a>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>
</body>
</html>