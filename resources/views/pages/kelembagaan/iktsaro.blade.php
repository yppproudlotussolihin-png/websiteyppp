@extends('layouts.app')

@section('title', 'IKTSARO (Ikatan Santri dan Alumni Roudlotussolihin)')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/styleiktsaro.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom-slider-iktsaro.css') }}">
@endpush

@section('content')
<!-- HERO -->
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>Menjalin Silaturahmi, Menguatkan Ukhuwah, Membangun Masa Depan</h1>
            <p>IKTSARO hadir sebagai wadah santri dan alumni Roudlotussolihin untuk mempererat persaudaraan, berbagi inspirasi, serta berkontribusi bagi kemajuan pesantren dan masyarakat.</p>
        </div>
    </section>

    <!-- TENTANG IKTSARO -->
    <section class="tentang-iktsaro">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Tentang IKTSARO</h2>
                <p>Ikatan Santri dan Alumni Roudlotussolihin</p>
            </div>
            <div class="tentang-content">
                <div class="tentang-text" data-aos="fade-right">
                    <h3>Menjalin Silaturahmi dan Membangun Kolaborasi Alumni</h3>
                    <p>IKTSARO (Ikatan Santri dan Alumni Roudlotussolihin) merupakan wadah yang menghimpun seluruh santri dan alumni Pondok Pesantren Roudlotussolihin untuk mempererat ukhuwah Islamiyah, memperkuat jaringan alumni, serta mendukung berbagai program pendidikan, sosial, dakwah, dan kemasyarakatan.</p>
                    <p>Melalui IKTSARO, alumni dapat terus berkontribusi dalam perkembangan pesantren serta menjadi jembatan komunikasi antara alumni, santri, dan yayasan.</p>
                </div>
                <div class="tentang-image" data-aos="fade-left">
                    <img src="{{ asset('assets/images/IMG_8893.JPG') }}" alt="Tentang IKTSARO">
                </div>
            </div>
            <div class="iktsaro-card-wrapper">
                <div class="iktsaro-card" data-aos="zoom-in">
                    <i class="fas fa-handshake"></i>
                    <h4>Silaturahmi</h4>
                    <p>Mempererat hubungan antar santri dan alumni di berbagai daerah.</p>
                </div>
                <div class="iktsaro-card" data-aos="zoom-in" data-aos-delay="150">
                    <i class="fas fa-graduation-cap"></i>
                    <h4>Pengembangan SDM</h4>
                    <p>Mendukung pendidikan, karier dan pengembangan potensi alumni.</p>
                </div>
                <div class="iktsaro-card" data-aos="zoom-in" data-aos-delay="300">
                    <i class="fas fa-mosque"></i>
                    <h4>Pengabdian</h4>
                    <p>Berpartisipasi aktif dalam kegiatan sosial, dakwah dan kemasyarakatan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KISAH INSPIRATIF ALUMNI (Dibuat Slider Otomatis - 4 Card) -->
    <section class="inspiratif">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Kisah Inspiratif Alumni</h2>
                <p>Perjalanan alumni dalam mengamalkan ilmu dan memberikan manfaat bagi masyarakat.</p>
            </div>

            <div class="iktsaro-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="alumniPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="alumniNext"><i class="fas fa-chevron-right"></i></button>

                <div class="iktsaro-slider-container" id="alumniContainer">
                    <div class="iktsaro-grid-slider" id="alumniTrack">
                        <!-- Alumni 1 -->
                        <div class="alumni-card">
                            <div class="alumni-image">
                                <img src="{{ asset('assets/images/alumni1.jpg') }}" alt="Alumni">
                            </div>
                            <div class="alumni-content">
                                <h3>Ahmad Fauzi</h3>
                                <span>Alumni 2018 • Guru</span>
                                <p>"Ilmu yang saya peroleh di pesantren menjadi bekal utama dalam mendidik generasi muda dan mengabdi kepada masyarakat."</p>
                            </div>
                        </div>

                        <!-- Alumni 2 -->
                        <div class="alumni-card">
                            <div class="alumni-image">
                                <img src="{{ asset('assets/images/alumni2.jpg') }}" alt="Alumni">
                            </div>
                            <div class="alumni-content">
                                <h3>Muhammad Rizki</h3>
                                <span>Alumni 2020 • Wirausaha</span>
                                <p>"Pesantren mengajarkan kemandirian dan kejujuran yang menjadi fondasi dalam membangun usaha."</p>
                            </div>
                        </div>

                        <!-- Alumni 3 -->
                        <div class="alumni-card">
                            <div class="alumni-image">
                                <img src="{{ asset('assets/images/alumni3.jpg') }}" alt="Alumni">
                            </div>
                            <div class="alumni-content">
                                <h3>Abdul Karim</h3>
                                <span>Alumni 2019 • Mahasiswa</span>
                                <p>"Bekal ilmu agama dan pengalaman organisasi selama mondok membantu saya berkembang di dunia kampus."</p>
                            </div>
                        </div>

                        <!-- Alumni 4 (Ditambahkan agar jumlahnya pas 4 card) -->
                        <div class="alumni-card">
                            <div class="alumni-image">
                                <img src="{{ asset('assets/images/alumni1.jpg') }}" alt="Alumni">
                            </div>
                            <div class="alumni-content">
                                <h3>Siti Aminah</h3>
                                <span>Alumni 2021 • Praktisi Kesehatan</span>
                                <p>"Nilai-nilai kepedulian sosial yang ditanamkan di pesantren menginspirasi saya untuk mengabdi di bidang kesehatan."</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="iktsaro-dots" id="alumniDots"></div>
            </div>

            <div class="alumni-button" data-aos="fade-up">
                <a href="{{ url('portal_berita/') }}" class="btn">Lihat Kisah Lainnya</a>
            </div>
        </div>
    </section>

    <!-- BERITA TERBARU (Dibuat Slider Otomatis - 4 Card) -->
    <section class="berita">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Berita Terbaru</h2>
                <p>Informasi, kegiatan, dan perkembangan terbaru dari IKTSARO.</p>
            </div>

            <div class="iktsaro-slider-wrapper" data-aos="fade-up">
                <button class="slider-arrow prev-arrow" id="beritaPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-arrow next-arrow" id="beritaNext"><i class="fas fa-chevron-right"></i></button>

                <div class="iktsaro-slider-container" id="beritaContainer">
                    <div class="iktsaro-grid-slider" id="beritaTrack">
                        <!-- Berita 1 -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Berita">
                            </div>
                            <div class="berita-content">
                                <span><i class="fas fa-calendar"></i> 20 Juni 2026</span>
                                <h3>Reuni Akbar IKTSARO 2026 Berlangsung Meriah</h3>
                                <p>Ratusan alumni dari berbagai daerah hadir untuk mempererat silaturahmi dan memperkuat jaringan alumni.</p>
                                <a href="#">Baca Selengkapnya →</a>
                            </div>
                        </article>

                        <!-- Berita 2 -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Berita">
                            </div>
                            <div class="berita-content">
                                <span><i class="fas fa-calendar"></i> 15 Juni 2026</span>
                                <h3>Alumni Peduli Salurkan Bantuan Sosial</h3>
                                <p>IKTSARO bersama alumni menyalurkan bantuan kepada masyarakat yang membutuhkan di wilayah sekitar pesantren.</p>
                                <a href="#">Baca Selengkapnya →</a>
                            </div>
                        </article>

                        <!-- Berita 3 -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Berita">
                            </div>
                            <div class="berita-content">
                                <span><i class="fas fa-calendar"></i> 10 Juni 2026</span>
                                <h3>Seminar Karier Bersama Alumni Sukses Digelar</h3>
                                <p>Alumni berbagai profesi berbagi pengalaman dan motivasi kepada santri serta alumni muda.</p>
                                <a href="#">Baca Selengkapnya →</a>
                            </div>
                        </article>

                        <!-- Berita 4 (Ditambahkan agar jumlahnya pas 4 card) -->
                        <article class="berita-card">
                            <div class="berita-image">
                                <img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Berita">
                            </div>
                            <div class="berita-content">
                                <span><i class="fas fa-calendar"></i> 01 Juni 2026</span>
                                <h3>Pelantikan Pengurus Baru IKTSARO Periode 2026-2029</h3>
                                <p>Pengurus baru resmi dilantik untuk melanjutkan estafet kepemimpinan dan program kerja organisasi.</p>
                                <a href="#">Baca Selengkapnya →</a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="iktsaro-dots" id="beritaDots"></div>
            </div>

            <div class="berita-button" data-aos="fade-up">
                <a href="{{ url('portal_berita/') }}" class="btn">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- GALERI KEGIATAN -->
    <section class="galeri">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Galeri Kegiatan</h2>
                <p>Dokumentasi kegiatan santri, alumni, dan berbagai program IKTSARO.</p>
            </div>
            <div class="galeri-grid">
                <div class="galeri-item" data-aos="zoom-in"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Galeri"></div>
                <div class="galeri-item" data-aos="zoom-in" data-aos-delay="100"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Galeri"></div>
                <div class="galeri-item" data-aos="zoom-in" data-aos-delay="200"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Galeri"></div>
                <div class="galeri-item" data-aos="zoom-in" data-aos-delay="300"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Galeri"></div>
                <div class="galeri-item" data-aos="zoom-in"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Galeri"></div>
                <div class="galeri-item" data-aos="zoom-in" data-aos-delay="100"><img src="{{ asset('assets/images/IMG_8886.JPG') }}" alt="Galeri"></div>
            </div>
            <div class="galeri-button" data-aos="fade-up">
                <a href="#" class="btn">Lihat Semua Galeri</a>
            </div>
        </div>
    </section>

    <!-- AGENDA & EVENT IKTSARO -->
    <section class="agenda">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Agenda & Event IKTSARO</h2>
                <p>Jadwal kegiatan dan agenda yang akan dilaksanakan bersama santri dan alumni.</p>
            </div>
            <div class="timeline">
                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-date">
                        <span>20</span>
                        <small>Agustus 2026</small>
                    </div>
                    <div class="timeline-content">
                        <h3>Reuni Akbar Alumni</h3>
                        <p>Silaturahmi dan temu kangen alumni dari berbagai angkatan Pondok Pesantren Roudlotussolihin.</p>
                        <div class="event-info">
                            <span><i class="fas fa-location-dot"></i> Aula Utama Pesantren</span>
                        </div>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-left">
                    <div class="timeline-date">
                        <span>12</span>
                        <small>September 2026</small>
                    </div>
                    <div class="timeline-content">
                        <h3>Seminar Karier Alumni</h3>
                        <p>Berbagi pengalaman dan motivasi dari alumni yang sukses di dunia kerja dan usaha.</p>
                        <div class="event-info">
                            <span><i class="fas fa-location-dot"></i> Gedung Serbaguna Yayasan</span>
                        </div>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-date">
                        <span>05</span>
                        <small>Oktober 2026</small>
                    </div>
                    <div class="timeline-content">
                        <h3>Bakti Sosial IKTSARO</h3>
                        <p>Kegiatan sosial dan pengabdian masyarakat bersama santri dan alumni.</p>
                        <div class="event-info">
                            <span><i class="fas fa-location-dot"></i> Desa Bumirestu</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="agenda-btn">
                <a href="#" class="btn">Lihat Semua Agenda</a>
            </div>
        </div>
    </section>

    <!-- CTA IKTSARO -->
    <section class="cta-iktsaro">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2>Mari Terus Menjalin Silaturahmi dan Mengabdi Bersama</h2>
                <p>IKTSARO hadir sebagai wadah untuk mempererat ukhuwah, memperkuat jaringan alumni, serta berkontribusi dalam kemajuan Pondok Pesantren Roudlotussolihin dan masyarakat.</p>
                <div class="cta-buttons">
                    <a href="iktsaro-form/" class="btn">Gabung IKTSARO</a>
                    <a href="https://wa.me/6285174348947?text=Assalamualaikum%20wr.%20wb                .%0A%0AHalo%20Admin%2C%20saya%20ingin%20mendaftar%20dan%20mendata%20diri%20sebagai%20alumni%20IKTSARO.%20Mohon%20arahan%20selanjutnya.%20Terima%20kasih." class="btn-outline">Hubungi Pengurus</a>
                </div>
            </div>
        </div>
    </section>

    <a href="https://wa.me/6285174348947?text=Assalamualaikum%20wr.%20wb.%0A%0AHalo%20Admin%2C%20saya%20ingin%20mendaftar%20dan%20mendata%20diri%20sebagai%20alumni%20IKTSARO.%20Mohon%20arahan%20selanjutnya.%20Terima%20kasih." class="whatsapp-float">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- FOOTER -->

<!-- Scripts -->
@endsection

@push('scripts')
<script>AOS.init();</script>
<script src="{{ asset('assets/js/scriptiktsaro.js') }}"></script>
<script src="{{ asset('assets/js/custom-popup-iktsaro.js') }}"></script>
@endpush
