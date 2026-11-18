<?php
// Mulai session di baris paling atas
session_start();

// Cek apakah admin sudah login, jika belum lempar ke halaman login.php
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
    header("Location: login.php");
    exit;
}

// Memanggil jembatan koneksi ke database
require_once 'koneksi.php';

// Perintah SQL untuk mengambil semua data santri, diurutkan dari yang terbaru mendaftar (id DESC)
$query = "SELECT * FROM tb_santri ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - PPDB Roudlotussolihin</title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="p-4 md:p-8">

    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl font-bold text-emerald-800">Data Pendaftar PPDB</h1>
                <!-- Menampilkan informasi siapa yang sedang login -->
                <p class="text-gray-500 text-sm mt-1">
                    Selamat datang, <span class="font-semibold text-emerald-700"><?= htmlspecialchars($_SESSION['nama_lengkap']); ?></span> (<?= htmlspecialchars($_SESSION['username']); ?>)
                </p>
            </div>
            <div class="flex flex-wrap gap-3 items-center">
                <a href="export_excel.php" 
                         class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-sm flex items-center gap-2">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                         Export Excel
                </a>
                <a href="export_pdf.php" target="_blank"
                         class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition shadow-sm flex items-center gap-2">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                         Export PDF
                </a>
                <a href="pesan.php"
                         class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                        Pesan Masuk
                </a>
                <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')"
                         class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                        Logout
                </a>
            </div>
        </div>

<?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'berhasil_hapus'): ?>
    <div class="bg-emerald-100 text-emerald-800 p-3 rounded-lg mb-4 text-sm font-semibold">
        ✅ Data berhasil dihapus dari database.
    </div>
<?php endif; ?>


        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-900 border-b border-emerald-100">
                            <th class="p-4 font-semibold text-sm whitespace-nowrap">No</th>
                            <th class="p-4 font-semibold text-sm whitespace-nowrap">Nama Santri</th>
                            <th class="p-4 font-semibold text-sm whitespace-nowrap">Jenjang</th>
                            <th class="p-4 font-semibold text-sm whitespace-nowrap">Status Mukim</th>
                            <th class="p-4 font-semibold text-sm whitespace-nowrap">No. WhatsApp</th>
                            <th class="p-4 font-semibold text-sm whitespace-nowrap">Waktu Daftar</th>
                            <th class="p-4 font-semibold text-sm text-center whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($baris = mysqli_fetch_assoc($hasil)) {
                        ?>
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="p-4 text-sm text-gray-500"><?= $no++; ?></td>
                            <td class="p-4">
                                <div class="font-bold text-gray-800"><?= htmlspecialchars($baris['nama_santri']); ?></div>
                                <div class="text-xs text-gray-500 mt-1">NIK: <?= htmlspecialchars($baris['nik']); ?></div>
                            </td>
                            <td class="p-4 text-sm text-gray-700 font-medium"><?= htmlspecialchars($baris['jenjang_pendidikan']); ?></td>
                            <td class="p-4">
                                <?php if($baris['mukim'] == 'Mukim'): ?>
                                    <span class="bg-emerald-100 text-emerald-800 text-xs px-3 py-1 rounded-full font-semibold">Mukim</span>
                                <?php else: ?>
                                    <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-semibold">Tidak Mukim</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 text-sm text-gray-600"><?= htmlspecialchars($baris['nomor_hp']); ?></td>
                            <td class="p-4 text-sm text-gray-500">
                                <?= date('d/m/Y H:i', strtotime($baris['tgl_pendaftaran'])); ?> WIB
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="detail.php?id=<?= $baris['id']; ?>" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded text-xs font-bold transition inline-block">
                                            Detail 
                                    </a>

                                    <a href="hapus.php?id=<?= $baris['id']; ?>" 
                                            onclick="return confirm('Yakin ingin menghapus data <?= htmlspecialchars($baris['nama_santri']); ?>?')"
                                            class="bg-rose-50 text-rose-600 hover:bg-rose-100 px-3 py-1.5 rounded text-xs font-bold transition inline-block">
                                            Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        } 
                        if(mysqli_num_rows($hasil) == 0) {
                            echo "<tr><td colspan='7' class='p-8 text-center text-gray-500 font-medium'>Belum ada data pendaftar masuk.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

</body>
</html>


<?php
$queryPesan = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_pesan_kontak
     ORDER BY id DESC"
);
?>

<div class="max-w-7xl mx-auto mt-8 mb-8">
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-5 border-b border-gray-100">
        <h2 class="text-2xl font-bold text-emerald-800">
            Pesan Kontak Website
        </h2>
        <p class="text-gray-500 text-sm">
            Pesan dari seluruh website yayasan
        </p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-emerald-50 text-emerald-900 border-b border-emerald-100">
                    <th class="p-4">No</th>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Pesan</th>
                    <th class="p-4">Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $noPesan = 1;
            while($row = mysqli_fetch_assoc($queryPesan)){
            ?>
                <tr class="border-b border-gray-50 hover:bg-gray-50">
                    <td class="p-4"><?= $noPesan++; ?></td>
                    <td class="p-4 font-semibold"><?= htmlspecialchars($row['nama']); ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['email']); ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['pesan']); ?></td>
                    <td class="p-4 text-gray-500"><?= date('d/m/Y H:i',strtotime($row['tanggal'])); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>