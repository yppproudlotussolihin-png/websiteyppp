<?php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt =$conn->prepare("SELECT * FROM `iktsaro-alumni-tb` WHERE id = ?");
$stmt->bind_param("i", $id);$stmt->execute();
$result =$stmt->get_result();
$data =$result->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

$admin_name = htmlspecialchars($_SESSION['admin_username'] ?? 'Admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail - <?= htmlspecialchars($data['nama_lengkap']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon"
          type="image/png"
          href="../../../../assets/images/ypp.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="index.php" class="flex items-center gap-2 text-slate-500 hover:text-green-600 transition-colors">
                    <span class="text-xl">&larr;</span> <span class="font-semibold">Kembali</span>
                </a>
                <div class="flex items-center gap-4">
                    <div class="text-sm font-medium text-slate-600">
                        Peninjau: <span class="text-green-600 font-bold"><?= $admin_name ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        
        <div class="flex justify-end mb-6">
            <button onclick="downloadPDF()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-sm transition-all duration-200 flex items-center gap-2 text-sm">
                Download PDF
            </button>
        </div>

        <!-- AREA DOKUMEN PDF -->
        <div id="pdf-content" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-10">
            
            <div class="text-center mb-8 pb-6 border-b border-slate-100">
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Data Lengkap Alumni</h1>
                <p class="text-slate-500">Yayasan Pendidikan Pondok Pesantren Roudlotussolihin</p>
            </div>

            <!-- 1. Metadata Sistem -->
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mb-8 flex justify-between items-center text-sm">
                <div><span class="text-slate-500 font-medium mr-2">ID Pendaftaran:</span> <span class="font-bold text-slate-800">#<?= htmlspecialchars($data['id']) ?></span></div>
                <div><span class="text-slate-500 font-medium mr-2">Waktu Masuk:</span> <span class="font-medium text-slate-800"><?= date('d F Y, H:i', strtotime($data['created_at'])) ?></span></div>
                <div>
                    <span class="text-slate-500 font-medium mr-2">Status Data:</span> 
                    <span class="font-bold uppercase <?= $data['status'] == 'approved' ? 'text-green-600' : ($data['status'] == 'rejected' ? 'text-red-600' : 'text-amber-600') ?>">
                        <?= htmlspecialchars($data['status']) ?>
                    </span>
                </div>
            </div>

            <!-- 2. Identitas Alumni -->
            <h2 class="text-lg font-bold text-green-600 mb-4 uppercase tracking-wider text-sm border-b pb-2">Bagian 1: Identitas Alumni</h2>
            <div class="grid grid-cols-2 gap-y-5 gap-x-8 mb-10 text-sm">
                <div><span class="block text-slate-400 mb-1 text-xs uppercase tracking-wide">Nama Lengkap</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['nama_lengkap']) ?></p></div>
                <div><span class="block text-slate-400 mb-1 text-xs uppercase tracking-wide">Tahun Lulus & Lembaga</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['lembaga']) ?> - <?= htmlspecialchars($data['tahun_lulus']) ?></p></div>
                <div><span class="block text-slate-400 mb-1 text-xs uppercase tracking-wide">Email</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['email']) ?></p></div>
                <div><span class="block text-slate-400 mb-1 text-xs uppercase tracking-wide">Nomor WhatsApp</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['no_wa']) ?></p></div>
                <div class="col-span-2"><span class="block text-slate-400 mb-1 text-xs uppercase tracking-wide">Domisili Saat Ini</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['domisili']) ?></p></div>
                <div class="col-span-2"><span class="block text-slate-400 mb-1 text-xs uppercase tracking-wide">Pekerjaan / Profesi</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['pekerjaan']) ?></p></div>
                <div class="col-span-2"><span class="block text-slate-400 mb-1 text-xs uppercase tracking-wide">Sosial Media (IG/LinkedIn)</span><p class="font-medium text-indigo-600"><?= !empty($data['sosmed']) ? htmlspecialchars($data['sosmed']) : '-' ?></p></div>
            </div>

            <!-- 3. Kisah & Pengalaman -->
            <h2 class="text-lg font-bold text-green-600 mb-4 uppercase tracking-wider text-sm border-b pb-2">Bagian 2: Kisah & Pengalaman</h2>
            <div class="space-y-6 mb-10 text-sm">
                <div>
                    <span class="block text-slate-400 mb-2 text-xs uppercase tracking-wide">Kesan selama di pesantren</span>
                    <p class="text-slate-800 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100"><?= nl2br(htmlspecialchars($data['kesan'])) ?></p>
                </div>
                <div>
                    <span class="block text-slate-400 mb-2 text-xs uppercase tracking-wide">Perjalanan setelah lulus</span>
                    <p class="text-slate-800 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100"><?= nl2br(htmlspecialchars($data['perjalanan'])) ?></p>
                </div>
                <div>
                    <span class="block text-slate-400 mb-2 text-xs uppercase tracking-wide">Tantangan & Cara Mengatasinya</span>
                    <p class="text-slate-800 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100"><?= nl2br(htmlspecialchars($data['tantangan'])) ?></p>
                </div>
                <div>
                    <span class="block text-slate-400 mb-2 text-xs uppercase tracking-wide">Prestasi yang dibanggakan</span>
                    <p class="text-slate-800 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100"><?= nl2br(htmlspecialchars($data['prestasi'])) ?></p>
                </div>
                <div>
                    <span class="block text-slate-400 mb-2 text-xs uppercase tracking-wide">Nilai pesantren yang berpengaruh</span>
                    <p class="text-slate-800 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100"><?= nl2br(htmlspecialchars($data['pelajaran'])) ?></p>
                </div>
                <div>
                    <span class="block text-slate-400 mb-2 text-xs uppercase tracking-wide">Pesan untuk santri</span>
                    <p class="text-slate-800 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100"><?= nl2br(htmlspecialchars($data['pesan'])) ?></p>
                </div>
            </div>

            <!-- 4. Karya Alumni -->
            <h2 class="text-lg font-bold text-green-600 mb-4 uppercase tracking-wider text-sm border-b pb-2">Bagian 3: Karya Alumni</h2>
            <?php if($data['punya_karya'] == 'ya'): ?>
                <div class="bg-indigo-50 p-5 rounded-xl border border-indigo-100 mb-10 text-sm">
                    <div class="grid grid-cols-2 gap-4 mb-5">
                        <div><span class="block text-slate-500 mb-1 text-xs uppercase">Judul Karya</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['judul_karya']) ?></p></div>
                        <div><span class="block text-slate-500 mb-1 text-xs uppercase">Jenis Karya</span><p class="font-medium text-slate-900"><?= htmlspecialchars($data['jenis_karya']) ?></p></div>
                    </div>
                    <div class="mb-5">
                        <span class="block text-slate-500 mb-2 text-xs uppercase">Deskripsi Karya</span>
                        <p class="text-slate-800 bg-white p-3 rounded border border-indigo-100/50"><?= nl2br(htmlspecialchars($data['deskripsi_karya'])) ?></p>
                    </div>
                    <div>
                        <span class="block text-slate-500 mb-1 text-xs uppercase">Link Eksternal Karya</span>
                        <?= !empty($data['link_karya']) ? '<a href="'.htmlspecialchars($data['link_karya']).'" target="_blank" class="text-indigo-600 font-medium hover:underline break-all">'.htmlspecialchars($data['link_karya']).'</a>' : '<span class="text-slate-500">- Tidak ada link -</span>' ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="mb-10 text-sm text-slate-500 italic bg-slate-50 p-4 rounded-lg border border-slate-100">Alumni ini menyatakan tidak memiliki karya khusus untuk diunggah.</div>
            <?php endif; ?>

            <!-- 5. Dokumentasi Tersimpan -->
            <h2 class="text-lg font-bold text-green-600 mb-4 uppercase tracking-wider text-sm border-b pb-2">Bagian 4: Nama File Lampiran Server</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm bg-slate-50 p-5 rounded-xl border border-slate-100">
                <div>
                    <span class="block text-slate-400 mb-1 text-xs uppercase">File Foto Diri</span>
                    <p class="font-medium text-slate-700 truncate" title="<?= htmlspecialchars($data['foto_diri']) ?>"><?= !empty($data['foto_diri']) ? htmlspecialchars($data['foto_diri']) : '-' ?></p>
                </div>
                <div>
                    <span class="block text-slate-400 mb-1 text-xs uppercase">File Foto Aktivitas</span>
                    <p class="font-medium text-slate-700 truncate" title="<?= htmlspecialchars($data['foto_aktivitas']) ?>"><?= !empty($data['foto_aktivitas']) ? htmlspecialchars($data['foto_aktivitas']) : '-' ?></p>
                </div>
                <div>
                    <span class="block text-slate-400 mb-1 text-xs uppercase">File Karya Dokumen</span>
                    <p class="font-medium text-slate-700 truncate" title="<?= htmlspecialchars($data['file_karya']) ?>"><?= !empty($data['file_karya']) ? htmlspecialchars($data['file_karya']) : '-' ?></p>
                </div>
            </div>

            <!-- Tombol Aksi Persetujuan (Hanya Tampil di Layar, Sembunyi Saat PDF) -->
            <?php if($data['status'] == 'pending'): ?>
            <div class="mt-10 flex gap-4 html2pdf__page-break-avoid">
                <a href="index.php?action=approve&id=<?= $data['id'] ?>" class="flex-1 text-center bg-green-50 hover:bg-green-100 text-green-700 font-bold py-3 rounded-xl border border-green-200 transition-colors">Terima & Publikasikan</a>
                <a href="index.php?action=reject&id=<?= $data['id'] ?>" class="flex-1 text-center bg-red-50 hover:bg-red-100 text-red-700 font-bold py-3 rounded-xl border border-red-200 transition-colors">Tolak Kisah Ini</a>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Script Export PDF -->
    <script>
        function downloadPDF() {
            // Sembunyikan tombol aksi persetujuan saat print PDF
            const actionButtons = document.querySelector('.html2pdf__page-break-avoid');
            if(actionButtons) actionButtons.style.display = 'none';

            const element = document.getElementById('pdf-content');
            const nama = "<?= addslashes($data['nama_lengkap']) ?>";
            
            const opt = {
                margin:       [10, 10, 10, 10], // Margin atas, kiri, bawah, kanan
                filename:     'Data_Alumni_' + nama + '.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, scrollY: 0 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Download proses dan kembalikan tombol
            html2pdf().set(opt).from(element).save().then(() => {
                if(actionButtons) actionButtons.style.display = 'flex';
            });
        }
    </script>
</body>
</html>