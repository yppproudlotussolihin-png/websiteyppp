@extends('layouts.app')

@section('title', 'MUS Roudlotul Muttaqin')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/stylemusrs.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom-slider-pondok.css') }}">
@endpush

@section('content')
<!-- HERO -->
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Mencetak Generasi Unggul dan Berkarakter</h1>
            <p>Pendidikan Modern Berbasis Teknologi, Karakter dan Kompetensi Masa Depan.</p>
            <a href="{{ url('informasi') }}" class="btn">Daftar Sekarang!</a>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about" id="about">
        <div class="container">
            <div class="section-header reveal reveal-up">
                <span class="section-subtitle">Tentang Pondok</span>
                <h2 class="section-title">Mengenal Lebih Dekat Pondok Pesantren <span>Roudlotussolihin</span></h2>
                <p class="section-description">Pondok Pesantren Roudlotussolihin merupakan lembaga pendidikan Islam yang berkomitmen mencetak generasi berakhlakul karimah, berilmu, bertakwa, serta mampu menghadapi perkembangan zaman melalui pendidikan agama, pendidikan formal, dan pembinaan karakter secara berkesinambungan.</p>
            </div>
            <div class="about-wrapper">
                <div class="about-image reveal reveal-left">
                    <img src="{{ asset('assets/images/about/about.jpg') }}" alt="Pondok Pesantren Roudlotussolihin">
                </div>
                <div class="about-content reveal reveal-right">
                    <h3>Mendidik Generasi Islami, Berilmu dan Berakhlak Mulia</h3>
                    <p>Sejak berdiri, Pondok Pesantren Roudlotussolihin terus berupaya menjadi pusat pendidikan Islam yang tidak hanya mengajarkan ilmu agama, tetapi juga membentuk karakter, kedisiplinan, kepemimpinan, dan kemandirian para santri.</p>
                    <div class="about-features">
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Pendidikan Berbasis Al-Qur'an</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Pembinaan Karakter Islami</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Program Tahfidz & Kitab Kuning</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Lingkungan Belajar Nyaman</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Pembinaan Santri 24 Jam</span></div>
                        <div class="feature-item"><i class="fas fa-check-circle"></i><span>Tenaga Pengajar Berpengalaman</span></div>
                    </div>
                    <a href="{{ url('fasilitas/gedung-musrm') }}" class="about-btn">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- VISI & MISI -->
    <section class="vision-section" id="vision">
        <div class="vision-container">
            <div class="vision-header reveal reveal-up">
                <span class="vision-subtitle">Visi & Misi</span>
                <h2 class="vision-title">Arah dan Tujuan Pendidikan</h2>
                <p class="vision-text">Visi dan misi menjadi landasan dalam membangun pendidikan yang berkualitas serta membentuk generasi muslim yang berakhlakul karimah, berilmu, dan siap menghadapi perkembangan zaman.</p>
            </div>
            <div class="vision-switch reveal reveal-scale">
                <div class="switch-indicator"></div>
                <button class="switch-btn active" data-slide="0">Visi</button>
                <button class="switch-btn" data-slide="1">Misi</button>
            </div>
            <div class="vision-slider reveal reveal-up">
                <div class="vision-track">
                    <div class="vision-item">
                        <i class="fas fa-eye"></i>
                        <h3>Visi</h3>
                        <p>Menjadi Pondok Pesantren yang unggul dalam mencetak generasi Qur'ani, berakhlakul karimah, berprestasi, mandiri, serta mampu memberikan manfaat bagi umat, bangsa, dan agama.</p>
                    </div>
                    <div class="vision-item">
                        <i class="fas fa-bullseye"></i>
                        <h3>Misi</h3>
                        <ul>
                            <li>Menyelenggarakan pendidikan Islam berdasarkan Al-Qur'an dan As-Sunnah.</li>
                            <li>Membentuk karakter santri yang disiplin dan mandiri.</li>
                            <li>Mengembangkan potensi akademik dan non akademik.</li>
                            <li>Menanamkan akhlakul karimah dalam kehidupan sehari-hari.</li>
                            <li>Meningkatkan kualitas sumber daya manusia yang unggul.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MENGAPA MEMILIH KAMI -->
    <section class="why-us" id="why-us">
        <div class="why-container">
            <div class="why-heading reveal reveal-up">
                <span class="why-subtitle">Mengapa Memilih Kami</span>
                <h2 class="why-title">Alasan Mengapa Pondok Pesantren Menjadi Pilihan Terbaik</h2>
                <p class="why-description">Kami menghadirkan lingkungan pendidikan yang tidak hanya berfokus pada ilmu agama, tetapi juga pembentukan karakter, kedisiplinan, serta pengembangan potensi setiap santri.</p>
            </div>
            <div class="why-grid">
                <div class="why-card reveal reveal-scale"><div class="why-icon"><i class="fa-solid fa-book-quran"></i></div><h3>Pendidikan Al-Qur'an</h3><p>Pembelajaran Al-Qur'an, Tahfidz, serta kajian kitab menjadi bagian utama dalam proses pendidikan santri.</p></div>
                <div class="why-card reveal reveal-scale"><div class="why-icon"><i class="fa-solid fa-mosque"></i></div><h3>Lingkungan Islami</h3><p>Suasana pondok yang religius mendukung pembiasaan ibadah, akhlak mulia, dan kehidupan yang disiplin.</p></div>
                <div class="why-card reveal reveal-scale"><div class="why-icon"><i class="fa-solid fa-user-tie"></i></div><h3>Pengajar Berpengalaman</h3><p>Didampingi ustadz dan guru yang kompeten serta memiliki pengalaman dalam mendidik generasi Islami.</p></div>
                <div class="why-card reveal reveal-scale"><div class="why-icon"><i class="fa-solid fa-school"></i></div><h3>Fasilitas Lengkap</h3><p>Ruang belajar, asrama, masjid, perpustakaan, hingga fasilitas pendukung lainnya tersedia dengan baik.</p></div>
                <div class="why-card reveal reveal-scale"><div class="why-icon"><i class="fa-solid fa-award"></i></div><h3>Prestasi Santri</h3><p>Santri aktif mengikuti berbagai kompetisi akademik, keagamaan maupun kegiatan non akademik.</p></div>
                <div class="why-card reveal reveal-scale"><div class="why-icon"><i class="fa-solid fa-user-shield"></i></div><h3>Pembinaan 24 Jam</h3><p>Seluruh aktivitas santri dibimbing secara berkelanjutan untuk membentuk karakter yang mandiri dan bertanggung jawab.</p></div>
            </div>
        </div>
    </section>

    <!-- PROGRAM UNGGULAN (Slider Otomatis) -->
    <section class="program" id="program">
        <div class="program-container">
            <div class="program-heading reveal reveal-up">
                <span class="program-subtitle">Program Unggulan</span>
                <h2 class="program-title">Program Pendidikan Pondok Pesantren</h2>
                <p class="program-description">Berbagai program unggulan disusun untuk membentuk santri yang unggul dalam ilmu agama, akademik, keterampilan, serta karakter Islami.</p>
            </div>

            <div class="mus-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="programPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="programNext"><i class="fas fa-chevron-right"></i></button>

                <div class="mus-slider-container" id="programContainer">
                    <div class="mus-grid-slider" id="programTrack">
                        <article class="program-card">
                            <div class="program-image"><img src="{{ asset('assets/images/program/program-1.jpg') }}" alt="Tahfidz"></div>
                            <div class="program-content">
                                <h3>Tahfidz Al-Qur'an</h3>
                                <p>Program pembinaan hafalan Al-Qur'an dengan metode talaqqi, muraja'ah dan setoran hafalan setiap hari.</p>
                                <a href="#">Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="program-card">
                            <div class="program-image"><img src="{{ asset('assets/images/program/program-2.jpg') }}" alt="Kitab"></div>
                            <div class="program-content">
                                <h3>Kajian Kitab Kuning</h3>
                                <p>Pembelajaran kitab-kitab salaf sebagai dasar pendalaman ilmu agama Islam.</p>
                                <a href="#">Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="program-card">
                            <div class="program-image"><img src="{{ asset('assets/images/program/program-3.jpg') }}" alt="Formal"></div>
                            <div class="program-content">
                                <h3>Pendidikan Formal</h3>
                                <p>Pendidikan formal mulai dari RA, MI, MTs hingga SMA yang terintegrasi dengan pesantren.</p>
                                <a href="#">Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="program-card">
                            <div class="program-image"><img src="{{ asset('assets/images/program/program-4.jpg') }}" alt="Bahasa"></div>
                            <div class="program-content">
                                <h3>Bahasa Arab & Inggris</h3>
                                <p>Program pembiasaan bahasa sebagai bekal komunikasi dan pengembangan wawasan global.</p>
                                <a href="#">Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="program-card">
                            <div class="program-image"><img src="{{ asset('assets/images/program/program-5.jpg') }}" alt="Ekstrakurikuler"></div>
                            <div class="program-content">
                                <h3>Ekstrakurikuler</h3>
                                <p>Mengembangkan bakat santri melalui olahraga, seni Islami, pramuka dan kegiatan lainnya.</p>
                                <a href="#">Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="program-card">
                            <div class="program-image"><img src="{{ asset('assets/images/program/program-6.jpg') }}" alt="Karakter"></div>
                            <div class="program-content">
                                <h3>Pembinaan Karakter</h3>
                                <p>Pembentukan karakter Islami melalui pembiasaan ibadah, disiplin dan kepemimpinan.</p>
                                <a href="#">Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="mus-dots" id="programDots"></div>
            </div>
        </div>
    </section>

    <!-- JADWAL KEGIATAN SANTRI -->
    <section class="schedule" id="schedule">
        <div class="schedule-container">
            <div class="schedule-heading reveal reveal-up">
                <span class="schedule-subtitle">Jadwal Kegiatan</span>
                <h2 class="schedule-title">Jadwal Kegiatan Harian Santri</h2>
                <p class="schedule-description">Seluruh aktivitas santri tersusun secara teratur mulai dari bangun tidur hingga istirahat malam sebagai bagian dari pembentukan karakter Islami yang disiplin.</p>
            </div>
            <div class="timeline">
                <div class="timeline-item left reveal reveal-left"><div class="timeline-content"><span class="timeline-time">03.30 WIB</span><h3>Qiyamul Lail</h3><p>Bangun malam, shalat tahajud dan persiapan ibadah.</p></div></div>
                <div class="timeline-item right reveal reveal-right"><div class="timeline-content"><span class="timeline-time">04.30 WIB</span><h3>Sholat Subuh</h3><p>Sholat berjamaah dilanjutkan dzikir dan doa pagi.</p></div></div>
                <div class="timeline-item left reveal reveal-left"><div class="timeline-content"><span class="timeline-time">05.00 WIB</span><h3>Muraja'ah Al-Qur'an</h3><p>Mengulang hafalan Al-Qur'an bersama pembimbing.</p></div></div>
                <div class="timeline-item right reveal reveal-right"><div class="timeline-content"><span class="timeline-time">06.30 WIB</span><h3>Sarapan</h3><p>Persiapan sebelum mengikuti kegiatan belajar.</p></div></div>
                <div class="timeline-item left reveal reveal-left"><div class="timeline-content"><span class="timeline-time">07.00 WIB</span><h3>Kegiatan Belajar</h3><p>Pembelajaran formal sesuai jenjang pendidikan.</p></div></div>
                <div class="timeline-item right reveal reveal-right"><div class="timeline-content"><span class="timeline-time">12.00 WIB</span><h3>Sholat Dzuhur</h3><p>Sholat berjamaah dan istirahat siang.</p></div></div>
                <div class="timeline-item left reveal reveal-left"><div class="timeline-content"><span class="timeline-time">13.00 WIB</span><h3>Madrasah Diniyah</h3><p>Pendalaman ilmu agama dan kajian kitab.</p></div></div>
                <div class="timeline-item right reveal reveal-right"><div class="timeline-content"><span class="timeline-time">16.00 WIB</span><h3>Ekstrakurikuler</h3><p>Olahraga, seni, pramuka dan kegiatan pengembangan bakat.</p></div></div>
                <div class="timeline-item left reveal reveal-left"><div class="timeline-content"><span class="timeline-time">18.00 WIB</span><h3>Sholat Maghrib</h3><p>Sholat berjamaah dan persiapan mengaji malam.</p></div></div>
                <div class="timeline-item right reveal reveal-right"><div class="timeline-content"><span class="timeline-time">19.00 WIB</span><h3>Mengaji Kitab</h3><p>Kajian kitab kuning bersama ustadz.</p></div></div>
                <div class="timeline-item left reveal reveal-left"><div class="timeline-content"><span class="timeline-time">21.30 WIB</span><h3>Istirahat</h3><p>Waktu istirahat untuk mempersiapkan aktivitas esok hari.</p></div></div>
            </div>
        </div>
    </section>

    <!-- STATISTIK PONDOK -->
    <section class="stats" id="stats">
        <div class="stats-container">
            <div class="stats-heading reveal reveal-up">
                <span class="stats-subtitle">Statistik Pondok</span>
                <h2 class="stats-title">Pondok Pesantren Dalam Angka</h2>
                <p class="stats-description">Selama bertahun-tahun, Pondok Pesantren Roudlotussolihin terus berkembang menjadi lembaga pendidikan Islam yang dipercaya masyarakat dalam mencetak generasi berilmu dan berakhlakul karimah.</p>
            </div>
            <div class="stats-grid">
                <div class="stats-item reveal reveal-scale"><h3 class="counter" data-target="1500" data-suffix="+">0</h3><span>Santri Aktif</span></div>
                <div class="stats-item reveal reveal-scale"><h3 class="counter" data-target="1500" data-suffix="+">0</h3><span>Ustadz & Guru</span></div>
                <div class="stats-item reveal reveal-scale"><h3 class="counter" data-target="1500" data-suffix="+">0</h3><span>Alumni</span></div>
                <div class="stats-item reveal reveal-scale"><h3 class="counter" data-target="1500" data-suffix="+">0</h3><span>Prestasi Santri</span></div>
            </div>
        </div>
    </section>

    <!-- PRESTASI PONDOK (Slider Otomatis - Ditambah menjadi 4 Card) -->
    <section class="achievement" id="achievement">
        <div class="achievement-container">
            <div class="achievement-heading reveal reveal-up">
                <span class="achievement-subtitle">Prestasi Pondok</span>
                <h2 class="achievement-title">Prestasi dan Pencapaian Santri</h2>
                <p class="achievement-description">Berbagai prestasi yang telah diraih menjadi bukti nyata komitmen Pondok Pesantren Roudlotussolihin dalam membina santri yang unggul di bidang akademik maupun non-akademik.</p>
            </div>

            <div class="mus-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="prestasiPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="prestasiNext"><i class="fas fa-chevron-right"></i></button>

                <div class="mus-slider-container" id="prestasiContainer">
                    <div class="mus-grid-slider" id="prestasiTrack">
                        <article class="achievement-card">
                            <div class="achievement-image"><img src="{{ asset('assets/images/prestasi/prestasi-1.jpg') }}" alt="Prestasi"></div>
                            <div class="achievement-content">
                                <h3>Juara 1 MTQ Nasional</h3>
                                <span class="achievement-category">Musabaqah Tilawatil Qur'an</span>
                                <div class="achievement-info"><span>Tingkat Nasional</span><span>2025</span></div>
                                <a href="#" class="achievement-link">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="achievement-card">
                            <div class="achievement-image"><img src="{{ asset('assets/images/prestasi/prestasi-2.jpg') }}" alt="Prestasi"></div>
                            <div class="achievement-content">
                                <h3>Juara Pidato Bahasa Arab</h3>
                                <span class="achievement-category">Lomba Bahasa Arab</span>
                                <div class="achievement-info"><span>Tingkat Provinsi</span><span>2025</span></div>
                                <a href="#" class="achievement-link">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="achievement-card">
                            <div class="achievement-image"><img src="{{ asset('assets/images/prestasi/prestasi-3.jpg') }}" alt="Prestasi"></div>
                            <div class="achievement-content">
                                <h3>Juara Futsal Antar Pesantren</h3>
                                <span class="achievement-category">Olahraga</span>
                                <div class="achievement-info"><span>Tingkat Kabupaten</span><span>2026</span></div>
                                <a href="#" class="achievement-link">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- Card 4 Ditambahkan agar jumlahnya pas 4 -->
                        <article class="achievement-card">
                            <div class="achievement-image"><img src="{{ asset('assets/images/prestasi/prestasi-1.jpg') }}" alt="Prestasi"></div>
                            <div class="achievement-content">
                                <h3>Juara 1 Hafalan 30 Juz</h3>
                                <span class="achievement-category">Tahfidz Quran</span>
                                <div class="achievement-info"><span>Tingkat Nasional</span><span>2026</span></div>
                                <a href="#" class="achievement-link">Lihat Detail <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="mus-dots" id="prestasiDots"></div>
            </div>
        </div>
    </section>

    <!-- GALERI PONDOK -->
    <section class="gallery" id="gallery">
        <div class="gallery-container">
            <div class="gallery-heading reveal reveal-up">
                <span class="gallery-subtitle">Galeri Pondok</span>
                <h2 class="gallery-title">Dokumentasi Kegiatan Santri</h2>
                <p class="gallery-description">Berbagai momen kegiatan santri yang terdokumentasi sebagai bagian dari perjalanan pendidikan, pembinaan karakter, dan kehidupan di lingkungan pondok pesantren.</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item tall reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-1.jpg') }}" alt="Galeri"></div>
                <div class="gallery-item reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-2.jpg') }}" alt="Galeri"></div>
                <div class="gallery-item wide reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-3.jpg') }}" alt="Galeri"></div>
                <div class="gallery-item reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-4.jpg') }}" alt="Galeri"></div>
                <div class="gallery-item reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-5.jpg') }}" alt="Galeri"></div>
                <div class="gallery-item tall reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-6.jpg') }}" alt="Galeri"></div>
                <div class="gallery-item wide reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-7.jpg') }}" alt="Galeri"></div>
                <div class="gallery-item reveal reveal-scale"><img src="{{ asset('assets/images/gallery/gallery-8.jpg') }}" alt="Galeri"></div>
            </div>
            <div class="gallery-button">
                <a href="{{ url('fasilitas/gedung-musrm') }}">Lihat Semua Galeri <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- BERITA & INFORMASI (Slider Otomatis - Ditambah menjadi 4 Card) -->
    <section class="news" id="news">
        <div class="news-container">
            <div class="news-heading reveal reveal-up">
                <span class="news-subtitle">Berita & Informasi</span>
                <h2 class="news-title">Kabar Terbaru Pondok Pesantren</h2>
                <p class="news-description">Ikuti berbagai informasi, kegiatan, prestasi, dan agenda terbaru Pondok Pesantren Roudlotussolihin yang terus diperbarui secara berkala.</p>
            </div>

            <div class="mus-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="beritaPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="beritaNext"><i class="fas fa-chevron-right"></i></button>

                <div class="mus-slider-container" id="beritaContainer">
                    <div class="mus-grid-slider" id="beritaTrack">
                        <article class="news-card">
                            <div class="news-image"><img src="{{ asset('assets/images/news/news-1.jpg') }}" alt="Berita"></div>
                            <div class="news-content">
                                <div class="news-meta"><span>20 Juni 2026</span><span>•</span><span>Informasi</span></div>
                                <h3>Haflah Akhirussanah dan Wisuda Santri Tahun Ajaran 2025/2026 Berlangsung Meriah</h3>
                                <p>Pondok Pesantren Roudlotussolihin kembali menggelar Haflah Akhirussanah sebagai bentuk rasa syukur atas selesainya kegiatan belajar santri.</p>
                                <a href="#">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="news-card">
                            <div class="news-image"><img src="{{ asset('assets/images/news/news-2.jpg') }}" alt="Berita"></div>
                            <div class="news-content">
                                <div class="news-meta"><span>15 Juni 2026</span><span>•</span><span>Prestasi</span></div>
                                <h3>Santri Berhasil Meraih Juara 1 Lomba MTQ Tingkat Nasional</h3>
                                <p>Prestasi membanggakan kembali diraih oleh santri Pondok Pesantren Roudlotussolihin dalam ajang MTQ tingkat nasional.</p>
                                <a href="#">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <article class="news-card">
                            <div class="news-image"><img src="{{ asset('assets/images/news/news-3.jpg') }}" alt="Berita"></div>
                            <div class="news-content">
                                <div class="news-meta"><span>10 Juni 2026</span><span>•</span><span>Pengumuman</span></div>
                                <h3>Penerimaan Peserta Didik Baru Tahun Ajaran 2026/2027 Dibuka</h3>
                                <p>Pendaftaran santri baru telah resmi dibuka untuk seluruh jenjang pendidikan yang berada di bawah Yayasan Pendidikan Roudlotussolihin.</p>
                                <a href="#">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>

                        <!-- Card 4 Ditambahkan agar jumlahnya pas 4 -->
                        <article class="news-card">
                            <div class="news-image"><img src="{{ asset('assets/images/news/news-1.jpg') }}" alt="Berita"></div>
                            <div class="news-content">
                                <div class="news-meta"><span>01 Juni 2026</span><span>•</span><span>Kegiatan</span></div>
                                <p>Kegiatan Pesantren Kilat Ramadan Sukses Digelar</p>
                                <p>Seluruh santri antusias mengikuti rangkaian kegiatan pesantren kilat dalam rangka memperdalam ilmu keislaman.</p>
                                <a href="#">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="mus-dots" id="beritaDots"></div>
            </div>

            <div class="news-button">
                <a href="{{ url('portal_berita/') }}">Lihat Semua Berita <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="kontak-section">
        <div class="kontak-container">
            <div class="kontak-title" data-aos="fade-up">
                <h2>Kontak Kami</h2>
            </div>
            <div class="kontak-grid">
                <div class="kontak-info" data-aos="fade-right">
                    <h3>Informasi Kontak</h3>
                    <p><i class="fas fa-location-dot"></i> Jl. KH. Bysri Mustofa No. 18, Desa Bumirestu, Kec. Palas, Kab. Lampung Selatan</p>
                    <p><i class="fas fa-envelope"></i> yppproudlotussolihin@gmail.com</p>
                    <p><i class="fas fa-phone"></i> 0821-8004-8861</p>
                    <p><i class="fab fa-whatsapp"></i> 0821-8004-8861</p>
                </div>
                <div class="kontak-form">
                    <form action="admin/proses_pesan.php" method="POST">
                        <input type="hidden" name="asal_website" value="MUS Roudlotul Muttaqin">
                        <input type="text" name="nama" placeholder="Nama Lengkap" required>
                        <input type="email" name="email" placeholder="Alamat Email" required>
                        <input type="text" name="whatsapp" placeholder="Nomor WhatsApp" required>
                        <textarea name="pesan" placeholder="Tulis pesan Anda..." required></textarea>
                        <button type="submit" class="kontak-btn">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Scripts -->
@endsection

@push('scripts')
<script>AOS.init();</script>
<script src="{{ asset('assets/js/scriptmusrs.js') }}"></script>
<script src="{{ asset('assets/js/custom-popup-pondok.js') }}"></script>
@endpush
