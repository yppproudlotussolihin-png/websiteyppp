<?php
// File: admin/login.php
require_once '../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        // Ubah pengecekan role menjadi 'adminlkz' sesuai struktur tabel gabungan baru
        $stmt =$pdo->prepare("SELECT * FROM users WHERE email = :email AND role = 'adminlkz' LIMIT 1");
        $stmt->execute([':email' =>$email]);
        $user =$stmt->fetch();

        if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
            // Set session login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] =$user['id'];
            $_SESSION['admin_nama'] =$user['name']; // Menggunakan kolom 'name' dari tabel gabungan
            $_SESSION['admin_email'] =$user['email'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Email atau password salah, atau Anda bukan Admin LKZ.";
        }
    } catch (PDOException $e) {$error = "Terjadi kesalahan sistem: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - LAINZAKKAINA</title>
    <link rel="icon"
          type="image/png"
          href="../../../images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi tambahan agar transisi lebih smooth jika diperlukan */
        .fade-in-out {
            transition: opacity 1.5s ease-in-out;
        }
    </style>
</head>
<body class="relative min-h-screen flex items-center justify-center overflow-hidden antialiased font-sans">

    <!-- Background Slider Container -->
    <div id="bg-slider" class="absolute inset-0 z-0 bg-gray-900">
        <!-- Gambar akan dimuat via JavaScript -->
    </div>

    <!-- Overlay Gelap agar form tetap kontras & terbaca -->
    <div class="absolute inset-0 bg-black/50 z-10"></div>

    <!-- Container Form Login (Glassmorphism Effect) -->
    <div class="relative z-20 w-full max-w-md mx-4 sm:mx-auto bg-white/10 backdrop-blur-md p-8 sm:p-10 rounded-3xl shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] border border-white/20">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-serif font-bold text-white tracking-wide drop-shadow-md">LAINZAKKAINA<span class="text-yellow-400">.</span></h1>
            <p class="text-sm text-gray-200 mt-2 font-light">Panel Autentikasi Pengelola</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-500/20 border border-red-500/50 text-white backdrop-blur-sm p-3 rounded-xl text-sm mb-6 text-center font-medium shadow-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="space-y-6">
            <div>
                <label class="block text-gray-100 text-sm font-medium mb-2">Email Admin</label>
                <div class="relative">
                    <input type="email" name="email" required placeholder="admin@lainzakkaina.com" 
                        class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 rounded-xl px-4 py-3.5 focus:outline-none focus:border-emerald-400 focus:ring-1 focus:ring-emerald-400 focus:bg-white/20 transition-all text-sm">
                </div>
            </div>

            <div>
                <label class="block text-gray-100 text-sm font-medium mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                        class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 rounded-xl px-4 py-3.5 pr-12 focus:outline-none focus:border-emerald-400 focus:ring-1 focus:ring-emerald-400 focus:bg-white/20 transition-all text-sm">
                    
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-300 hover:text-white focus:outline-none transition-colors">
                        <svg id="icon-eye-off" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                        <svg id="icon-eye" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3.5 rounded-xl transition-all duration-300 shadow-[0_4px_14px_0_rgba(5,150,105,0.39)] hover:shadow-[0_6px_20px_rgba(5,150,105,0.23)] hover:-translate-y-0.5">
                Masuk ke Dashboard
            </button>
        </form>
        
        <div class="mt-8 text-center text-xs">
            <a href="../index.php" class="text-gray-300 hover:text-white transition-colors duration-200 inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda Website
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Fitur Toggle Password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const iconEye = document.getElementById('icon-eye');
            const iconEyeOff = document.getElementById('icon-eye-off');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconEye.classList.remove('hidden');
                iconEyeOff.classList.add('hidden');
            } else {
                passwordInput.type = 'password';
                iconEye.classList.add('hidden');
                iconEyeOff.classList.remove('hidden');
            }
        }

        // Fitur Slideshow Background Otomatis
        const backgroundImages = [
            '../../../images/hero1.jpeg', // Estetik Kantor/Bisnis
            '../../../images/hero2.jpeg', // Ruang kerja modern
            '../../../images/hero3.jpeg',  // Arsitektur profesional
            '../../../images/hero4.jpeg'
        ];
        
        let currentIndex = 0;
        const bgContainer = document.getElementById('bg-slider');

        // Preload dan inisialisasi gambar
        backgroundImages.forEach((src, index) => {
            const div = document.createElement('div');
            div.className = `absolute inset-0 bg-cover bg-center fade-in-out ${index === 0 ? 'opacity-100' : 'opacity-0'}`;
            div.style.backgroundImage = `url('${src}')`;
            bgContainer.appendChild(div);
        });

        // Rotasi gambar setiap 6 detik
        setInterval(() => {
            const slides = bgContainer.children;
            // Sembunyikan gambar saat ini
            slides[currentIndex].classList.remove('opacity-100');
            slides[currentIndex].classList.add('opacity-0');
            
            // Pindah ke indeks berikutnya
            currentIndex = (currentIndex + 1) % backgroundImages.length;
            
            // Tampilkan gambar berikutnya
            slides[currentIndex].classList.remove('opacity-0');
            slides[currentIndex].classList.add('opacity-100');
        }, 6000); // 6000 ms = 6 detik
    </script>
</body>
</html>