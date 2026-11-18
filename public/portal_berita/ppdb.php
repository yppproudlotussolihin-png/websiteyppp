<?php
// ppdb.php
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
    <title>PPDB - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
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
                <div class="logo">
                    <img src="../assets/images/ypp.png" alt="Logo" class="w-12 h-12 object-contain">
                </div>
                <div><h1 class="text-lg font-bold text-emerald-900"><?= $settings['nama_yayasan'] ?></h1></div>
            </a>
            <a href="index.php" class="text-sm text-emerald-700 font-semibold hover:underline"><i class="fas fa-arrow-left mr-1"></i> Beranda</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8 space-y-8">
        <div class="bg-gradient-to-r from-emerald-800 to-emerald-950 text-white rounded-xl p-8 shadow-md text-center">
            <span class="bg-amber-500 text-white text-xs px-3 py-1 rounded font-bold uppercase">Tahun Ajaran <?= date('Y') ?>/<?= date('Y')+1 ?></span>
            <h2 class="text-3xl font-bold mt-3 mb-2">Pendaftaran Santri Baru (PPDB)</h2>
            <p class="text-emerald-200 text-xs max-w-xl mx-auto mb-6">Pintu gerbang masa depan putra-putri Anda menuju pendalaman ilmu agama dan karakter mulia telah dibuka.</p>
            <a href="https://api.whatsapp.com/send?phone=<?= $settings['whatsapp'] ?? '' ?>&text=Halo%20Admin,%20saya%20ingin%20bertanya%20mengenai%20pendaftaran%20santri%20baru" target="_blank" class="bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs py-3 px-8 rounded-lg shadow inline-block transition"><i class="fab fa-whatsapp mr-2"></i> Hubungi Panitia PPDB</a>
            <a href="../informasi.html" target="_blank" class="bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs py-3 px-8 rounded-lg shadow inline-block transition"><i class="fas fa-address-card mr-2"></i> Daftar Sekarang</a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Program Unggulan Pesantren</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div class="p-4 bg-gray-50 rounded-lg border">
                    <i class="fas fa-book-quran text-3xl text-emerald-700 mb-2"></i>
                    <h4 class="font-bold text-sm text-gray-800 mb-1">Tahfidz Al-Qur'an</h4>
                    <p class="text-xs text-gray-500">Program hafalan Al-Qur'an intensif dengan bimbingan ustadz berpengalaman.</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border">
                    <i class="fas fa-graduation-cap text-3xl text-emerald-700 mb-2"></i>
                    <h4 class="font-bold text-sm text-gray-800 mb-1">Kajian Kitab Kuning</h4>
                    <p class="text-xs text-gray-500">Pendalaman ilmu fikih, nahwu, shorof, dan akhlak turats klasik.</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg border">
                    <i class="fas fa-laptop-code text-3xl text-emerald-700 mb-2"></i>
                    <h4 class="font-bold text-sm text-gray-800 mb-1">Kecakapan Digital</h4>
                    <p class="text-xs text-gray-500">Bekali santri dengan keterampilan komputer, bahasa asing, dan teknologi.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>
</body>
</html>