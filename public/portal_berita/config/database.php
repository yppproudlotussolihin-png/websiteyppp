<?php
// config/database.php

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USERNAME') ?: 'u650060179_yppprs';
$pass = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'Yppprs@123';
$db   = getenv('DB_DATABASE') ?: 'u650060179_yppprs';

$conn = @new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    // Fallback jika kredensial hosting tidak cocok di lingkungan local (Laragon/XAMPP)
    $conn = @new mysqli('localhost', 'root', '', $db);
    if ($conn->connect_error) {
        $conn = @new mysqli('localhost', 'root', '', 'webypp');
    }
}

// Mulai session di sini agar bisa digunakan di semua halaman yang meng-include file ini
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
