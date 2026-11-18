<?php
// admin/kategori.php
require_once '../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$pesan = '';

// Proses Tambah Kategori
if (isset($_POST['tambah_kategori'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : NULL;
    
    // Buat slug otomatis
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

    $parent_val = $parent_id ? $parent_id : "NULL";
    $query = "INSERT INTO categories (name, slug, parent_id) VALUES ('$name', '$slug', $parent_val)";
    
    if ($conn->query($query)) {
        $pesan = "<div class='bg-green-100 text-green-700 p-3 rounded mb-4 text-xs'>Kategori berhasil ditambahkan!</div>";
    } else {
        $pesan = "<div class='bg-red-100 text-red-700 p-3 rounded mb-4 text-xs'>Gagal: " . $conn->error . "</div>";
    }
}

// Proses Hapus Kategori
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $conn->query("DELETE FROM categories WHERE id = $id");
    header("Location: kategori.php");
    exit;
}

// Ambil daftar kategori utama untuk pilihan Parent (Dropdown)
$parent_categories = $conn->query("SELECT * FROM categories WHERE parent_id IS NULL ORDER BY name ASC");

// Ambil seluruh data kategori beserta induknya (jika ada)
$query_all = "SELECT c.*, p.name AS nama_induk 
              FROM categories c 
              LEFT JOIN categories p ON c.parent_id = p.id 
              ORDER BY c.parent_id ASC, c.name ASC";
$categories = $conn->query($query_all);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- Overlay Gelap Mobile -->
    <div @click="sidebarOpen = false" x-show="sidebarOpen" class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden"></div>

    <!-- Sidebar Responsif -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-800 text-white flex flex-col transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto shrink-0">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-700">
            <h1 class="text-xl font-bold">Ruang Redaksi</h1>
            <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2 text-sm overflow-y-auto">
            <a href="index.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-home mr-2"></i> Dashboard</a>
            <a href="berita.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-newspaper mr-2"></i> Kelola Berita</a>
            <a href="kategori.php" class="block px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition"><i class="fas fa-tags mr-2"></i> Kategori & Rubrik</a>
            <a href="komentar.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-comments mr-2"></i> Komentar</a>
            <a href="pengaturan.php" class="block px-4 py-2 rounded hover:bg-slate-700 transition"><i class="fas fa-cog mr-2"></i> Pengaturan</a>
        </nav>
        <div class="p-4 border-t border-slate-700">
            <a href="logout.php" class="block text-center px-4 py-2 bg-red-600 rounded hover:bg-red-700 transition"><i class="fas fa-sign-out-alt mr-2"></i> Keluar</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-y-auto w-full">
        <header class="h-16 bg-white shadow flex items-center justify-between px-4 md:px-6 shrink-0">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-700 focus:outline-none text-xl p-1">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-lg md:text-xl font-semibold text-gray-800">Manajemen Kategori & Rubrik</h2>
            </div>
            <div class="flex items-center">
                <span class="text-xs md:text-sm text-gray-600">Halo, <strong><?= $_SESSION['admin_name'] ?? 'Admin'; ?></strong></span>
            </div>
        </header>

        <div class="p-4 md:p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Form Tambah -->
            <div class="bg-white rounded-lg shadow p-6 h-fit">
                <h3 class="text-base font-bold text-gray-800 mb-4 border-b pb-2">Tambah Kategori Baru</h3>
                <?= $pesan; ?>
                <form action="" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Kategori / Rubrik</label>
                        <input type="text" name="name" required class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500" placeholder="Misal: Opini, Kajian...">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Induk Kategori (Opsional)</label>
                        <select name="parent_id" class="w-full px-3 py-2 border rounded text-sm focus:ring-blue-500">
                            <option value="">-- Kategori Utama (Parent) --</option>
                            <?php while($p = $parent_categories->fetch_assoc()): ?>
                                <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="tambah_kategori" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs py-2.5 px-4 rounded transition">Simpan Kategori</button>
                </form>
            </div>

            <!-- Tabel Kategori -->
            <div class="md:col-span-2 bg-white rounded-lg shadow overflow-x-auto h-fit">
                <div class="p-4 border-b bg-gray-50">
                    <h3 class="text-base font-bold text-gray-800">Daftar Rubrik & Kategori</h3>
                </div>
                <table class="w-full text-left border-collapse min-w-[500px]">
                    <thead>
                        <tr class="bg-gray-100 border-b text-xs text-gray-600 uppercase">
                            <th class="p-3">Nama</th>
                            <th class="p-3">Slug (URL)</th>
                            <th class="p-3">Induk</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <?php if($categories->num_rows > 0): ?>
                            <?php while($row = $categories->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-medium text-gray-800"><?= htmlspecialchars($row['name']) ?></td>
                                <td class="p-3 text-xs text-gray-500 font-mono"><?= $row['slug'] ?></td>
                                <td class="p-3 text-xs text-emerald-700 font-semibold"><?= $row['nama_induk'] ?? '<span class="text-gray-400 italic font-normal">Utama</span>' ?></td>
                                <td class="p-3 text-center">
                                    <a href="kategori.php?hapus=<?= $row['id'] ?>" class="text-red-500 hover:text-red-700 text-xs" onclick="return confirm('Hapus kategori ini?');"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="p-6 text-center text-gray-400 text-xs italic">Belum ada kategori.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</body>
</html>