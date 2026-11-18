<?php
// admin/tambah_berita.php
require_once '../config/database.php';

// Cek session
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$pesan = '';

// Jika tombol "Publikasikan" ditekan
if (isset($_POST['submit'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];
    $author_id = $_SESSION['admin_id'];
    
    // Fitur Checkbox (Jika dicentang nilainya 1, jika tidak 0)
    $is_slider = isset($_POST['is_slider']) ? 1 : 0;
    $is_editors_pick = isset($_POST['is_editors_pick']) ? 1 : 0;
    $is_breaking_news = isset($_POST['is_breaking_news']) ? 1 : 0;

    // Membuat Slug otomatis dari Judul
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    $slug = $slug . '-' . time(); 

    // Proses Upload Gambar
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $nama_file = $_FILES['image']['name'];
        $tmp_file = $_FILES['image']['tmp_name'];
        $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = "hero_" . time() . "." . $ekstensi;
        
        $folder_tujuan = "../assets/uploads/";
        if (!file_exists($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }

        if (move_uploaded_file($tmp_file, $folder_tujuan . $nama_baru)) {
            $image = $nama_baru;
        } else {
            $pesan = "<div class='bg-red-100 text-red-700 p-3 rounded mb-4'>Gagal mengunggah gambar!</div>";
        }
    }

    if(empty($pesan)) {
        // Simpan ke database
        $query = "INSERT INTO posts (title, slug, content, image, category_id, author_id, is_slider, is_editors_pick, is_breaking_news, status) 
                  VALUES ('$title', '$slug', '$content', '$image', '$category_id', '$author_id', '$is_slider', '$is_editors_pick', '$is_breaking_news', '$status')";
        
        if ($conn->query($query)) {
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
    <title>Tulis Berita - Portal Pesantren</title>
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
            placeholder: 'Tulis isi berita di sini...',
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
            <h2 class="text-2xl font-bold text-gray-800">Tulis Artikel Baru</h2>
            <a href="berita.php" class="text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
        </div>

        <?= $pesan; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Kolom Kiri: Input Utama -->
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
                        <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan judul berita yang menarik...">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Konten</label>
                        <textarea id="content" name="content" rows="15" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis isi berita di sini..."></textarea>
                    </div>
                </div>

                <!-- Kolom Kanan: Pengaturan Ekstra -->
                <div class="space-y-6 bg-gray-50 p-6 rounded-lg border">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori / Rubrik</label>
                        <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                            <?php while($row = $kategori->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Utama (Thumbnail)</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg bg-white">
                        <small class="text-gray-500 mt-1 block">Format: JPG, PNG. Maks 2MB.</small>
                    </div>

                    <div class="space-y-2 border-t border-b py-4 border-gray-200">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Tampilkan di:</p>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="is_slider" value="1" class="rounded text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Slider Hero Depan</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="is_breaking_news" value="1" class="rounded text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Ticker Berita (Teks Berjalan)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="is_editors_pick" value="1" class="rounded text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Pilihan Redaksi</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Publikasi</label>
                        <select name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500">
                            <option value="published">Publikasikan Langsung</option>
                            <option value="draft">Simpan sebagai Draft</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md">
                        <i class="fas fa-save mr-2"></i> Simpan & Publikasikan
                    </button>
                </div>

            </div>
        </form>
    </main>

</body>
</html>