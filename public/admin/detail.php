<?php
require_once 'koneksi.php';
if (!isset($_GET['id'])) { header("Location: admin.php"); exit; }

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = "SELECT * FROM tb_santri WHERE id = '$id'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Lengkap: <?= htmlspecialchars($data['nama_santri']); ?></title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h1 class="text-xl font-bold text-gray-800">Detail Pendaftar: <?= htmlspecialchars($data['nama_santri']) ?></h1>
            <a href="index.php" class="bg-gray-600 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">Kembali ke Daftar</a>
        </div>

        <table class="w-full text-sm">
            <?php
            // Daftar field lengkap sesuai struktur database kamu
            $fields = [
                "DATA SANTRI" => [
                    "Nama Santri" => "nama_santri",
                    "Jenjang Pendidikan" => "jenjang_pendidikan",
                    "Status Mukim" => "mukim",
                    "Unit Pesantren" => "unit_pesantren",
                    "NISY (Induk Yayasan)" => "nisy",
                    "NIK" => "nik",
                    "NISN" => "nisn",
                    "Agama" => "agama",
                    "Jenis Kelamin" => "jenis_kelamin",
                    "Tempat Lahir" => "tempat_lahir",
                    "Tanggal Lahir" => "tanggal_lahir",
                    "Jumlah Saudara Kandung" => "jumlah_saudara",
                    "Anak Ke" => "anak_ke",
                    "Nomor KK" => "nomor_kk",
                    "Nama Kepala Keluarga" => "nama_kepala_keluarga"
                ],
                "DATA AYAH KANDUNG" => [
                    "Status Ayah Kandung" => "status_ayah",
                    "Nama Ayah Kandung" => "nama_ayah",
                    "Agama Ayah" => "agama_ayah",
                    "NIK Ayah" => "nik_ayah",
                    "Tempat Lahir Ayah" => "tempat_lahir_ayah",
                    "Tanggal Lahir Ayah" => "tanggal_lahir_ayah",
                    "Pekerjaan Ayah" => "pekerjaan_ayah",
                    "Pendapatan Ayah" => "pendapatan_ayah",
                    "Pendidikan Terakhir Ayah" => "pendidikan_ayah"
                ],
                "DATA IBU KANDUNG" => [
                    "Status Ibu Kandung" => "status_ibu",
                    "Nama Ibu Kandung" => "nama_ibu",
                    "Agama Ibu" => "agama_ibu",
                    "NIK Ibu" => "nik_ibu",
                    "Tempat Lahir Ibu" => "tempat_lahir_ibu",
                    "Tanggal Lahir Ibu" => "tanggal_lahir_ibu",
                    "Pekerjaan Ibu" => "pekerjaan_ibu",
                    "Pendapatan Ibu" => "pendapatan_ibu",
                    "Pendidikan Terakhir Ibu" => "pendidikan_ibu"
                ],
                "DATA ALAMAT" => [
                    "Alamat Rumah" => "alamat",
                    "RT/RW" => "rt_rw",
                    "Desa/Kelurahan" => "desa_kelurahan",
                    "Kecamatan" => "kecamatan",
                    "Kabupaten" => "kabupaten",
                    "Provinsi" => "provinsi",
                    "Kode Pos" => "kode_pos",
                    "Nomor HP (WhatsApp)" => "nomor_hp"
                ],
                "INFORMASI PENDAFTARAN" => [
                    "Waktu Daftar" => "tgl_pendaftaran"
                ]
            ];

            foreach ($fields as $section => $list) {
                echo "<tr><td colspan='2' class='bg-gray-800 text-white font-bold p-2 mt-4 rounded-t'>$section</td></tr>";
                foreach ($list as $label => $key) {
                    echo "<tr class='border-b hover:bg-gray-50'><td class='p-2 font-semibold text-gray-600 w-1/3'>$label</td><td class='p-2 text-gray-900'>: " . htmlspecialchars($data[$key] ?? '-') . "</td></tr>";
                }
            }
            ?>
        </table>
    </div>
</body>
</html>