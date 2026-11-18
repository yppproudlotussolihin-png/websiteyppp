<?php
// File: admin/program.php
require_once '../config/database.php';
require_once 'cek_login.php';

$pesan = '';
$mode_edit = false;
$data_edit = null;

// ==========================================
// 1. TANGANI AKSI GET (HAPUS, TUTUP, BUKA)
// ==========================================
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    try {
        if ($action == 'hapus') {
            // Ambil nama file gambar untuk dihapus dari folder
            $stmtImg = $pdo->prepare("SELECT gambar FROM program WHERE id = :id");
            $stmtImg->execute([':id' => $id]);
            $img = $stmtImg->fetch();
            if ($img && !empty($img['gambar']) && file_exists('../assets/uploads/' . $img['gambar'])) {
                unlink('../assets/uploads/' . $img['gambar']);
            }
            
            // Hapus data dari database
            $stmtDel = $pdo->prepare("DELETE FROM program WHERE id = :id");
            $stmtDel->execute([':id' => $id]);
            $pesan = "Program berhasil dihapus!";
        } elseif ($action == 'tutup') {
            $stmtClose = $pdo->prepare("UPDATE program SET status = 'selesai' WHERE id = :id");
            $stmtClose->execute([':id' => $id]);
            $pesan = "Program berhasil ditutup (diselesaikan).";
        } elseif ($action == 'buka') {
            $stmtOpen = $pdo->prepare("UPDATE program SET status = 'aktif' WHERE id = :id");
            $stmtOpen->execute([':id' => $id]);
            $pesan = "Program berhasil diaktifkan kembali.";
        }
    } catch (PDOException $e) {
        $pesan = "Error: " . $e->getMessage();
    }
}

// ==========================================
// 2. TANGANI AKSI EDIT (AMBIL DATA)
// ==========================================
if (isset($_GET['edit'])) {
    $mode_edit = true;
    $id_edit = $_GET['edit'];
    $stmtEdit = $pdo->prepare("SELECT * FROM program WHERE id = :id");
    $stmtEdit->execute([':id' => $id_edit]);
    $data_edit = $stmtEdit->fetch();
}

// ==========================================
// 3. TANGANI SUBMIT FORM (TAMBAH / UPDATE)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = htmlspecialchars($_POST['judul']);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul))) . '-' . rand(100, 999);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $target_dana = filter_var($_POST['target_dana'], FILTER_SANITIZE_NUMBER_FLOAT);
    $kategori_id = $_POST['kategori_id'];
    $id_program = $_POST['id_program'] ?? '';
    
    // Handle Upload Gambar Program
    $namaFileGambar = $_POST['gambar_lama'] ?? ''; // Gunakan gambar lama jika tidak ada upload baru
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $ekstensiValid = ['jpg', 'jpeg', 'png', 'webp'];
        $namaFileAsli = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        
        $ekstensi = strtolower(pathinfo($namaFileAsli, PATHINFO_EXTENSION));
        
        if (in_array($ekstensi, $ekstensiValid) && $ukuranFile <= 2000000) { // Max 2MB
            $namaFileGambar = 'prog_' . time() . '.' . $ekstensi;
            if (!is_dir('../assets/uploads/')) {
                mkdir('../assets/uploads/', 0777, true);
            }
            move_uploaded_file($tmpName, '../assets/uploads/' . $namaFileGambar);
            
            // Hapus gambar lama jika ada
            if (!empty($_POST['gambar_lama']) && file_exists('../assets/uploads/' . $_POST['gambar_lama'])) {
                unlink('../assets/uploads/' . $_POST['gambar_lama']);
            }
        }
    }

    try {
        if ($id_program !== '') {
            // PROSES UPDATE DATA
            $stmtUpdate = $pdo->prepare("UPDATE program SET kategori_id = :kat, judul = :judul, deskripsi = :desc, target_dana = :target, gambar = :gambar WHERE id = :id");
            $stmtUpdate->execute([
                ':kat' => $kategori_id,
                ':judul' => $judul,
                ':desc' => $deskripsi,
                ':target' => $target_dana,
                ':gambar' => $namaFileGambar,
                ':id' => $id_program
            ]);
            $pesan = "Program berhasil diperbarui!";
            // Reset ke mode tambah setelah sukses update
            $mode_edit = false; 
            $data_edit = null;
        } else {
            // PROSES INSERT DATA BARU
            $stmtInsert = $pdo->prepare("INSERT INTO program (kategori_id, judul, slug, deskripsi, target_dana, dana_terkumpul, gambar, status) VALUES (:kat, :judul, :slug, :desc, :target, 0, :gambar, 'aktif')");
            $stmtInsert->execute([
                ':kat' => $kategori_id,
                ':judul' => $judul,
                ':slug' => $slug,
                ':desc' => $deskripsi,
                ':target' => $target_dana,
                ':gambar' => $namaFileGambar
            ]);
            $pesan = "Program baru berhasil ditambahkan!";
        }
    } catch (PDOException $e) {
        $pesan = "Error: " . $e->getMessage();
    }
}

// Ambil data untuk ditampilkan di tabel dan opsi select
$kategoriList = $pdo->query("SELECT * FROM kategori")->fetchAll();
$programList = $pdo->query("SELECT p.*, k.nama_kategori FROM program p JOIN kategori k ON p.kategori_id = k.id ORDER BY p.id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Program - Admin LAINZAKKAINA</title>
    <link rel="icon"
          type="image/png"
          href="../../../images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col md:flex-row min-h-screen">
    
    <!-- Mobile Header -->
    <div class="md:hidden bg-emerald-900 text-white p-4 flex justify-between items-center shadow-md shrink-0">
        <h2 class="text-xl font-bold">Admin Panel</h2>
        <button onclick="document.getElementById('admin-sidebar').classList.toggle('hidden')" class="focus:outline-none p-1">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="hidden md:flex w-full md:w-64 bg-emerald-900 text-white p-6 flex-col justify-between shrink-0 min-h-screen">
        <div>
            <h2 class="text-2xl font-bold mb-8 hidden md:block">Admin Panel</h2>
            <nav class="space-y-3">
                <a href="index.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Dashboard</a>
                <a href="transaksi.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Kelola Donasi</a>
                <a href="program.php" class="block py-2.5 px-4 bg-emerald-800 rounded-lg font-semibold">Kelola Program</a>
                <a href="keuangan.php" class="block py-2.5 px-4 hover:bg-emerald-800 rounded-lg transition">Arus Keuangan</a>
            </nav>
        </div>
        <div class="mt-8 pt-6 border-t border-emerald-800">
            <a href="logout.php" class="block py-2 px-4 text-red-200 bg-red-900/40 hover:bg-red-900 rounded-lg transition text-center text-sm font-semibold">
                Keluar (Logout)
            </a>
        </div>
    </aside>

    <main class="flex-1 p-4 sm:p-8 overflow-x-hidden">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Kelola Program Kebaikan</h1>
            <?php if($mode_edit): ?>
                <a href="program.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-4 py-2.5 rounded-lg text-sm transition shadow-sm w-full sm:w-auto text-center">Batal Edit / Tambah Baru</a>
            <?php endif; ?>
        </div>

        <?php if($pesan): ?>
            <div class="bg-emerald-100 text-emerald-800 p-4 rounded-lg mb-6 shadow-sm border border-emerald-200 font-medium">
                <?php echo $pesan; ?>
            </div>
        <?php endif; ?>

        <!-- Form (Berfungsi Ganda: Tambah & Edit) -->
        <div class="bg-white p-6 rounded-xl shadow-sm mb-8 border border-gray-100">
            <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4"><?php echo $mode_edit ? 'Edit Data Program' : 'Tambah Program Baru'; ?></h2>
            <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Input Hidden untuk ID Program & Gambar Lama saat Edit -->
                <input type="hidden" name="id_program" value="<?php echo $mode_edit ? $data_edit['id'] : ''; ?>">
                <input type="hidden" name="gambar_lama" value="<?php echo $mode_edit ? $data_edit['gambar'] : ''; ?>">

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Judul Program</label>
                    <input type="text" name="judul" value="<?php echo $mode_edit ? htmlspecialchars($data_edit['judul']) : ''; ?>" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Kategori</label>
                    <select name="kategori_id" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <?php foreach($kategoriList as $k): ?>
                            <option value="<?php echo $k['id']; ?>" <?php echo ($mode_edit && $data_edit['kategori_id'] == $k['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($k['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Target Dana (Rp)</label>
                    <input type="number" name="target_dana" value="<?php echo $mode_edit ? intval($data_edit['target_dana']) : ''; ?>" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Foto Banner Program <?php echo $mode_edit ? '(Abaikan jika tidak diubah)' : ''; ?></label>
                    <input type="file" name="gambar" accept="image/*" class="w-full border px-3 py-1.5 rounded-lg text-sm bg-gray-50 focus:ring-emerald-500 focus:border-emerald-500">
                    <p class="text-xs text-gray-400 mt-1">Maksimal ukuran file: 2MB</p>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-semibold mb-1">Deskripsi Lengkap</label>
                    <textarea name="deskripsi" rows="4" required class="w-full border px-4 py-2 rounded-lg focus:ring-emerald-500 focus:border-emerald-500"><?php echo $mode_edit ? htmlspecialchars($data_edit['deskripsi']) : ''; ?></textarea>
                </div>
                
                <div class="md:col-span-2 pt-2">
                    <button type="submit" class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-lg shadow transition">
                        <?php echo $mode_edit ? 'Simpan Perubahan Program' : 'Simpan Program Baru'; ?>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Program dengan Aksi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul & Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dana Terkumpul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        <?php if(count($programList) > 0): ?>
                            <?php foreach($programList as $p): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if(!empty($p['gambar'])): ?>
                                        <img src="../assets/uploads/<?php echo $p['gambar']; ?>" class="w-16 h-12 object-cover rounded-lg shadow-sm border">
                                    <?php else: ?>
                                        <span class="text-xs text-gray-400 italic bg-gray-100 px-2 py-1 rounded">Tanpa Foto</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800 line-clamp-2 max-w-[200px]"><?php echo htmlspecialchars($p['judul']); ?></div>
                                    <div class="text-xs text-gray-500 mt-1"><?php echo htmlspecialchars($p['nama_kategori']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-emerald-600 font-bold">Rp <?php echo number_format($p['dana_terkumpul'], 0, ',', '.'); ?></div>
                                    <div class="text-xs text-gray-400 mt-1">Target: Rp <?php echo number_format($p['target_dana'], 0, ',', '.'); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($p['status'] == 'aktif'): ?>
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold uppercase">Aktif</span>
                                    <?php else: ?>
                                        <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Selesai</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-1.5 flex-wrap w-full max-w-[150px] mx-auto">
                                        <!-- Tombol Edit -->
                                        <a href="program.php?edit=<?php echo $p['id']; ?>" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm inline-block">Edit</a>
                                        
                                        <!-- Tombol Tutup / Buka -->
                                        <?php if($p['status'] == 'aktif'): ?>
                                            <a href="program.php?action=tutup&id=<?php echo $p['id']; ?>" onclick="return confirm('Tutup program ini agar tidak bisa didonasi lagi?')" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm inline-block">Tutup</a>
                                        <?php else: ?>
                                            <a href="program.php?action=buka&id=<?php echo $p['id']; ?>" onclick="return confirm('Buka kembali program ini untuk donasi?')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm inline-block">Buka</a>
                                        <?php endif; ?>

                                        <!-- Tombol Hapus -->
                                        <a href="program.php?action=hapus&id=<?php echo $p['id']; ?>" onclick="return confirm('Peringatan: Yakin ingin menghapus program ini beserta fotonya? Data yang terkait mungkin akan hilang.')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm inline-block">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">Belum ada program yang ditambahkan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>