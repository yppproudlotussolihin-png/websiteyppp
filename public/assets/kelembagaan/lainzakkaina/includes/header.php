<?php
// File: includes/header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAINZAKKAINA - Lembaga Amil Zakat, Infak, dan Sedekah yassirna</title>

    <link rel="icon"
          type="image/png"
          href="../../../assets/images/ypp.png">
    
    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        lzGreen: '#064e3b',   /* Hijau Tua Corporate */
                        lzEmerald: '#10b981', /* Hijau Emerald */
                        lzGold: '#fbbf24',    /* Gold Aksen */
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans flex flex-col min-h-screen">

<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="index.php" class="text-2xl font-serif font-bold text-lzGreen">
                    LAINZAKKAINA<span class="text-lzGold">.</span>
                </a>
            </div>

            <!-- Menu Tengah (Desktop) -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="../../../index.html" class="text-gray-600 hover:text-lzEmerald font-medium transition">Beranda</a>
                <a href="program.php" class="text-gray-600 hover:text-lzEmerald font-medium transition">Program</a>
                <a href="zakat.php" class="text-gray-600 hover:text-lzEmerald font-medium transition">Kalkulator Zakat</a>
                <a href="transparansi.php" class="text-gray-600 hover:text-lzEmerald font-medium transition">Transparansi</a>
                <a href="konfirmasi.php" class="text-gray-600 hover:text-lzEmerald font-medium transition">Konfirmasi</a>
            </div>

            <!-- Tombol Kanan (Desktop) -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="zakat.php" class="border-2 border-lzEmerald text-lzEmerald hover:bg-lzEmerald hover:text-white px-5 py-2 rounded-full font-semibold transition text-sm">
                    Tunaikan Zakat
                </a>
                <a href="program.php" class="bg-lzGold hover:bg-yellow-500 text-lzGreen px-5 py-2 rounded-full font-semibold shadow-md transition text-sm">
                    Donasi Sekarang
                </a>
            </div>

            <!-- Tombol Hamburger (Mobile & Tablet) -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-lzGreen focus:outline-none p-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-4 pt-4 pb-6 space-y-3 shadow-lg">
        <a href="../../../index.html" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-lzEmerald font-medium">Beranda</a>
        <a href="program.php" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-lzEmerald font-medium">Program</a>
        <a href="kalkulator.php" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-lzEmerald font-medium">Kalkulator Zakat</a>
        <a href="transparansi.php" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-lzEmerald font-medium">Transparansi</a>
        <a href="konfirmasi.php" class="block py-2 px-3 rounded-lg text-gray-700 hover:bg-emerald-50 hover:text-lzEmerald font-medium">Konfirmasi Pembayaran</a>
        <div class="pt-3 space-y-2">
            <a href="kalkulator.php" class="block w-full text-center border-2 border-lzEmerald text-lzEmerald font-bold py-2.5 rounded-xl">
                Tunaikan Zakat
            </a>
            <a href="program.php" class="block w-full text-center bg-lzGold text-lzGreen font-bold py-2.5 rounded-xl shadow-sm">
                Donasi Sekarang
            </a>
        </div>
    </div>
</nav>

<!-- Script Toggle Hamburger Mobile -->
<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>

<!-- Main Content Wrapper -->
<main class="flex-grow">