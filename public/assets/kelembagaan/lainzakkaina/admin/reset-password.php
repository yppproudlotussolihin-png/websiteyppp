<?php
// File: admin/reset-password.php
require_once '../config/database.php';

$email_target = 'admin@gmail.com'; // Sesuaikan email admin LKZ Anda
$password_baru = 'lkz123456';
$hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);

// Cek apakah akun admin lkz ada
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
$stmt->execute([':email' => $email_target]);
$user = $stmt->fetch();

if ($user) {
    // Update password dan pastikan rolenya 'adminlkz'
    $update = $pdo->prepare("UPDATE users SET password = :pass, role = 'adminlkz' WHERE email = :email");
    $update->execute([':pass' => $hash_baru, ':email' => $email_target]);
    echo "<h2 style='color:green;'>Berhasil! Password untuk <b>$email_target</b> telah di-reset menjadi: <b>$password_baru</b> (Role: adminlkz)</h2>";
} else {
    // Jika belum ada, masukkan data baru ke tabel gabungan
    $insert = $pdo->prepare("INSERT INTO users (name, email, password, whatsapp, role) VALUES ('Miftah Fauzi', :email, :pass, '085174348947', 'adminlkz')");
    $insert->execute([':email' => $email_target, ':pass' => $hash_baru]);
    echo "<h2 style='color:green;'>Berhasil! Akun admin LKZ baru berhasil dibuat dengan email <b>$email_target</b> dan password: <b>$password_baru</b></h2>";
}

echo "<br><a href='login.php' style='padding: 10px 20px; background: #064e3b; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;'>Klik di sini untuk Login Sekarang</a>";
?>