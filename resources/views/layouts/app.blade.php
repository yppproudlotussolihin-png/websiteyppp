<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/ypp.png') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Animation AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/neurosains-modern.css') }}">

    @stack('styles')
</head>

<body>

    <!-- LOADER -->
    <div id="loader">
        <div class="loader-container">
            <div class="spinner spinner-blue"></div>
            <div class="spinner spinner-orange"></div>
            <img src="{{ asset('assets/images/ypp.png') }}" alt="Logo Yayasan" class="loader-logo">
        </div>
    </div>

    <!-- HEADER & NAVBAR -->
    <header class="header">
        <nav class="navbar">
            <div class="container navbar-container">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('assets/images/ypp.png') }}" alt="Logo">
                    <div class="logo-text">
                        YPPP Roudlotussolihin
                    </div>
                </a>

                <ul class="menu">
                    <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                    <li class="dropdown">
                        <a href="#" class="{{ request()->is('tentang*') ? 'active' : '' }}">Tentang</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('tentang/sambutan-pendiri') }}">Dawuh Syaikhul Ma'had</a></li>
                            <li><a href="{{ url('tentang/profil-ypprs') }}">Profil YPPPRS</a></li>
                            <li><a href="{{ url('tentang/visi-misi') }}">Visi Misi</a></li>
                            <li><a href="{{ url('tentang/sejarah') }}">Sejarah</a></li>
                            <li><a href="{{ url('tentang/struktur-organisasi') }}">Struktur Organisasi</a></li>
                            <li><a href="{{ url('tentang/sambutan-ketua-yayasan') }}">Sambutan Ketua Yayasan</a></li>
                            <li><a href="{{ url('tentang/logo') }}">Logo YPPPRS</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="{{ request()->is('kelembagaan*') ? 'active' : '' }}">Kelembagaan</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('kelembagaan/iktsaro') }}">IKTSARO</a></li>
                            <li><a href="{{ url('assets/kelembagaan/lainzakkaina/index.php') }}">LAINZAKKAINA</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="{{ request()->is('akademik*') ? 'active' : '' }}">Unit Pendidikan</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-sub">
                                <a href="#">FORMAL ▸</a>
                                <ul class="submenu">
                                    <li><a href="{{ url('akademik/formal/ra-alquran') }}">RA Al-Qur'an Roudlotussolihin</a></li>
                                    <li><a href="{{ url('akademik/formal/mi-maarif') }}">MI Ma'arif Bumirestu</a></li>
                                    <li><a href="{{ url('akademik/formal/mts-maarif') }}">MTs Ma'arif Bumirestu</a></li>
                                    <li><a href="{{ url('akademik/formal/sma-maarif') }}">SMA Ma'arif Bumirestu</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-sub">
                                <a href="#">NON FORMAL ▸</a>
                                <ul class="submenu">
                                    <li><a href="{{ url('akademik/non-formal/mus-rs') }}">MUS Roudlotussolihin</a></li>
                                    <li><a href="{{ url('akademik/non-formal/mus-rs-tahfidz') }}">MUS Roudlotussolihin Tahfidz</a></li>
                                    <li><a href="{{ url('akademik/non-formal/mus-rm') }}">MUS Roudlotul Muttaqin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="{{ request()->is('fasilitas*') ? 'active' : '' }}">Fasilitas</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-sub">
                                <a href="#">Gedung ▸</a>
                                <ul class="submenu">
                                    <li><a href="{{ url('fasilitas/gedung-ra') }}">RA Al-Qur'an Roudlotussolihin</a></li>
                                    <li><a href="{{ url('fasilitas/gedung-mi') }}">MI Ma'arif Bumirestu</a></li>
                                    <li><a href="{{ url('fasilitas/gedung-mts') }}">MTs Ma'arif Bumirestu</a></li>
                                    <li><a href="{{ url('fasilitas/gedung-sma') }}">SMA Ma'arif Bumirestu</a></li>
                                    <li><a href="{{ url('fasilitas/gedung-musrs') }}">MUS Roudlotussolihin</a></li>
                                    <li><a href="{{ url('fasilitas/gedung-musrstahfid') }}">MUS Roudlotussolihin Tahfidz</a></li>
                                    <li><a href="{{ url('fasilitas/gedung-musrm') }}">MUS Roudlotul Muttaqin</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('fasilitas/perpustakaan') }}">Perpustakaan</a></li>
                            <li><a href="{{ url('fasilitas/masjid') }}">Masjid</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('unit-industri') }}" class="{{ request()->is('unit-industri') ? 'active' : '' }}">Unit Industri</a></li>
                    <li class="dropdown">
                        <a href="#" class="{{ request()->is('informasi') || request()->is('pengumuman') ? 'active' : '' }}">Informasi</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('informasi') }}">Pendaftaran (PPDB)</a></li>
                            <li><a href="{{ url('portal_berita/') }}">Berita</a></li>
                            <li><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <!-- Kontak -->
            <div>
                <h3>Kontak</h3>
                <p>
                    <a href="https://wa.me/6282180048861" target="_blank">
                        <i class="fas fa-phone"></i>
                        0821-8004-8861
                    </a>
                </p>
                <p>
                    <a href="mailto:yppproudlotussolihin@gmail.com">
                        <i class="fas fa-envelope"></i>
                        yppproudlotussolihin@gmail.com
                    </a>
                </p>
            </div>

            <!-- Sosial Media -->
            <div>
                <h3>Sosial Media</h3>
                <p><a href="https://www.instagram.com/officialroudlotussolihin" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></p>
                <p><a href="https://web.facebook.com/officialroudlotussolihin" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></p>
                <p><a href="https://youtube.com/@officialroudlotussolihin" target="_blank"><i class="fab fa-youtube"></i> YouTube</a></p>
                <p><a href="https://www.tiktok.com/@officialroudlotussolihin" target="_blank"><i class="fab fa-tiktok"></i> TikTok</a></p>
                <p><a href="https://whatsapp.com/channel/0029VbB3JTW42Dclboyyfl2L" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp Channel</a></p>
            </div>

            <!-- Alamat -->
            <div>
                <h3>Alamat</h3>
                <p>
                    <a href="https://maps.app.goo.gl/Bhe4JENgR1kVb8RE9" target="_blank">
                        <i class="fas fa-location-dot"></i>
                        Jl. KH. Bysri Mustofa No. 18, Desa Bumirestu, Kec. Palas, Kab. Lampung Selatan.
                    </a>
                </p>
            </div>
        </div>

        <div class="copyright">
            © 2026 Yayasan Pendidikan Pondok Pesantren Roudlotussolihin. All Rights Reserved. | Developed by Miftah Fauzi
        </div>
    </footer>

    <!-- Library Scripts -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <!-- Script Utama Bawaan Web -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @stack('scripts')
</body>

</html>

