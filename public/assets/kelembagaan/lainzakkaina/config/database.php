<?php
// File: config/database.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host     = getenv('DB_HOST') ?: 'localhost';
$dbname   = getenv('DB_DATABASE') ?: 'u650060179_yppprs';
$username = getenv('DB_USERNAME') ?: 'u650060179_yppprs';
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'Yppprs@123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Coba fallback root tanpa password
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8mb4", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e2) {
        // Fallback db webypp
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=webypp;charset=utf8mb4", 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e3) {
            // Biarkan null jika database belum diimport di lokal
            $pdo = null;
        }
    }
}
?>
