<?php
// artikel.php
require_once 'config/database.php';

// Ambil pengaturan situs
$settings_query = $conn->query("SELECT * FROM settings");
$settings = [];
while($row = $settings_query->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Ambil slug dari URL
$slug = isset($_GET['slug']) ? $conn->real_escape_string($_GET['slug']) : '';

// Ambil data artikel beserta kategori dan penulisnya
$query = "SELECT posts.*, categories.name AS kategori, categories.slug AS kat_slug, users.name AS penulis 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          LEFT JOIN users ON posts.author_id = users.id 
          WHERE posts.slug = '$slug' AND posts.status = 'published'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    // Jika artikel tidak ditemukan, kembalikan ke beranda
    header("Location: index.php");
    exit;
}

$article = $result->fetch_assoc();
$article_id = $article['id'];

// Tambah jumlah pembaca (views) +1 setiap kali halaman dibuka
$conn->query("UPDATE posts SET views = views + 1 WHERE id = $article_id");

// Proses Kirim Komentar
$pesan_komentar = '';
if (isset($_POST['kirim_komentar'])) {
    $nama = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $body = $conn->real_escape_string($_POST['body']);

    if (!empty($nama) && !empty($email) && !empty($body)) {
        $insert_komentar = "INSERT INTO comments (post_id, name, email, body, status) VALUES ($article_id, '$nama', '$email', '$body', 'pending')";
        if ($conn->query($insert_komentar)) {
            $pesan_komentar = "<div class='bg-green-100 text-green-700 p-3 rounded mb-4 text-sm'>Komentar berhasil dikirim dan sedang menunggu moderasi admin.</div>";
        } else {
            $pesan_komentar = "<div class='bg-red-100 text-red-700 p-3 rounded mb-4 text-sm'>Gagal mengirim komentar.</div>";
        }
    } else {
        $pesan_komentar = "<div class='bg-yellow-100 text-yellow-700 p-3 rounded mb-4 text-sm'>Semua kolom wajib diisi!</div>";
    }
}

// Ambil daftar komentar yang sudah disetujui (approved)
$komentar_query = $conn->query("SELECT * FROM comments WHERE post_id = $article_id AND status = 'approved' ORDER BY created_at DESC");

// Ambil Artikel Terkait (dalam kategori yang sama)
$kat_id = $article['category_id'];
$terkait_query = $conn->query("SELECT title, slug, image, created_at FROM posts WHERE category_id = $kat_id AND id != $article_id AND status = 'published' ORDER BY RAND() LIMIT 3");

// ---------------------------------------------------------
// PEMBERSIHAN KONTEN OTOMATIS (MENCEGAH ERROR COPY-PASTE)
// ---------------------------------------------------------
$konten_artikel = $article['content'];
// 1. Buang atribut style "--tw" raksasa bawaan copy-paste dari website/Tailwind
$konten_artikel = preg_replace('/style="[^"]*--tw-[^"]*"/i', '', $konten_artikel);
// 2. Ubah tag <h1> yang keliru membungkus paragraf menjadi <div> agar tidak memicu teks tebal raksasa
$konten_artikel = str_ireplace(['<h1>', '</h1>'], ['<div class="reset-h1">', '</div>'], $konten_artikel);

// ---------------------------------------------------------
// PERSIAPAN META TAGS UNTUK SHARE MEDIA SOSIAL
// ---------------------------------------------------------
// Buat URL absolut untuk halaman ini
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$current_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Cari base path aplikasi (berguna jika ditaruh di sub-folder)
$base_path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $base_path;

// Buat URL absolut untuk gambar thumbnail
if (!empty($article['image'])) {
    $og_image = $base_url . '/assets/uploads/' . $article['image'];
} else {
    $og_image = $base_url . '/assets/images/ypp.png'; // Fallback gambar default
}

// Buat deskripsi singkat dari konten (hapus HTML, batasi maksimal 150 karakter)
$og_desc = strip_tags($article['content']);
$og_desc = substr($og_desc, 0, 150) . '...';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article['title'] ?> - <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></title>
    
    <!-- PRIMARY META TAGS -->
    <meta name="title" content="<?= $article['title'] ?>">
    <meta name="description" content="<?= htmlspecialchars($og_desc) ?>">

    <!-- OPEN GRAPH / FACEBOOK / WHATSAPP -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= $current_url ?>">
    <meta property="og:title" content="<?= $article['title'] ?>">
    <meta property="og:description" content="<?= htmlspecialchars($og_desc) ?>">
    <meta property="og:image" content="<?= $og_image ?>">
    <meta property="og:site_name" content="<?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?>">

    <!-- TWITTER CARDS -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= $current_url ?>">
    <meta name="twitter:title" content="<?= $article['title'] ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($og_desc) ?>">
    <meta name="twitter:image" content="<?= $og_image ?>">

    <link rel="icon" type="image/png" href="../assets/images/ypp.png">
    
    <!-- Tailwind tanpa plugin typography agar tidak merusak format konten -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
    /* CSS MANUAL UNTUK SUMMERNOTE (MENGEMBALIKAN EFEK LIST, BOLD, DLL) */
    .artikel-konten {
        color: #374151;
        line-height: 1.8;
        font-size: 1.05rem;
    }
    .artikel-konten p {
        margin-bottom: 1.25rem;
    }
    .artikel-konten b, .artikel-konten strong {
        font-weight: 700 !important;
    }
    .artikel-konten i, .artikel-konten em {
        font-style: italic !important;
    }
    .artikel-konten u {
        text-decoration: underline !important;
    }
    /* Mengembalikan List Number dan Bullet */
    .artikel-konten ul {
        list-style-type: disc !important;
        padding-left: 2.5rem !important;
        margin-bottom: 1.25rem;
    }
    .artikel-konten ol {
        list-style-type: decimal !important;
        padding-left: 2.5rem !important;
        margin-bottom: 1.25rem;
    }
    .artikel-konten li {
        margin-bottom: 0.5rem;
    }
    /* Heading Normal */
    .artikel-konten h2 { font-size: 1.5rem; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; }
    .artikel-konten h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .artikel-konten h4, .artikel-konten h5, .artikel-konten h6 { font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.5rem; }
    
    /* Mengembalikan Quote (Kutipan) */
    .artikel-konten blockquote {
        border-left: 4px solid #10b981;
        background-color: #f9fafb;
        padding: 1rem 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #4b5563;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    .artikel-konten a {
        color: #059669;
        text-decoration: underline;
    }
    .artikel-konten a:hover {
        color: #047857;
    }
    .artikel-konten img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
    /* Menjaga class pembungkus h1 agar normal */
    .artikel-konten .reset-h1 {
        display: block;
        font-weight: normal;
    }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- HEADER SEDERHANA -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-lg overflow-hidden flex items-center justify-center bg-white shadow-sm border">
                    <img src="assets/ypp.png" alt="Logo Pesantren" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-lg font-bold text-emerald-900"><?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?></h1>
                    <p class="text-xs text-gray-500">Portal Berita Resmi</p>
                </div>
            </a>
            <a href="index.php" class="text-sm text-emerald-700 font-semibold hover:underline"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda</a>
        </div>
    </header>

    <!-- KONTEN UTAMA ARTIKEL -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        
        <!-- Breadcrumb -->
        <nav class="text-xs text-gray-500 mb-4 space-x-2">
            <a href="index.php" class="hover:underline">Beranda</a>
            <span>&gt;</span>
            <span class="text-emerald-700 font-semibold"><?= $article['kategori'] ?? 'Umum' ?></span>
            <span>&gt;</span>
            <span class="text-gray-700 truncate"><?= $article['title'] ?></span>
        </nav>

        <!-- Artikel Card -->
        <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-10 mb-8">
            
            <!-- Kategori & Judul -->
            <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider mb-3 inline-block">
                <?= $article['kategori'] ?? 'Umum' ?>
            </span>
            <h1 class="text-2xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">
                <?= $article['title'] ?>
            </h1>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center text-xs text-gray-500 border-b border-gray-100 pb-4 mb-6 space-x-4">
                <span><i class="fas fa-user mr-1 text-emerald-600"></i> <?= $article['penulis'] ?? 'Admin' ?></span>
                <span><i class="fas fa-calendar-alt mr-1 text-emerald-600"></i> <?= date('d M Y, H:i', strtotime($article['created_at'])) ?> WIB</span>
                <span><i class="fas fa-eye mr-1 text-emerald-600"></i> <?= $article['views'] ?> Dilihat</span>
            </div>

            <!-- Gambar Utama -->
            <?php if(!empty($article['image'])): ?>
           <div class="mb-8 rounded-lg overflow-hidden max-h-[450px] bg-gray-100 flex justify-center items-center">
                <img src="assets/uploads/<?= $article['image'] ?>" alt="<?= $article['title'] ?>" class="w-full h-full object-cover">
            </div>                 
            <?php endif; ?>

            <!-- Isi Konten Artikel (Telah di-filter dari format kotor) -->
            <div class="artikel-konten">
                <?= $konten_artikel ?>
            </div>

            <!-- Tombol Bagikan Sosial Media -->
            <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-between flex-wrap gap-4">
                <span class="text-xs font-bold text-gray-600 uppercase">Bagikan artikel ini:</span>
                <div class="flex space-x-2 text-white text-xs">
                    <a href="https://api.whatsapp.com/send?text=<?= urlencode($article['title'] . ' - ' . $current_url) ?>" target="_blank" class="bg-green-600 hover:bg-green-700 px-3 py-2 rounded flex items-center space-x-1">
                        <i class="fab fa-whatsapp"></i> <span>WhatsApp</span>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($current_url) ?>" target="_blank" class="bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded flex items-center space-x-1">
                        <i class="fab fa-facebook-f"></i> <span>Facebook</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=<?= urlencode($article['title']) ?>&url=<?= urlencode($current_url) ?>" target="_blank" class="bg-sky-500 hover:bg-sky-600 px-3 py-2 rounded flex items-center space-x-1">
                        <i class="fab fa-twitter"></i> <span>Twitter</span>
                    </a>
                </div>
            </div>

        </article>

        <!-- ARTIKEL TERKAIT -->
        <?php if($terkait_query->num_rows > 0): ?>
        <section class="mb-10">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-l-4 border-emerald-600 pl-3">Artikel Terkait</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php while($rel = $terkait_query->fetch_assoc()): ?>
                <div class="bg-white rounded-lg shadow-sm border p-4 flex flex-col justify-between">
                    <div>
                        <div class="h-32 bg-gray-100 rounded mb-3 overflow-hidden">
                            <?php $rel_img = !empty($rel['image']) ? "assets/uploads/" . $rel['image'] : "https://via.placeholder.com/300x200"; ?>
                            <img src="<?= $rel_img ?>" class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-xs font-bold text-gray-800 line-clamp-2 mb-2">
                            <a href="artikel.php?slug=<?= $rel['slug'] ?>" class="hover:text-emerald-700"><?= $rel['title'] ?></a>
                        </h4>
                    </div>
                    <span class="text-[10px] text-gray-400"><?= date('d M Y', strtotime($rel['created_at'])) ?></span>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- KOLOM KOMENTAR -->
        <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Komentar Pembaca</h3>

            <?= $pesan_komentar; ?>

            <!-- Form Kirim Komentar -->
            <form action="" method="POST" class="space-y-4 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="Nama Anda...">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Alamat Email</label>
                        <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="email@domain.com">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Pesan Komentar</label>
                    <textarea name="body" rows="4" required class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-emerald-500 focus:border-emerald-500" placeholder="Tulis tanggapan atau pendapat Anda..."></textarea>
                </div>
                <button type="submit" name="kirim_komentar" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs py-2.5 px-6 rounded-lg transition shadow">
                    Kirim Komentar
                </button>
            </form>

            <!-- List Komentar yang Disetujui -->
            <div class="space-y-4 border-t pt-6">
                <?php if($komentar_query->num_rows > 0): ?>
                    <?php while($kom = $komentar_query->fetch_assoc()): ?>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-bold text-xs text-gray-800"><?= htmlspecialchars($kom['name']) ?></span>
                            <span class="text-[10px] text-gray-400"><?= date('d M Y, H:i', strtotime($kom['created_at'])) ?></span>
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed"><?= nl2br(htmlspecialchars($kom['body'])) ?></p>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-xs text-gray-400 italic">Belum ada komentar untuk artikel ini. Jadilah yang pertama memberikan tanggapan!</p>
                <?php endif; ?>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white mt-16 py-6 text-center text-xs text-gray-500">
        &copy; <?= date('Y') ?> <?= $settings['nama_yayasan'] ?? 'Portal Pesantren' ?>. All Rights Reserved.
    </footer>

</body>
</html>