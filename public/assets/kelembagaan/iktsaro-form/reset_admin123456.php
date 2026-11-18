<?php
require 'config.php';

// Menghapus data admin lama agar tidak menumpuk
$conn->query("TRUNCATE TABLE `iktsaro-admin-tb`");

// Membuat password baru (misalnya: admin123)
$username = 'admin';$password_baru = 'admin123';
$hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);

// Memasukkan ke database
$stmt =$conn->prepare("INSERT INTO `iktsaro-admin-tb` (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username,$hashed_password);

if ($stmt->execute()) {
    echo "<h1>Reset Berhasil!</h1>";
    echo "Silakan coba login dengan:<br>";
    echo "Username: <b>$username</b><br>";
    echo "Password: <b>$password_baru</b><br>";
    echo "<br><a href='admin/login.php'>Klik di sini untuk ke halaman login</a>";
} else {
    echo "Gagal mereset: " . $conn->error;
}
?>