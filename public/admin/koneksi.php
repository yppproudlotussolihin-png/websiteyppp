<?php
// Mengatur zona waktu lokal
date_default_timezone_set('Asia/Jakarta');

$host     = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USERNAME') ?: "u650060179_yppprs";
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : "Yppprs@123";
$database = getenv('DB_DATABASE') ?: "u650060179_yppprs";

// Melakukan koneksi ke server MySQL
$koneksi = @mysqli_connect($host, $username, $password, $database);

// Fallback jika kredensial hosting tidak cocok di lingkungan local (Laragon/XAMPP)
if (!$koneksi) {
    $koneksi = @mysqli_connect('localhost', 'root', '', $database);
    if (!$koneksi) {
        $koneksi = @mysqli_connect('localhost', 'root', '', 'webypp');
    }
}

if (!$koneksi) {
    // Simpan status agar halaman tetap bisa menampilkan peringatan ramah
    // error_log("Koneksi database gagal: " . mysqli_connect_error());
}
?>
