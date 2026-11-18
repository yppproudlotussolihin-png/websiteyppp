<?php
session_start();
require_once 'koneksi.php';

$error = '';

if (isset($_POST['login'])) {$username = mysqli_real_escape_string($koneksi,$_POST['username']);
    $password =$_POST['password']; 

    $result = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$username'");
    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        if ($password == $row['password']) {$_SESSION['status_login'] = true;
            $_SESSION['username']     =$row['username'];
            $_SESSION['nama_lengkap'] =$row['nama_lengkap'];
            
            header("Location: index.php"); 
            exit;
        }
    }
    $error = 'Username atau Password salah!';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PPDB Roudlotussolihin</title>
    <link rel="icon"
          type="image/png"
          href="../assets/images/ypp.png">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Animasi transisi background */
        .fade-in-out {
            transition: opacity 1.5s ease-in-out;
        }
    </style>
</head>
<body class="relative min-h-screen flex items-center justify-center overflow-hidden antialiased bg-gray-900">

    <!-- Background Slider Container -->
    <div id="bg-slider" class="absolute inset-0 z-0">
        <!-- Gambar akan dimuat via JavaScript -->
    </div>

    <!-- Overlay Gelap agar form tetap kontras & terbaca -->
    <div class="absolute inset-0 bg-black/60 z-10 backdrop-blur-[2px]"></div>

    <!-- Container Form Login (Glassmorphism Effect) -->
    <div class="relative z-20 w-full max-w-md mx-4 sm:mx-auto bg-white/10 backdrop-blur-md p-8 sm:p-10 rounded-3xl shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] border border-white/20">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-wide drop-shadow-md">Panel Admin</h1>
            <p class="text-sm text-gray-200 mt-2 font-light">PPDB Pondok Pesantren Roudlotussolihin</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-rose-500/20 border border-rose-500/50 text-white backdrop-blur-sm p-3 rounded-xl text-sm mb-6 text-center font-semibold shadow-sm">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-100 mb-2">Username</label>
                <input type="text" name="username" required placeholder="Masukkan username"
                    class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 rounded-xl px-4 py-3.5 focus:outline-none focus:border-emerald-400 focus:ring-1 focus:ring-emerald-400 focus:bg-white/20 transition-all text-sm">
            </div>
            
            <!-- Bagian Input Password dengan Tombol Show/Hide -->
            <div>
                <label class="block text-sm font-medium text-gray-100 mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="••••••••"
                        class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 rounded-xl px-4 py-3.5 pr-12 focus:outline-none focus:border-emerald-400 focus:ring-1 focus:ring-emerald-400 focus:bg-white/20 transition-all text-sm">
                    <button type="button" onclick="togglePassword()" 
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-300 hover:text-white focus:outline-none transition-colors">
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
                class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3.5 rounded-xl transition-all duration-300 shadow-[0_4px_14px_0_rgba(5,150,105,0.39)] hover:shadow-[0_6px_20px_rgba(5,150,105,0.23)] hover:-translate-y-0.5 mt-2">
                Masuk Dashboard
            </button>
        </form>
        
        <div class="mt-8 text-center text-xs text-gray-300">
            &copy; <?= date('Y'); ?> PPDB Pondok Pesantren Roudlotussolihin
        </div>
    </div>

    <!-- Skrip JavaScript -->
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
            '../assets/images/hero1.jpeg', // Nuansa pendidikan/arsitektur klasik
            '../assets/images/hero2.jpeg', // Buku dan perpustakaan
            '../assets/images/hero3.jpeg',  // Lingkungan belajar
            '../assets/images/hero4.jpeg'
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
        }, 6000); 
    </script>
</body>
</html>