<?php
// admin/pengaturan.php
require_once '../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$pesan = '';

if (isset($_POST['simpan_pengaturan'])) {
    foreach ($_POST as $key => $value) {
        if ($key != 'simpan_pengaturan') {
            $key_esc = $conn->real_escape_string($key);
            $val_esc = $conn->real_escape_string($value);
            $conn->query("UPDATE settings SET setting_value = '$val_esc' WHERE setting_key = '$key_esc'");
        }
    }
    $pesan = "<div class='bg-green-100 text-green-700 p-3 rounded mb-4 text-xs font-semibold'>Pengaturan website berhasil diperbarui!</div>";
}

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
    <title>Pengaturan Website - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <div @click="sidebarOpen = false" x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-800 text-white flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto shrink-0">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-700">
            <h1 class="text-xl font-bold">Ruang Redaksi</h1>
            <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white focus:outline-none"><i class="fas fa-times text-xl"></i></button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2 text-sm overflow-y-auto">
            <a href="index.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-home mr-2"></i> Dashboard</a>
            <a href="berita.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-newspaper mr-2"></i> Kelola Berita</a>
            <a href="kategori.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-tags mr-2"></i> Kategori & Rubrik</a>
            <a href="komentar.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-comments mr-2"></i> Komentar</a>
            <a href="pengaturan.php" class="block px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition"><i class="fas fa-cog mr-2"></i> Pengaturan</a>
        </nav>
        <div class="p-4 border-t border-slate-700">
            <a href="logout.php" class="block text-center px-4 py-2 bg-red-600 rounded hover:bg-red-700 transition"><i class="fas fa-sign-out-alt mr-2"></i> Keluar</a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto w-full">
        <header class="h-16 bg-white shadow flex items-center justify-between px-4 md:px-6 shrink-0">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-700 focus:outline-none text-xl p-1"><i class="fas fa-bars"></i></button>
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">Pengaturan Website</h2>
            </div>
            <div class="flex items-center"><span class="text-xs md:text-sm text-gray-600">Halo, <strong><?= $_SESSION['admin_name'] ?? 'Admin'; ?></strong></span></div>
        </header>

        <div class="p-4 md:p-6 max-w-3xl">
            <div class="bg-white rounded-lg shadow p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-3">Konfigurasi Situs Pesantren</h3>
                <?= $pesan; ?>
                <form action="" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Yayasan / Pondok Pesantren</label>
                        <input type="text" name="nama_yayasan" value="<?= htmlspecialchars($settings['nama_yayasan'] ?? '') ?>" required class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" rows="2" class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500"><?= htmlspecialchars($settings['alamat'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nomor WhatsApp Resmi</label>
                        <input type="text" name="whatsapp" value="<?= htmlspecialchars($settings['whatsapp'] ?? '') ?>" class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Link Facebook</label>
                            <input type="url" name="facebook" value="<?= htmlspecialchars($settings['facebook'] ?? '') ?>" class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Link Instagram</label>
                            <input type="url" name="instagram" value="<?= htmlspecialchars($settings['instagram'] ?? '') ?>" class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Link YouTube</label>
                            <input type="url" name="youtube" value="<?= htmlspecialchars($settings['youtube'] ?? '') ?>" class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Link TikTok</label>
                            <input type="url" name="tiktok" value="<?= htmlspecialchars($settings['tiktok'] ?? '') ?>" class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="pt-4 border-t">
                        <button type="submit" name="simpan_pengaturan" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-3 px-6 rounded transition shadow">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>