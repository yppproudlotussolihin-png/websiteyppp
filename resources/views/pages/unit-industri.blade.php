@extends('layouts.app')

@section('title', 'GOTTRASH')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/styleunitindustri.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom-slider-popup-industri.css') }}">
@endpush

@section('content')
<!-- HERO -->
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Mewujudkan Pertanian Modern Berbasis Ekonomi Sirkular</h1>
            <p>Mengintegrasikan budidaya maggot, pupuk organik, perikanan, pembibitan, dan pertanian dalam satu ekosistem yang produktif, berkelanjutan, dan bernilai ekonomi.</p>
        </div>
    </section>

    <!-- TENTANG GOTTRASH -->
    <section class="tentang-gottrash">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <span>TENTANG GOTTRASH</span>
                <h2>Pertanian Terpadu Berbasis Lingkungan dan Kemandirian</h2>
                <p>GOTTRASH merupakan Unit Industri Yayasan Pendidikan Pondok Pesantren Roudlotussolihin yang bergerak dalam bidang pertanian, pembibitan, pupuk organik, budidaya ikan, pakan ternak, dan budidaya maggot. Kami mengembangkan sistem pertanian terpadu yang ramah lingkungan, berkelanjutan, serta memberikan manfaat ekonomi bagi masyarakat dan santri.</p>
            </div>
            <div class="tentang-content">
                <div class="tentang-image" data-aos="fade-right">
                    <img src="{{ asset('assets/images/IMG_8888.JPG') }}" alt="Tentang GOTTRASH">
                </div>
                <div class="tentang-text" data-aos="fade-left">
                    <h3>Membangun Ekonomi Hijau untuk Masa Depan</h3>
                    <p>GOTTRASH hadir sebagai solusi pengelolaan sumber daya pertanian dan limbah organik yang terintegrasi. Melalui inovasi budidaya maggot, produksi pupuk organik, pembibitan tanaman, serta budidaya perikanan, kami menciptakan siklus usaha yang berkelanjutan.</p>
                    <p>Selain menghasilkan produk berkualitas, GOTTRASH juga menjadi sarana edukasi, pelatihan, dan pemberdayaan santri serta masyarakat untuk meningkatkan keterampilan dan kemandirian ekonomi.</p>
                </div>
            </div>
            <div class="visi-misi">
                <div class="visi">
                    <h4>Visi</h4>
                    <p>Menjadi pusat pertanian terpadu dan industri hijau yang inovatif, produktif, dan berkelanjutan.</p>
                </div>
                <div class="misi">
                    <h4>Misi</h4>
                    <ul>
                        <li>Mengembangkan pertanian ramah lingkungan.</li>
                        <li>Memproduksi pupuk organik berkualitas.</li>
                        <li>Mengoptimalkan budidaya maggot dan perikanan.</li>
                        <li>Memberdayakan santri dan masyarakat.</li>
                        <li>Menciptakan ekonomi sirkular yang berkelanjutan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- BIDANG USAHA -->
    <section class="bidang-usaha">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>BIDANG USAHA</span>
                <h2>Unit Usaha Unggulan GOTTRASH</h2>
                <p>GOTTRASH mengembangkan berbagai sektor usaha berbasis pertanian terpadu, ekonomi sirkular, dan pemberdayaan masyarakat untuk menciptakan lingkungan yang produktif dan berkelanjutan.</p>
            </div>
            <div class="usaha-grid">
                <div class="usaha-card" data-aos="zoom-in">
                    <i class="fas fa-seedling"></i>
                    <h3>Pertanian</h3>
                    <p>Budidaya tanaman pangan dan hortikultura yang berorientasi pada kualitas dan keberlanjutan.</p>
                </div>
                <div class="usaha-card" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fas fa-leaf"></i>
                    <h3>Pembibitan</h3>
                    <p>Produksi bibit unggul untuk mendukung hasil pertanian yang optimal.</p>
                </div>
                <div class="usaha-card" data-aos="zoom-in" data-aos-delay="200">
                    <i class="fas fa-recycle"></i>
                    <h3>Pupuk Organik</h3>
                    <p>Mengolah limbah organik menjadi pupuk berkualitas yang ramah lingkungan.</p>
                </div>
                <div class="usaha-card" data-aos="zoom-in" data-aos-delay="300">
                    <i class="fas fa-fish"></i>
                    <h3>Budidaya Ikan</h3>
                    <p>Mengembangkan budidaya ikan konsumsi yang sehat dan bernilai ekonomi tinggi.</p>
                </div>
                <div class="usaha-card" data-aos="zoom-in" data-aos-delay="400">
                    <i class="fas fa-drumstick-bite"></i>
                    <h3>Pakan Ternak</h3>
                    <p>Produksi pakan alternatif yang ekonomis, berkualitas dan bernutrisi.</p>
                </div>
                <div class="usaha-card" data-aos="zoom-in" data-aos-delay="500">
                    <i class="fas fa-bug"></i>
                    <h3>Budidaya Maggot</h3>
                    <p>Pemanfaatan limbah organik menjadi sumber protein berkualitas tinggi untuk pakan ternak dan ikan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SISTEM PERTANIAN TERPADU -->
    <section class="sistem-terpadu">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>EKONOMI SIRKULAR</span>
                <h2>Sistem Pertanian Terpadu GOTTRASH</h2>
                <p>Mengubah limbah menjadi manfaat melalui sistem pertanian terpadu yang ramah lingkungan, produktif, dan berkelanjutan.</p>
            </div>
            <div class="flow-container">
                <div class="flow-item" data-aos="zoom-in"><i class="fas fa-recycle"></i><h3>Limbah Organik</h3></div>
                <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                <div class="flow-item" data-aos="zoom-in"><i class="fas fa-bug"></i><h3>Budidaya Maggot</h3></div>
                <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                <div class="flow-item" data-aos="zoom-in"><i class="fas fa-drumstick-bite"></i><h3>Pakan Ternak</h3></div>
                <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                <div class="flow-item" data-aos="zoom-in"><i class="fas fa-fish"></i><h3>Budidaya Ikan</h3></div>
                <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                <div class="flow-item" data-aos="zoom-in"><i class="fas fa-seedling"></i><h3>Pupuk Organik</h3></div>
                <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                <div class="flow-item" data-aos="zoom-in"><i class="fas fa-leaf"></i><h3>Pertanian</h3></div>
                <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
                <div class="flow-item" data-aos="zoom-in"><i class="fas fa-shopping-basket"></i><h3>Hasil Panen</h3></div>
            </div>
        </div>
    </section>

    <!-- PRODUK UNGGULAN (Dibuat Slider Otomatis) -->
    <section class="produk">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>PRODUK UNGGULAN</span>
                <h2>Produk Berkualitas dari GOTTRASH</h2>
                <p>Berbagai produk hasil pertanian terpadu yang ramah lingkungan, berkualitas, dan memiliki nilai ekonomi tinggi.</p>
            </div>

            <div class="berita-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="produkPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="produkNext"><i class="fas fa-chevron-right"></i></button>

                <div class="berita-slider-container" id="produkContainer">
                    <div class="berita-grid-slider" id="produkTrack">
                        <div class="produk-card">
                            <img src="{{ asset('assets/images/bibit-cabai.jpg') }}" alt="Bibit Cabai">
                            <div class="produk-content">
                                <h3>Bibit Cabai</h3>
                                <p>Bibit unggul dengan daya tumbuh tinggi dan sehat.</p>
                                <a href="#" class="produk-btn">Detail Produk</a>
                            </div>
                        </div>

                        <div class="produk-card">
                            <img src="{{ asset('assets/images/pupuk-organik.jpg') }}" alt="Pupuk Organik">
                            <div class="produk-content">
                                <h3>Pupuk Organik</h3>
                                <p>Pupuk ramah lingkungan untuk meningkatkan kesuburan tanah.</p>
                                <a href="#" class="produk-btn">Detail Produk</a>
                            </div>
                        </div>

                        <div class="produk-card">
                            <img src="{{ asset('assets/images/maggot.jpg') }}" alt="Maggot">
                            <div class="produk-content">
                                <h3>Maggot BSF</h3>
                                <p>Sumber protein alternatif berkualitas tinggi.</p>
                                <a href="#" class="produk-btn">Detail Produk</a>
                            </div>
                        </div>

                        <div class="produk-card">
                            <img src="{{ asset('assets/images/ikan-lele.jpg') }}" alt="Ikan Lele">
                            <div class="produk-content">
                                <h3>Ikan Lele</h3>
                                <p>Hasil budidaya sehat dan siap konsumsi.</p>
                                <a href="#" class="produk-btn">Detail Produk</a>
                            </div>
                        </div>

                        <div class="produk-card">
                            <img src="{{ asset('assets/images/sayuran.jpg') }}" alt="Sayuran">
                            <div class="produk-content">
                                <h3>Sayuran Segar</h3>
                                <p>Dipanen langsung dari lahan pertanian GOTTRASH.</p>
                                <a href="#" class="produk-btn">Detail Produk</a>
                            </div>
                        </div>

                        <div class="produk-card">
                            <img src="{{ asset('assets/images/kasgot.jpg') }}" alt="Kasgot">
                            <div class="produk-content">
                                <h3>Kasgot</h3>
                                <p>Pupuk organik hasil budidaya maggot yang kaya nutrisi.</p>
                                <a href="#" class="produk-btn">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="berita-dots" id="produkDots"></div>
            </div>
        </div>
    </section>

    <!-- GALERI KEGIATAN -->
    <section class="galeri">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>GALERI KEGIATAN</span>
                <h2>Aktivitas dan Dokumentasi GOTTRASH</h2>
                <p>Dokumentasi berbagai kegiatan budidaya, pertanian, pengolahan pupuk, pembibitan, dan pemberdayaan masyarakat.</p>
            </div>
            <div class="galeri-grid">
                <div class="galeri-item besar"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Budidaya Maggot"></div>
                <div class="galeri-item"><img src="{{ asset('assets/images/IMG_8889.JPG') }}" alt="Pupuk Organik"></div>
                <div class="galeri-item"><img src="{{ asset('assets/images/IMG_8892.JPG') }}" alt="Budidaya Ikan"></div>
                <div class="galeri-item"><img src="{{ asset('assets/images/IMG_8895.JPG') }}" alt="Pertanian"></div>
                <div class="galeri-item"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Panen Sayuran"></div>
                <div class="galeri-item"><img src="{{ asset('assets/images/IMG_8892.JPG') }}" alt="Pembibitan"></div>
            </div>
        </div>
    </section>

    <!-- DAMPAK & STATISTIK -->
    <section class="statistik">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>DAMPAK & PENCAPAIAN</span>
                <h2>Kontribusi Nyata GOTTRASH</h2>
                <p>Berbagai pencapaian yang telah dihasilkan melalui program pertanian terpadu, budidaya maggot, perikanan, dan pemberdayaan masyarakat.</p>
            </div>
            <div class="statistik-grid">
                <div class="stat-card" data-aos="zoom-in"><i class="fas fa-seedling"></i><h3>10.000+</h3><p>Bibit Diproduksi</p></div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="100"><i class="fas fa-recycle"></i><h3>5 Ton</h3><p>Pupuk Organik</p></div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="200"><i class="fas fa-bug"></i><h3>2.000 Kg</h3><p>Maggot BSF</p></div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="300"><i class="fas fa-fish"></i><h3>3.500 Kg</h3><p>Produksi Ikan</p></div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="400"><i class="fas fa-users"></i><h3>150+</h3><p>Penerima Manfaat</p></div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="500"><i class="fas fa-handshake"></i><h3>25+</h3><p>Mitra Kerjasama</p></div>
            </div>
        </div>
    </section>

    <!-- MITRA KERJASAMA -->
    <section class="mitra">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>MITRA & KERJASAMA</span>
                <h2>Bersama Membangun Pertanian Berkelanjutan</h2>
                <p>GOTTRASH berkolaborasi dengan berbagai pihak dalam pengembangan pertanian terpadu, pemberdayaan masyarakat, serta pengelolaan lingkungan yang berkelanjutan.</p>
            </div>
            <div class="mitra-grid">
                <div class="mitra-card" data-aos="zoom-in"><i class="fas fa-school"></i><h3>Yayasan Pendidikan</h3></div>
                <div class="mitra-card" data-aos="zoom-in" data-aos-delay="100"><i class="fas fa-seedling"></i><h3>Kelompok Tani</h3></div>
                <div class="mitra-card" data-aos="zoom-in" data-aos-delay="200"><i class="fas fa-building"></i><h3>Pemerintah Desa</h3></div>
                <div class="mitra-card" data-aos="zoom-in" data-aos-delay="300"><i class="fas fa-graduation-cap"></i><h3>Lembaga Pendidikan</h3></div>
                <div class="mitra-card" data-aos="zoom-in" data-aos-delay="400"><i class="fas fa-mosque"></i><h3>Pondok Pesantren</h3></div>
                <div class="mitra-card" data-aos="zoom-in" data-aos-delay="500"><i class="fas fa-store"></i><h3>UMKM & Komunitas</h3></div>
            </div>
        </div>
    </section>

    <!-- BERITA & ARTIKEL (Slider Otomatis) -->
    <section class="berita">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span>BERITA & ARTIKEL</span>
                <h2>Informasi dan Kegiatan Terbaru GOTTRASH</h2>
                <p>Ikuti perkembangan program, budidaya, pelatihan, serta kegiatan pertanian terpadu yang dilaksanakan oleh GOTTRASH.</p>
            </div>

            <div class="berita-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="beritaPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="beritaNext"><i class="fas fa-chevron-right"></i></button>

                <div class="berita-slider-container" id="beritaContainer">
                    <div class="berita-grid-slider" id="beritaTrack">
                        <!-- Artikel 1 -->
                        <div class="berita-card">
                            <img src="{{ asset('assets/images/artikel1.jpg') }}" alt="Artikel">
                            <div class="berita-content">
                                <span class="tanggal">15 Juni 2026</span>
                                <h3>Pelatihan Budidaya Maggot bagi Santri</h3>
                                <p>Program pelatihan budidaya maggot untuk meningkatkan keterampilan dan kemandirian santri.</p>
                                <a href="#">Baca Selengkapnya →</a>
                            </div>
                        </div>

                        <!-- Artikel 2 -->
                        <div class="berita-card">
                            <img src="{{ asset('assets/images/artikel2.jpg') }}" alt="Artikel">
                            <div class="berita-content">
                                <span class="tanggal">12 Juni 2026</span>
                                <h3>Panen Sayuran Organik Perdana</h3>
                                <p>Hasil panen sayuran organik sebagai bentuk keberhasilan program pertanian terpadu.</p>
                                <a href="#">Baca Selengkapnya →</a>
                            </div>
                        </div>

                        <!-- Artikel 3 -->
                        <div class="berita-card">
                            <img src="{{ asset('assets/images/artikel3.jpg') }}" alt="Artikel">
                            <div class="berita-content">
                                <span class="tanggal">08 Juni 2026</span>
                                <h3>Produksi Pupuk Organik dari Limbah Organik</h3>
                                <p>Pemanfaatan limbah organik menjadi pupuk berkualitas yang ramah lingkungan.</p>
                                <a href="#">Baca Selengkapnya →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="berita-dots" id="beritaDots"></div>
            </div>

            <div class="berita-btn">
                <a href="{{ url('portal_berita/') }}" class="btn-semua-berita">Lihat Semua Artikel</a>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Mari Bersama Membangun Pertanian Berkelanjutan</h2>
                <p>Terbuka untuk kerjasama, pelatihan, kunjungan edukasi, pembelian produk, dan pengembangan program pertanian terpadu.</p>
                <div class="cta-buttons">
                    <a href="https://wa.me/6282180048861" class="btn-cta">Hubungi Kami</a>
                    <a href="https://wa.me/6282180048861" class="btn-cta-outline">Kerjasama</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Script JS -->
@endsection

@push('scripts')
<script>AOS.init();</script>
<script src="{{ asset('assets/js/scriptunitindustri.js') }}"></script>
<script src="{{ asset('assets/js/custom-popup-industri.js') }}"></script>
@endpush
