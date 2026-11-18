<?php
// config.php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USERNAME') ?: 'u650060179_yppprs';
$pass = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'Yppprs@123';
$db   = getenv('DB_DATABASE') ?: 'u650060179_yppprs';

$conn = @new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    // Fallback local Laragon/XAMPP
    $conn = @new mysqli('localhost', 'root', '', $db);
    if ($conn->connect_error) {
        $conn = @new mysqli('localhost', 'root', '', 'webypp');
    }
}
?>
