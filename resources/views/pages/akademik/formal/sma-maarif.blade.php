@extends('layouts.app')

@section('title', 'SMA Ma\'arif Bumirestu')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/styletentang.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom-slider-sekolah.css') }}">
@endpush

@section('content')
<!-- HERO -->
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Mencetak Generasi Unggul dan Berkarakter</h1>
            <p>Pendidikan Menengah Atas Berbasis Teknologi, Karakter dan Kompetensi Masa Depan.</p>
            <a href="{{ url('informasi') }}" class="btn">Daftar Sekarang!</a>
        </div>
    </section>

    <!-- KEPALA SEKOLAH -->
    <section class="kepsek-section">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Kepala Sekolah</h2>
                <p>Pemimpin dan Penggerak Pendidikan</p>
            </div>
            <div class="kepsek-card" data-aos="zoom-in-up">
                <div class="kepsek-image">
                    <img src="{{ asset('assets/images/mbhyai.jpg') }}" alt="Kepala Sekolah">
                    <div class="floating-badge">Kepala Sekolah</div>
                </div>
                <div class="kepsek-content">
                    <span class="jabatan">Kepala Sekolah</span>
                    <h3>Drs. Ahmad Fauzi, M.Pd.</h3>
                    <div class="masa-jabatan">Menjabat sejak Januari 2024</div>
                    <p>Selamat datang di website resmi SMA Ma'arif Bumirestu. Kami berkomitmen untuk menciptakan lingkungan pendidikan tingkat menengah yang unggul, berkarakter, dan berorientasi pada masa depan.</p>
                    <p>Melalui inovasi, teknologi, dan penguatan karakter, kami terus berupaya mempersiapkan peserta didik menuju perguruan tinggi dan dunia kerja.</p>
                    <a href="#" class="btn btn-primary">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- STATISTIK SEKOLAH -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stats-title" data-aos="fade-up">
                <h2>Statistik Sekolah</h2>
                <p>Data dan pencapaian sekolah kami</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card" data-aos="fade-up">
                    <h3 class="counter" data-target="800">0</h3>
                    <p>Siswa Aktif</p>
                </div>
                <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="counter" data-target="75">0</h3>
                    <p>Tenaga Pendidik</p>
                </div>
                <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="counter" data-target="24">0</h3>
                    <p>Ruang Kelas</p>
                </div>
                <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="counter" data-target="200">0</h3>
                    <p>Prestasi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PROFIL SEKOLAH -->
    <section id="profil" class="profil-section">
        <div class="profil-container">
            <div class="profil-title" data-aos="fade-up">
                <h2>Profil Sekolah</h2>
                <p>Mengenal lebih dekat sekolah kami</p>
            </div>

            <!-- CARD 1 -->
            <div class="profile-card" data-aos="fade-right">
                <div class="profile-image">
                    <img src="{{ asset('assets/images/hero4.jpeg') }}" alt="Sejarah Sekolah">
                </div>
                <div class="profile-content">
                    <span class="badge">Sejarah Sekolah</span>
                    <h3>Pendidikan Menengah Berkualitas Untuk Masa Depan</h3>
                    <p>SMA Ma'arif Bumirestu berdiri dengan tujuan menciptakan generasi tingkat atas yang unggul, berkarakter dan mampu bersaing di era globalisasi.</p>
                    <p>Dengan dukungan tenaga pendidik profesional dan fasilitas modern, sekolah terus berkembang menjadi pusat pendidikan menengah yang berkualitas.</p>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="profile-card reverse" data-aos="fade-left">
                <div class="profile-image">
                    <img src="{{ asset('assets/images/IMG_8888.JPG') }}" alt="Visi dan Misi">
                </div>
                <div class="profile-content">
                    <span class="badge">Visi & Misi</span>
                    <h3>Mewujudkan Generasi Berprestasi & Kompeten</h3>
                    <p>Menjadi sekolah menengah unggulan yang menghasilkan lulusan berakhlak mulia, berprestasi dan siap melanjutkan ke jenjang perguruan tinggi.</p>
                    <p>Mengembangkan potensi siswa melalui pendalaman akademik, penguasaan teknologi dan karakter yang kuat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- AKADEMIK -->
    <section id="akademik" class="akademik-section">
        <div class="akademik-container">
            <div class="akademik-title" data-aos="fade-up">
                <h2>Program Akademik</h2>
            </div>
            <div class="akademik-grid">
                <div class="akademik-card" data-aos="fade-up">
                    <h3>IPA</h3>
                    <p>Fokus sains, eksakta, dan teknologi.</p>
                </div>
                <div class="akademik-card" data-aos="fade-up" data-aos-delay="150">
                    <h3>IPS</h3>
                    <p>Fokus sosial, humaniora, dan ekonomi.</p>
                </div>
                <div class="akademik-card" data-aos="fade-up" data-aos-delay="300">
                    <h3>Keagamaan</h3>
                    <p>Fokus pendalaman ilmu agama dan kitab kuning.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- BERITA & ARTIKEL (Slider Otomatis - 4 Card) -->
    <section class="berita" id="berita">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>Informasi Terkini</span>
                <h2>Berita & Artikel</h2>
                <p>Dapatkan informasi terbaru mengenai kegiatan, prestasi, dan pengumuman dari sekolah kami.</p>
            </div>

            <div class="sekolah-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="beritaPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="beritaNext"><i class="fas fa-chevron-right"></i></button>

                <div class="sekolah-slider-container" id="beritaContainer">
                    <div class="sekolah-grid-slider" id="beritaTrack">
                        <!-- Berita 1 -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/berita1.jpg') }}" alt="Prestasi Siswa">
                            </div>
                            <div class="berita-content">
                                <div class="berita-meta">
                                    <span class="kategori">Prestasi</span>
                                    <span class="tanggal">15 Juni 2026</span>
                                </div>
                                <h3>Prestasi Olimpiade Sains Tingkat Provinsi</h3>
                                <p>Siswa SMA Ma'arif Bumirestu berhasil meraih juara dalam ajang kompetisi sains tingkat provinsi.</p>
                                <a href="#" class="berita-link">Baca Selengkapnya →</a>
                            </div>
                        </article>

                        <!-- Berita 2 -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/berita2.jpg') }}" alt="Class Meeting">
                            </div>
                            <div class="berita-content">
                                <div class="berita-meta">
                                    <span class="kategori">Kegiatan</span>
                                    <span class="tanggal">12 Juni 2026</span>
                                </div>
                                <h3>Kegiatan Pentas Seni & Class Meeting</h3>
                                <p>Ajang unjuk bakat, kreativitas, dan sportivitas antar siswa melalui berbagai cabang perlombaan.</p>
                                <a href="#" class="berita-link">Baca Selengkapnya →</a>
                            </div>
                        </article>

                        <!-- Berita 3 -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/berita3.jpg') }}" alt="Pelepasan Siswa">
                            </div>
                            <div class="berita-content">
                                <div class="berita-meta">
                                    <span class="kategori">Sekolah</span>
                                    <span class="tanggal">08 Juni 2026</span>
                                </div>
                                <h3>Wisuda & Pelepasan Siswa Kelas XII</h3>
                                <p>Acara pelepasan siswa kelas akhir berlangsung khidmat menyongsong masa depan perkuliahan.</p>
                                <a href="#" class="berita-link">Baca Selengkapnya →</a>
                            </div>
                        </article>

                        <!-- Berita 4 (Ditambahkan agar jumlahnya pas 4 card) -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/berita1.jpg') }}" alt="Penerimaan Siswa Baru">
                            </div>
                            <div class="berita-content">
                                <div class="berita-meta">
                                    <span class="kategori">Pengumuman</span>
                                    <span class="tanggal">01 Juni 2026</span>
                                </div>
                                <h3>Pendaftaran Peserta Didik Baru Dibuka</h3>
                                <p>Mari bergabung bersama SMA Ma'arif Bumirestu untuk menggapai cita-cita dan masa depan gemilang.</p>
                                <a href="#" class="berita-link">Baca Selengkapnya →</a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="sekolah-dots" id="beritaDots"></div>
            </div>

            <div class="berita-footer" data-aos="fade-up">
                <a href="{{ url('portal_berita/') }}" class="btn-semua-berita">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- FASILITAS -->
    <section id="fasilitas" class="fasilitas-section">
        <div class="fasilitas-container">
            <div class="fasilitas-title" data-aos="fade-up">
                <h2>Fasilitas Sekolah</h2>
            </div>
            <div class="fasilitas-gallery">
                <div class="fasilitas-item" data-aos="zoom-in">
                    <img src="{{ asset('assets/images/IMG_8890.JPG') }}" alt="Fasilitas 1">
                </div>
                <div class="fasilitas-item" data-aos="zoom-in" data-aos-delay="150">
                    <img src="{{ asset('assets/images/IMG_8891.JPG') }}" alt="Fasilitas 2">
                </div>
                <div class="fasilitas-item" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('assets/images/IMG_8895.JPG') }}" alt="Fasilitas 3">
                </div>
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
                        <input type="hidden" name="asal_website" value="SMA Ma'arif Bumirestu">
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
<script src="{{ asset('assets/js/scripttentang.js') }}"></script>
<script src="{{ asset('assets/js/custom-slider-sekolah.js') }}"></script>
@endpush
