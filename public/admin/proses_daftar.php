<?php
// Beritahu browser bahwa file ini mengembalikan respon berupa JSON
header('Content-Type: application/json');

// Panggil file koneksi database
require_once 'koneksi.php';

// Menangkap payload JSON yang dikirim oleh JavaScript Fetch API
$inputRaw = file_get_contents('php://input');
$data = json_decode($inputRaw, true);

// Jika data kosong atau gagal di-decode, kembalikan status error
if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada data yang diterima']);
    exit;
}

// Fungsi bantu untuk membersihkan data (Sanitasi input agar aman)
function bersihkan($koneksi, $nilai) {
    return mysqli_real_escape_string($koneksi, trim($nilai));
}

// Ambil dan amankan semua data dari objek frontend
$nama_santri        = bersihkan($koneksi, $data['nama_santri']);
$nik                = bersihkan($koneksi, $data['nik']);
$nisn               = bersihkan($koneksi, $data['nisn'] ?? '');
$jenis_kelamin      = bersihkan($koneksi, $data['jenis_kelamin']);
$tempat_lahir       = bersihkan($koneksi, $data['tempat_lahir']);
$tanggal_lahir      = bersihkan($koneksi, $data['tanggal_lahir']);
$agama              = bersihkan($koneksi, $data['agama']);
$jumlah_saudara     = (int)$data['jumlah_saudara'];
$anak_ke            = (int)$data['anak_ke'];
$tinggi_badan       = (int)$data['tinggi_badan'];
$berat_badan        = (int)$data['berat_badan'];
$hobi               = bersihkan($koneksi, $data['hobi']);
$cita_cita          = bersihkan($koneksi, $data['cita_cita']);
$jenjang_pendidikan = bersihkan($koneksi, $data['jenjang_pendidikan']);
$mukim              = bersihkan($koneksi, $data['mukim']);
$unit_pesantren     = bersihkan($koneksi, $data['unit_pesantren'] ?? '');
$nomor_kk             = bersihkan($koneksi, $data['nomor_kk']);
$nama_kepala_keluarga = bersihkan($koneksi, $data['nama_kepala_keluarga']);

$status_ayah        = bersihkan($koneksi, $data['status_ayah']);
$nama_ayah          = bersihkan($koneksi, $data['nama_ayah']);
$nik_ayah           = bersihkan($koneksi, $data['nik_ayah'] ?? '');
$agama_ayah         = bersihkan($koneksi, $data['agama_ayah'] ?? '');
$tempat_lahir_ayah  = bersihkan($koneksi, $data['tempat_lahir_ayah'] ?? '');
$tanggal_lahir_ayah = bersihkan($koneksi, $data['tanggal_lahir_ayah'] ?? '');
$pendidikan_ayah    = bersihkan($koneksi, $data['pendidikan_ayah'] ?? '');
$pekerjaan_ayah     = bersihkan($koneksi, $data['pekerjaan_ayah'] ?? '');
$pendapatan_ayah    = bersihkan($koneksi, $data['pendapatan_ayah'] ?? '');

$status_ibu         = bersihkan($koneksi, $data['status_ibu']);
$nama_ibu           = bersihkan($koneksi, $data['nama_ibu']);
$nik_ibu            = bersihkan($koneksi, $data['nik_ibu'] ?? '');
$agama_ibu          = bersihkan($koneksi, $data['agama_ibu'] ?? '');
$tempat_lahir_ibu   = bersihkan($koneksi, $data['tempat_lahir_ibu'] ?? '');
$tanggal_lahir_ibu  = bersihkan($koneksi, $data['tanggal_lahir_ibu'] ?? '');
$pendidikan_ibu     = bersihkan($koneksi, $data['pendidikan_ibu'] ?? '');
$pekerjaan_ibu      = bersihkan($koneksi, $data['pekerjaan_ibu'] ?? '');
$pendapatan_ibu     = bersihkan($koneksi, $data['pendapatan_ibu'] ?? '');

$nomor_hp           = bersihkan($koneksi, $data['nomor_hp']);
$alamat             = bersihkan($koneksi, $data['alamat']);
$rt_rw              = bersihkan($koneksi, $data['rt_rw']);
$desa_kelurahan     = bersihkan($koneksi, $data['desa_kelurahan']);
$kecamatan          = bersihkan($koneksi, $data['kecamatan']);
$kabupaten          = bersihkan($koneksi, $data['kabupaten']);
$provinsi           = bersihkan($koneksi, $data['provinsi']);
$kode_pos           = bersihkan($koneksi, $data['kode_pos']);

// Menyusun perintah SQL INSERT INTO untuk menyimpan data secara utuh
// Pastikan nama_kepala_keluarga dimasukkan ke SQL
$query = "INSERT INTO tb_santri (
    nama_santri, nik, nisn, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, 
    jumlah_saudara, anak_ke, tinggi_badan, berat_badan, hobi, cita_cita, 
    jenjang_pendidikan, mukim, unit_pesantren,
    nomor_kk, nama_kepala_keluarga, 
    status_ayah, nama_ayah, nik_ayah, agama_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, pendidikan_ayah, pekerjaan_ayah, pendapatan_ayah,
    status_ibu, nama_ibu, nik_ibu, agama_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, pendidikan_ibu, pekerjaan_ibu, pendapatan_ibu,
    nomor_hp, alamat, rt_rw, desa_kelurahan, kecamatan, kabupaten, provinsi, kode_pos
) VALUES (
    '$nama_santri', '$nik', '$nisn', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$agama', 
    $jumlah_saudara, $anak_ke, $tinggi_badan, $berat_badan, '$hobi', '$cita_cita', 
    '$jenjang_pendidikan', '$mukim', '$unit_pesantren',
    '$nomor_kk', '$nama_kepala_keluarga',
    '$status_ayah', '$nama_ayah', '$nik_ayah', '$agama_ayah', '$tempat_lahir_ayah', '$tanggal_lahir_ayah', '$pendidikan_ayah', '$pekerjaan_ayah', '$pendapatan_ayah',
    '$status_ibu', '$nama_ibu', '$nik_ibu', '$agama_ibu', '$tempat_lahir_ibu', '$tanggal_lahir_ibu', '$pendidikan_ibu', '$pekerjaan_ibu', '$pendapatan_ibu',
    '$nomor_hp', '$alamat', '$rt_rw', '$desa_kelurahan', '$kecamatan', '$kabupaten', '$provinsi', '$kode_pos'
)";

// Eksekusi query ke MySQL dan kirim respon ke Javascript frontend
try {
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Pendaftaran berhasil disimpan ke database']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan ke database: ' . mysqli_error($koneksi)]);
    }
} catch (mysqli_sql_exception $e) {
    // Menangkap error fatal dari MySQL (termasuk masalah Trigger Hostinger) dan mengembalikannya sebagai JSON
    echo json_encode(['status' => 'error', 'message' => 'Error Server/Database: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Kesalahan Sistem: ' . $e->getMessage()]);
}

// Tutup koneksi database
if (isset($koneksi)) {
    mysqli_close($koneksi);
}
?>