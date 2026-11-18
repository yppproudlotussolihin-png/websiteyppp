<?php
// tentang.php
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
    <title>Tentang Kami - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
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
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h2 class="text-2xl font-bold text-emerald-900 mb-4 border-b pb-3 border-emerald-600">Profil Yayasan & Pondok Pesantren</h2>
            <p class="text-sm text-gray-700 leading-relaxed mb-4">
                <?= $settings['nama_yayasan'] ?> Yayasan Pendidikan Pondok Pesantren Roudlotussolihin merupakan lembaga pendidikan Islam yang berlokasi di Desa Bumi Restu, Kecamatan Palas, Kabupaten Lampung Selatan, Provinsi Lampung. Didirikan pada 18 Mei 1989 oleh KH. RM. Soleh Bajuri, yayasan ini menjadi pusat pembinaan keislaman yang mengintegrasikan pendidikan pesantren, pendidikan formal, serta kegiatan dakwah dan pemberdayaan masyarakat.
            </p>
            <p class="text-sm text-gray-700 leading-relaxed">
                Dalam perjalanannya, yayasan terus berkembang dengan menyelenggarakan pendidikan nonformal berupa Madrasah Diniyah, Majelis Ta’lim Bapak-Bapak, dan Majelis Ta’lim Ibu-Ibu, serta pendidikan formal yang meliputi MTs Ma’arif Bumirestu (1989), MI Ma’arif Bumirestu (1990), SMA Ma’arif Bumirestu (2004), dan RA Al-Qur’an Roudlotussolihin (2025). Hingga kini, Yayasan Pendidikan Pondok Pesantren Roudlotussolihin berkomitmen melahirkan generasi yang beriman, berilmu, berakhlakul karimah, dan bermanfaat bagi masyarakat.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h2 class="text-2xl font-bold text-emerald-900 mb-4 border-b pb-3 border-emerald-600">Sejarah Singkat</h2>
            <p class="text-sm text-gray-700 leading-relaxed">
                Pondok Pesantren MUS Roudlotussolihin berdiri pada 18 Mei 1989 atas prakarsa KH. RM. Soleh Bajuri, putra asal Desa Cikarag, Kecamatan Cimanggu, Kabupaten Cilacap, Jawa Tengah. Kehadiran beliau di Lampung Selatan berawal dari undangan Mbah Kiai Daud, Takmir Masjid Al-Muhajirin Desa Bumi Restu, untuk mengajar dan menyebarkan syiar Islam kepada masyarakat.
            </p>
            
            <p class="text-sm text-gray-700 leading-relaxed">
                Atas izin gurunya, KH. Djarir Sufyan, Pengasuh Pondok Pesantren Miftahul Huda Cigaru Cibeunying Majenang, KH. RM. Soleh Bajuri kemudian menetap di Bumi Restu dan melanjutkan dakwahnya. Sekitar satu tahun kemudian, beliau mendirikan Yayasan Pendidikan Pondok Pesantren Roudlotussolihin sebagai wadah pendidikan dan pembinaan umat. Sejak saat itu, pesantren terus berkembang menjadi salah satu lembaga pendidikan Islam yang berperan aktif dalam mencetak generasi Qur’ani dan berakhlak mulia di Lampung Selatan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-emerald-900 text-white rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-bold mb-3 text-amber-400">Visi</h3>
                <p class="text-xs leading-relaxed text-emerald-100">
                    Mengawal dan mencetak generasi bangsa yang beriman, berakhlakul karimah, cerdas dan berbudaya.
                </p>
            </div>
            <div class="bg-emerald-900 text-white rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-bold mb-3 text-amber-400">Misi</h3>
                <ul class="text-xs space-y-2 text-emerald-100 list-disc list-inside">
                    <li>Melahirkan generasi penerus yang beriman dan berkualitas</li>
                    <li>Mewujudkan keunggulan dalam pengembangan keislaman</li>
                    <li>Meningkatkan sumberdaya pendidik dan kependidikan yang professional</li>
                    <li>Mewujudkan proses belajar mengajar yang berbasis keagamaan berkemajuan</li>
                    <li>Mewujudkan lingkungan pendidikan yang kreatif, edukatif, religious dan akuntabel</li>
                    <li>Mengembangkan seni budaya yang relevan dengan ciri khas pesantren menuju kebudayaan local, nasional dan internasional</li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?>. All Rights Reserved. | Developed by Miftah Fauzi
    </footer>
</body>
</html>