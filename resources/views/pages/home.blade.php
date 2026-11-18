@extends('layouts.app')

@section('title', 'Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/custom-slider-popup.css') }}">
@endpush

@section('content')
<!-- POPUP INFORMASI AWAL -->
<!-- POPUP INFORMASI AWAL -->
<div class="popup-overlay" id="infoPopup">
    <div class="popup-content">
        <button class="popup-close" id="closePopup">&times;</button>
        
        <!-- Slider Pop-up (Rasio 4:5) -->
        <div class="popup-image-slider">
            <div class="popup-slides" id="popupSlides">
                <img src="{{ asset('assets/images/dkv4.jpeg') }}" alt="Informasi 1">
                <img src="{{ asset('assets/images/dkv2.jpeg') }}" alt="Informasi 2">
                <img src="{{ asset('assets/images/dkv3.jpeg') }}" alt="Informasi 3">
            </div>
            
            <!-- Tombol Panah Pop-up -->
            <button class="slider-arrow prev-arrow" id="popupPrev"><i class="fas fa-chevron-left"></i></button>
            <button class="slider-arrow next-arrow" id="popupNext"><i class="fas fa-chevron-right"></i></button>
            
            <!-- Titik-titik Navigasi Pop-up -->
            <div class="slider-dots" id="popupDots"></div>
        </div>

        <div class="popup-body">
            <h3>Pengumuman Penting Yayasan</h3>
            <p>Selamat datang di website resmi Yayasan Pendidikan Pondok Pesantren Roudlotussolihin.</p>
            <a href="{{ url('pengumuman') }}" class="popup-btn">Selengkapnya</a>
        </div>
    </div>
</div>


<!-- HERO -->
<section class="hero">
    <div class="overlay"></div>
    <div class="hero-content">
        <h1>Mencetak Generasi Unggul dan Berkarakter</h1>
        <p>Pendidikan Modern Berbasis Teknologi, Karakter dan Kompetensi Masa Depan.</p>
        <a href="{{ url('informasi') }}" class="btn">Daftar Sekarang!</a>
    </div>
</section>

<!-- TENTANG YAYASAN -->
<section class="tentang-yayasan">
    <div class="container">
        <div class= "tentang-header" data-aos="fade-up">
            <span class="section-badge">TENTANG YAYASAN</span>
            <h2>Membangun Generasi Islami, Berprestasi dan Berkarakter</h2>
            <p>Yayasan Pendidikan Pondok Pesantren Roudlotussolihin merupakan lembaga pendidikan yang berkomitmen mencetak generasi beriman, berilmu, berakhlakul karimah serta mampu bersaing di era global.</p>
        </div>
        <div class="tentang-wrapper">
            <div class="tentang-image" data-aos="fade-right">
                <img src="{{ asset('assets/images/hero5.jpeg') }}" alt="Tentang Yayasan">
            </div>
            <div class="tentang-content" data-aos="fade-left">
                <span class="mini-title">Sejak Tahun 1989</span>
                <h3>Pendidikan Berkualitas Untuk Masa Depan Bangsa</h3>
                <p>Berawal dari sebuah cita-cita luhur untuk menghadirkan pendidikan yang berkualitas, Yayasan Pendidikan Pondok Pesantren Roudlotussolihin terus berkembang menjadi lembaga pendidikan yang menaungi berbagai jenjang formal maupun non formal.</p>
                <p>Dengan mengedepankan nilai-nilai Islam, karakter, teknologi dan inovasi, yayasan berkomitmen memberikan pelayanan pendidikan terbaik bagi masyarakat.</p>
                <div class="tentang-list">
                    <div class="list-item"><i class="fas fa-check-circle"></i> Pendidikan Berbasis Karakter</div>
                    <div class="list-item"><i class="fas fa-check-circle"></i> Kurikulum Modern & Islami</div>
                    <div class="list-item"><i class="fas fa-check-circle"></i> Guru Profesional</div>
                    <div class="list-item"><i class="fas fa-check-circle"></i> Fasilitas Lengkap</div>
                </div>
                <a href="#" class="btn">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<!-- PENDIRI YAYASAN -->
<section class="pendiri-section">
    <div class="container">
        <div class="pendiri-header" data-aos="fade-up">
            <span class="section-badge">PENDIRI YAYASAN</span>
            <h2>Sosok Inspiratif Dibalik Berdirinya Yayasan Pendidikan</h2>
            <p>Perjalanan panjang yang dilandasi keikhlasan, perjuangan dan pengabdian dalam membangun generasi Islami.</p>
        </div>
        <div class="pendiri-wrapper">
            <div class="pendiri-image" data-aos="fade-right">
                <img src="{{ asset('assets/images/mbahyai01.png') }}" alt="Pendiri Yayasan">
                
            </div>
            <div class="pendiri-content" data-aos="fade-left">
                <span class="jabatan">Pendiri Yayasan</span>
                <h3>KH.RM. Soleh Bajuri, S.Hi, M.Hi.</h3>
                <p>Beliau merupakan sosok yang memiliki cita-cita besar dalam membangun pendidikan Islam yang berkualitas, berakhlakul karimah, serta mampu melahirkan generasi penerus bangsa yang unggul.</p>
                <p>Dengan semangat keikhlasan, dedikasi dan pengabdian kepada masyarakat, beliau mendirikan Yayasan Pendidikan Pondok Pesantren Roudlotussolihin sebagai wadah pendidikan yang memadukan ilmu agama, ilmu umum serta pembentukan karakter.</p>
                <blockquote>"Pendidikan bukan hanya tentang memberikan ilmu, tetapi juga membentuk akhlak dan masa depan."</blockquote>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi -->
<section class="visi-misi">
    <h2>Visi & Misi</h2>
    <div class="container-visi">
        <div class="card">
            <h3>Visi</h3>
            <p>Mengawal dan mencetak generasi bangsa yang beriman, berakhlakul karimah, cerdas dan berbudaya.</p>
        </div>
        <div class="card">
            <h3>Misi</h3>
            <ul>
                <li>Melahirkan generasi penerus yang beriman dan berkualitas</li>
                <li>Mewujudkan keunggulan dalam pengembangan keislaman</li>
                <li>Meningkatkan sumberdaya pendidik dan kependidikan yang professional</li>
                <li>Mewujudkan proses belajar mengajar yang berbasis keagamaan berkemajuan</li>
                <li>Mewujudkan lingkungan pendidikan yang kreatif, edukatif, religious dan akuntabel</li>
                <li>Mengembangkan seni budaya yang relevan dengan ciri khas pesantren menuju kebudayaan local, nasional dan internasional</li>
            </ul>
        </div>
    </div>
</section>

<!-- Foto Gedung -->
<section class="gedung">
    <div class="section-title">
        <h2>Lembaga Pendidikan</h2>
        <p>Daftar lembaga pendidikan formal dan non-formal yang bernaung di bawah yayasan, berdedikasi mencetak generasi berprestasi dan berakhlak mulia.</p>
    </div>
    <div class="gedung-grid">
        <div class="gedung-card">
            <img src="{{ asset('assets/images/pprs.jpg') }}" alt="RA Al-Qur'an Roudlotussolihin">
            <div class="card-content">
                <h3>RA Al-Qur'an Roudlotussolihin</h3>
                <p>Pendidikan anak usia dini yang berfokus pada pengenalan dasar-dasar agama Islam dan Al-Qur'an dalam suasana belajar yang menyenangkan.</p>
                <a href="{{ url('akademik/formal/ra-alquran') }}" class="btn-card">Selengkapnya</a>
            </div>
        </div>
        <div class="gedung-card">
            <img src="{{ asset('assets/images/pprm.jpg') }}" alt="MI Ma'arif Bumirestu">
            <div class="card-content">
                <h3>MI Ma'arif Bumirestu</h3>
                <p>Lembaga pendidikan tingkat dasar yang memadukan kurikulum pendidikan nasional dengan pendidikan karakter Islami yang kuat.</p>
                <a href="{{ url('akademik/formal/mi-maarif') }}" class="btn-card">Selengkapnya</a>
            </div>
        </div>
        <div class="gedung-card">
            <img src="{{ asset('assets/images/pprm.jpg') }}" alt="MTs Ma'arif Bumirestu">
            <div class="card-content">
                <h3>MTs Ma'arif Bumirestu</h3>
                <p>Pendidikan tingkat menengah pertama yang mempersiapkan generasi berprestasi dengan wawasan ilmu pengetahuan dan agama yang seimbang.</p>
                <a href="{{ url('akademik/formal/mts-maarif') }}" class="btn-card">Selengkapnya</a>
            </div>
        </div>
        <div class="gedung-card">
            <img src="{{ asset('assets/images/pprs.jpg') }}" alt="SMA Ma'arif Bumirestu">
            <div class="card-content">
                <h3>SMA Ma'arif Bumirestu</h3>
                <p>Lembaga pendidikan tingkat menengah atas yang berdedikasi mencetak lulusan kompeten, mandiri, dan siap menghadapi tantangan masa depan.</p>
                <a href="{{ url('akademik/formal/sma-maarif') }}" class="btn-card">Selengkapnya</a>
            </div>
        </div>
        <div class="gedung-card">
            <img src="{{ asset('assets/images/pprs.jpg') }}" alt="MUS Roudlotussolihin">
            <div class="card-content">
                <h3>MUS Roudlotussolihin</h3>
                <p>Program pendidikan keagamaan non-formal yang berfokus pada pendalaman ilmu agama (Diniyah) dan pembentukan karakter santri.</p>
                <a href="{{ url('akademik/non-formal/mus-rs') }}" class="btn-card">Selengkapnya</a>
            </div>
        </div>
        <div class="gedung-card">
            <img src="{{ asset('assets/images/pprs.jpg') }}" alt="MUS Roudlotussolihin Tahfidz">
            <div class="card-content">
                <h3>MUS Roudlotussolihin Tahfidz</h3>
                <p>Lembaga khusus untuk program menghafal Al-Qur'an dengan metode intensif dan pembinaan karakter qur'ani bagi para santri.</p>
                <a href="{{ url('akademik/non-formal/mus-rs-tahfidz') }}" class="btn-card">Selengkapnya</a>
            </div>
        </div>
         <div class="gedung-card">
            <img src="{{ asset('assets/images/pprm.jpg') }}" alt="MUS Roudlotul Muttaqin">
            <div class="card-content">
                <h3>MUS Roudlotul Muttaqin</h3>
                <p>Pusat pendidikan diniyah yang membekali santri dengan pemahaman aqidah, syariah, dan akhlak yang komprehensif.</p>
                <a href="{{ url('akademik/non-formal/mus-rm') }}" class="btn-card">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<!-- Informasi -->
<section class="informasi">
    <h2>Informasi Pendidikan</h2>
    <p>Lembaga pendidikan kami memiliki fasilitas lengkap, tenaga pendidik profesional, kurikulum modern dan lingkungan belajar yang nyaman untuk mendukung keberhasilan peserta didik.</p>
</section>

<!-- BERITA & ARTIKEL (Auto-Slide / Bergeser Otomatis & Pause on Hover) -->
<section class="berita" id="berita">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span>Informasi Terkini</span>
            <h2>Berita & Artikel</h2>
            <p>Dapatkan informasi terbaru mengenai kegiatan, prestasi, dan pengumuman dari sekolah kami.</p>
        </div>
    </div>

    <!-- Container Slider Berita -->
    <div class="berita-slider-wrapper">
        <div class="berita-slider-container" id="beritaContainer">
            <div class="berita-grid-slider" id="beritaTrack">
                
                <!-- Card 1 -->
                <article class="berita-card">
                    <div class="berita-image">
                        <img src="{{ asset('assets/images/mbahyai02.png') }}" alt="Prestasi Siswa">
                    </div>
                    <div class="berita-content">
                        <div class="berita-meta">
                            <span class="kategori">Kisah Inspiratif</span>
                            <span class="tanggal">10 September 2026</span>
                        </div>
                        <h3>Mengenal Lebih Dekat Teladan KH. RM. Soleh Bajuri, S.Hi., M.Hi.</h3>
                        <p>Di balik berkembang pesatnya Yayasan Pendidikan Pondok Pesantren....</p>
                        <a href="https://musroudlotussolihin.web.id/portal_berita/artikel.php?slug=lentera-kedisiplinan-dan-keistiqomahan-mengenal-lebih-dekat-teladan-kh-rm-soleh-bajuri-s-hi-m-hi--1789060742" class="berita-link">Baca Selengkapnya →</a>
                    </div>
                </article>

                <!-- Card 2 -->
                <article class="berita-card">
                    <div class="berita-image">
                        <img src="{{ asset('assets/images/6pilarsantri.jpeg') }}" alt="Class Meeting">
                    </div>
                    <div class="berita-content">
                        <div class="berita-meta">
                            <span class="kategori">Artikel</span>
                            <span class="tanggal">10 September 2026</span>
                        </div>
                        <h3>6 Karakter Utama Santri YPPP Roudlotussolihin</h3>
                        <p>Berdasarkan arahan dari KH. RM. Soleh Bajuri, S.Hi, M.Hi. (Pendiri dan Pembina YPPP Roudlotussolihin.....</p>
                        <a href="https://musroudlotussolihin.web.id/portal_berita/artikel.php?slug=6-karakter-utama-santri-yppp-roudlotussolihin-1789060522" class="berita-link">Baca Selengkapnya →</a>
                    </div>
                </article>

                <!-- Card 3 -->
                <article class="berita-card">
                    <div class="berita-image">
                        <img src="{{ asset('assets/images/hero4.jpeg') }}" alt="Pelepasan Siswa">
                    </div>
                    <div class="berita-content">
                        <div class="berita-meta">
                            <span class="kategori">Dawuh Masyayikh</span>
                            <span class="tanggal">10 September 2026</span>
                        </div>
                        <h3>Filosofi "AKIK" Bekti Santri Menghadapi Zaman</h3>
                        <p>Sebagai Pendiri dan Pengasuh Pondok Pesantren Roudlotussolihin, KH. RM. Soleh Bajuri, S.Hi, M.Hi., merumuskan sebuah filosofi.....</p>
                        <a href="https://musroudlotussolihin.web.id/portal_berita/artikel.php?slug=filosofi-akik-bekti-santri-menghadapi-zaman-1789056512" class="berita-link">Baca Selengkapnya →</a>
                    </div>
                </article>

                <!-- Card 4 -->
                <article class="berita-card">
                    <div class="berita-image">
                        <img src="{{ asset('assets/images/pesantren1.jpeg') }}" alt="Pelepasan Siswa 2">
                    </div>
                    <div class="berita-content">
                        <div class="berita-meta">
                            <span class="kategori">Artikel</span>
                            <span class="tanggal">15 September 2026</span>
                        </div>
                        <h3>Pesantren Saat Ini, Di Antara Persimpangan Modernitas dan Gaya Hidup</h3>
                        <p>Pesantren merupakan salah satu lembaga pendidikan Islam yang memiliki sejarah panjang dalam membentuk karakter....</p>
                        <a href="https://musroudlotussolihin.web.id/portal_berita/artikel.php?slug=pesantren-saat-ini-di-antara-persimpangan-modernitas-dan-gaya-hidup-1789476223" class="berita-link">Baca Selengkapnya →</a>
                    </div>
                </article>
                
                 <!-- Card 5 -->
                <article class="berita-card">
                    <div class="berita-image">
                        <img src="{{ asset('assets/images/haulke1.jpeg') }}" alt="Pelepasan Siswa 2">
                    </div>
                    <div class="berita-content">
                        <div class="berita-meta">
                            <span class="kategori">Berita</span>
                            <span class="tanggal">22 September 2026</span>
                        </div>
                        <h3>Haul Akbar Syekh Abdul Qodir Al-Jaelani & Khataman Tafsir Syekh Nawawi Banten Berlangsung Sukses</h3>
                        <p>Yayasan Pendidikan Pondok Pesantren Roudlotussolihin sukses menyelenggarakan Haul Akbar Syekh Abdul Qodir Al-Jaelani....</p>
                        <a href="https://musroudlotussolihin.web.id/portal_berita/artikel.php?slug=haul-akbar-syekh-abdul-qodir-al-jaelani-khataman-tafsir-syekh-nawawi-banten-berlangsung-sukses-1790100375" class="berita-link">Baca Selengkapnya →</a>
                    </div>
                </article>

            </div>
        </div>
        
        <!-- Tombol Panah Berita -->
        <button class="slider-arrow prev-arrow berita-arrow" id="beritaPrev"><i class="fas fa-chevron-left"></i></button>
        <button class="slider-arrow next-arrow berita-arrow" id="beritaNext"><i class="fas fa-chevron-right"></i></button>
    </div>

    <!-- Titik-titik Navigasi Berita -->
    <div class="slider-dots berita-dots" id="beritaDots"></div>

    <div class="container">
        <div class="berita-footer" data-aos="fade-up">
            <a href="{{ url('portal_berita/') }}" class="btn-semua-berita">Lihat Semua Berita</a>
        </div>
    </div>
</section>


<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
    

    <!-- Script Tambahan untuk Pop-up & Slider Gambar -->
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom-popup.js') }}"></script>
@endpush
