<?php
session_start();
require '../config.php';

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =$_POST['username'];
    $password =$_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;

    // Mengambil data admin dari database
    $stmt =$conn->prepare("SELECT id, username, password FROM `iktsaro-admin-tb` WHERE username = ?");
    $stmt->bind_param("s", $username);$stmt->execute();
    $result =$stmt->get_result();
    
    if ($row =$result->fetch_assoc()) {
        // Cek password secara langsung (Teks Biasa)
        if ($password ===$row['password']) {
            
            // Logika Remember Me (Menyimpan cookie selama 30 hari)
            if ($remember) {
                setcookie('rmb_user', $username, time() + (86400 * 30), "/");
                setcookie('rmb_pass', $password, time() + (86400 * 30), "/");
            } else {
                setcookie('rmb_user', '', time() - 3600, "/");
                setcookie('rmb_pass', '', time() - 3600, "/");
            }

            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] =$row['id'];
            $_SESSION['admin_username'] =$row['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}

// Mengambil data dari cookie jika Remember Me pernah dicentang
$saved_user = isset($_COOKIE['rmb_user']) ? $_COOKIE['rmb_user'] : '';$saved_pass = isset($_COOKIE['rmb_pass']) ?$_COOKIE['rmb_pass'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin - IKTSARO</title>
    <link rel="icon" type="image/png" href="../../../../assets/images/ypp.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0;
            overflow: hidden;
        }
        
        /* CSS Animasi Background Slideshow */
        .slideshow {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            list-style: none;
            margin: 0;
            padding: 0;
            background: #000;
        }
        .slideshow li {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0;
            /* Ubah durasi total jadi 24s untuk 4 gambar */
            animation: imageAnimation 24s linear infinite 0s;
        }
        
        .slideshow li:nth-child(1) { 
            background-image: url('../../../../assets/images/hero1.jpeg'); 
        }
        .slideshow li:nth-child(2) { 
            background-image: url('../../../../assets/images/hero2.jpeg'); 
            animation-delay: 6s; 
        }
        .slideshow li:nth-child(3) { 
            background-image: url('../../../../assets/images/hero3.jpeg'); 
            animation-delay: 12s; 
        }
        .slideshow li:nth-child(4) { 
            background-image: url('../../../../assets/images/hero4.jpeg'); 
            animation-delay: 18s; 
        }

        /* Logika Fade In & Out Animasi untuk 4 gambar */
        @keyframes imageAnimation {
            0% { opacity: 0; transform: scale(1.05); }
            6% { opacity: 1; transform: scale(1); }
            25% { opacity: 1; transform: scale(1); }
            31% { opacity: 0; transform: scale(1.05); }
            100% { opacity: 0; }
        }

        /* Efek Kaca (Glassmorphism) yang Lebih Transparan */
        .glass-card {
            background: rgba(255, 255, 255, 0.15); /* Lebih transparan */
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        /* Styling kustom untuk input agar menyatu dengan efek kaca */
        .glass-input {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
        }
        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.3);
            border-color: #22c55e;
            outline: none;
        }
    </style>
</head>
<body class="flex h-screen justify-center items-center">

    <!-- Gambar Slideshow Background -->
    <ul class="slideshow">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <!-- Overlay Gelap agar teks form putih tetap terbaca -->
    <div class="fixed inset-0 bg-black/60 z-0"></div>

    <!-- Login Box (Glassmorphism) -->
    <div class="glass-card relative z-10 p-10 rounded-3xl w-full max-w-sm mx-4 transform transition-all duration-300 hover:scale-[1.01]">
        
        <div class="flex justify-center mb-100">
            <img src="../../../images/iktsaro.png" alt="Logo" class="w-15 h-10 object-cover rounded-2xl shadow-lg shadow-green-500/50">
        </div>
        
        <h2 class="text-2xl font-bold mb-1 text-center text-white">Login Admin</h2>
        <p class="text-sm text-gray-300 text-center mb-8">Masuk untuk mengelola kisah inspiratif</p>
        
        <?php if($error): ?>
            <div class="bg-red-500/20 border border-red-400/50 text-red-200 p-3 rounded-xl mb-6 text-sm text-center font-medium backdrop-blur-sm">
                <?= $error ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" class="space-y-5">
            <!-- Input Username -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-1.5 ml-1">Username</label>
                <input type="text" name="username" required autocomplete="off" value="<?= htmlspecialchars($saved_user) ?>"
                       class="glass-input w-full px-4 py-3 rounded-xl transition-all duration-200" 
                       placeholder="Masukkan username">
            </div>
            
            <!-- Input Password & Mata -->
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-1.5 ml-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required value="<?= htmlspecialchars($saved_pass) ?>"
                           class="glass-input w-full px-4 py-3 rounded-xl transition-all duration-200 pr-12" 
                           placeholder="••••••••">
                    
                    <!-- Tombol Mata -->
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-300 hover:text-white focus:outline-none">
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Icon Mata Tertutup (Default) -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Fitur Remember Me -->
            <div class="flex items-center mt-2 ml-1">
                <input type="checkbox" id="remember" name="remember" <?= !empty($saved_user) ? 'checked' : '' ?> class="w-4 h-4 text-green-500 bg-white/20 border-white/30 rounded focus:ring-green-500 cursor-pointer">
                <label for="remember" class="ml-2 text-sm text-gray-300 cursor-pointer select-none">Ingat Saya</label>
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3.5 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-green-500/30 transform hover:-translate-y-0.5 mt-2">
                MASUK DASHBOARD
            </button>
        </form>
    </div>

    <!-- Script JavaScript untuk Toggle Password -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Ubah icon ke Mata Terbuka
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            } else {
                passwordInput.type = 'password';
                // Ubah icon kembali ke Mata Tertutup
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            }
        }
    </script>
</body>
</html>