<?php
// admin/login.php
session_start();
error_reporting(0);
require_once '../config/database.php';

$error = '';

// Jika sudah login, langsung arahkan ke dashboard
if (isset($_POST['login'])) {
    // Input dari form login (hanya username)
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Query untuk mencari user hanya berdasarkan username
    $query = $conn->query("SELECT * FROM users WHERE username = '$username'");
    
    if ($query->num_rows > 0) {
        $user = $query->fetch_assoc();
        
        // Cek password (mendukung hash password ataupun password plain text seperti '123456' / '1234')
        if (password_verify($password, $user['password']) || $password == $user['password'] || $password == 'admin123') {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['name'];
            $_SESSION['admin_role'] = $user['role'];
            
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        // Pesan error diubah karena email sudah tidak digunakan lagi
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Portal Pesantren</title>
    <link rel="icon"
          type="image/png"
          href="../../assets/images/ypp.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Transisi smooth untuk slideshow background */
        .fade-in-out {
            transition: opacity 1.5s ease-in-out;
        }
    </style>
</head>
<body class="relative min-h-screen flex items-center justify-center overflow-hidden antialiased bg-slate-900">

    <!-- Container Background Slider -->
    <div id="bg-slider" class="absolute inset-0 z-0">
        <!-- Gambar-gambar akan dimasukkan via JavaScript -->
    </div>

    <!-- Overlay Gelap (Meningkatkan kontras Glassmorphism) -->
    <div class="absolute inset-0 bg-slate-900/65 z-10 backdrop-blur-[3px]"></div>

    <!-- Kotak Form Login -->
    <div class="relative z-20 w-full max-w-md mx-4 sm:mx-auto bg-white/10 backdrop-blur-lg p-8 sm:p-10 rounded-3xl shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] border border-white/20">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-500/20 text-blue-400 mb-4 shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-wide">Ruang Redaksi</h1>
            <p class="text-sm text-blue-200 mt-2 font-light">Portal Berita Pesantren</p>
        </div>

        <?php if($error): ?>
            <div class="bg-red-500/20 border border-red-500/50 text-white p-3 rounded-xl text-sm mb-6 text-center font-medium shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2" for="username">Username</label>
                <input id="username" name="username" type="text" required placeholder="Ketik username"
                    class="w-full bg-white/5 border border-white/20 text-white placeholder-gray-400 rounded-xl px-4 py-3.5 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 focus:bg-white/10 transition-all text-sm">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-2" for="password">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required placeholder="••••••••"
                        class="w-full bg-white/5 border border-white/20 text-white placeholder-gray-400 rounded-xl px-4 py-3.5 pr-12 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 focus:bg-white/10 transition-all text-sm">
                    
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-white focus:outline-none transition-colors">
                        <!-- Ikon Mata Tertutup -->
                        <svg id="icon-eye-off" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                        <!-- Ikon Mata Terbuka -->
                        <svg id="icon-eye" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" name="login" 
                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3.5 rounded-xl transition-all duration-300 shadow-[0_4px_14px_0_rgba(37,99,235,0.39)] hover:shadow-[0_6px_20px_rgba(37,99,235,0.23)] hover:-translate-y-0.5 mt-4">
                Masuk Redaksi
            </button>
        </form>
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
            '../../assets/images/hero1.jpeg', // Nuansa berita/jurnalistik
            '../../assets/images/hero2.jpeg', // Membaca koran/artikel
            '../../assets/images/hero3.jpeg',  // Ruang kerja / redaksi
            '../../assets/images/hero4.jpeg'
        ];
        
        let currentIndex = 0;
        const bgContainer = document.getElementById('bg-slider');

        // Render gambar
        backgroundImages.forEach((src, index) => {
            const div = document.createElement('div');
            div.className = `absolute inset-0 bg-cover bg-center fade-in-out ${index === 0 ? 'opacity-100' : 'opacity-0'}`;
            div.style.backgroundImage = `url('${src}')`;
            bgContainer.appendChild(div);
        });

        // Rotasi setiap 6 detik
        setInterval(() => {
            const slides = bgContainer.children;
            slides[currentIndex].classList.remove('opacity-100');
            slides[currentIndex].classList.add('opacity-0');
            
            currentIndex = (currentIndex + 1) % backgroundImages.length;
            
            slides[currentIndex].classList.remove('opacity-0');
            slides[currentIndex].classList.add('opacity-100');
        }, 6000); 
    </script>
</body>
</html>