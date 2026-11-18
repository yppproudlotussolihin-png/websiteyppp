<?php
// admin/edit_berita.php
require_once '../config/database.php';

// Cek session
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$pesan = '';

// Ambil ID berita dari URL
if (!isset($_GET['id'])) {
    header("Location: berita.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data berita berdasarkan ID
$query_old = $conn->query("SELECT * FROM posts WHERE id = $id");
if ($query_old->num_rows == 0) {
    header("Location: berita.php");
    exit;
}
$data = $query_old->fetch_assoc();

// Jika tombol "Simpan Perubahan" ditekan
if (isset($_POST['update'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];
    
    // Fitur Checkbox
    $is_slider = isset($_POST['is_slider']) ? 1 : 0;
    $is_editors_pick = isset($_POST['is_editors_pick']) ? 1 : 0;
    $is_breaking_news = isset($_POST['is_breaking_news']) ? 1 : 0;

    // Cek apakah ada gambar baru yang diunggah
    $image = $data['image']; // Tetap gunakan gambar lama secara default
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $nama_file = $_FILES['image']['name'];
        $tmp_file = $_FILES['image']['tmp_name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = "hero_" . time() . "." . $ekstensi;
        
        $folder_tujuan = "../assets/uploads/";
        if (move_uploaded_file($tmp_file, $folder_tujuan . $nama_baru)) {
            // Hapus gambar lama jika ada
            if (!empty($data['image']) && file_exists($folder_tujuan . $data['image'])) {
                unlink($folder_tujuan . $data['image']);
            }
            $image = $nama_baru;
        } else {
            $pesan = "<div class='bg-red-100 text-red-700 p-3 rounded mb-4'>Gagal mengunggah gambar baru!</div>";
        }
    }

    if (empty($pesan)) {
        // Update database
        $update_query = "UPDATE posts SET 
            title = '$title', 
            content = '$content', 
            image = '$image', 
            category_id = $category_id, 
            is_slider = $is_slider, 
            is_editors_pick = $is_editors_pick, 
            is_breaking_news = $is_breaking_news, 
            status = '$status' 
            WHERE id = $id";

        if ($conn->query($update_query)) {
            header("Location: berita.php");
            exit;
        } else {
            $pesan = "<div class='bg-red-100 text-red-700 p-3 rounded mb-4'>Error Database: " . $conn->error . "</div>";
        }
    }
}

// Ambil daftar kategori untuk dropdown
$kategori = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                tabsize: 2,
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
    <style>
    /* Mengembalikan gaya list (ul/ol) khusus di dalam editor Summernote */
    .note-editable ul {
        list-style-type: disc !important;
        padding-left: 2rem !important;
    }
    .note-editable ol {
        list-style-type: decimal !important;
        padding-left: 2rem !important;
    }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <main class="flex-1 flex flex-col h-screen overflow-y-auto w-full max-w-5xl mx-auto py-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Artikel Berita</h2>
            <a href="berita.php" class="text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
        </div>

        <?= $pesan; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Kolom Kiri -->
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($data['title']); ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Konten</label>
                        <textarea id="content" name="content" rows="15" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"><?= htmlspecialchars($data['content']); ?></textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-6 bg-gray-50 p-6 rounded-lg border">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori / Rubrik</label>
                        <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                            <?php while($row = $kategori->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>" <?= ($row['id'] == $data['category_id']) ? 'selected' : ''; ?>>
                                    <?= $row['name'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Utama (Thumbnail)</label>
                        <?php if(!empty($data['image'])): ?>
                            <div class="mb-2">
                                <img src="../assets/uploads/<?= $data['image'] ?>" class="w-full h-32 object-cover rounded border">
                                <small class="text-gray-400">Gambar saat ini</small>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg bg-white text-xs">
                        <small class="text-gray-500 mt-1 block">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>

                    <div class="space-y-2 border-t border-b py-4 border-gray-200">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Tampilkan di:</p>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="is_slider" value="1" <?= ($data['is_slider'] == 1) ? 'checked' : ''; ?> class="rounded text-blue-600">
                            <span class="text-sm text-gray-700">Slider Hero Depan</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="is_breaking_news" value="1" <?= ($data['is_breaking_news'] == 1) ? 'checked' : ''; ?> class="rounded text-blue-600">
                            <span class="text-sm text-gray-700">Ticker Berita (Teks Berjalan)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="is_editors_pick" value="1" <?= ($data['is_editors_pick'] == 1) ? 'checked' : ''; ?> class="rounded text-blue-600">
                            <span class="text-sm text-gray-700">Pilihan Redaksi</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Publikasi</label>
                        <select name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                            <option value="published" <?= ($data['status'] == 'published') ? 'selected' : ''; ?>>Published</option>
                            <option value="draft" <?= ($data['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                        </select>
                    </div>

                    <button type="submit" name="update" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </main>

</body>
</html>