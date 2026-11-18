@extends('layouts.app')

@section('title', 'Gedung MI Ma\'arif - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/detail.css') }}">
<style>
        /* Penyesuaian khusus halaman Gedung MI */
        .gedung-detail-section {
            padding: 160px 10% 100px 10%;
            background: #f8fafc;
        }
        .gedung-detail-header {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 60px auto;
        }
        .gedung-detail-header .section-badge {
            display: inline-block;
            padding: 8px 18px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .gedung-detail-header h2 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .gedung-detail-header p {
            color: #111827 !important;
            font-size: 17px;
            line-height: 1.9;
        }

        /* Deskripsi Utama */
        .gedung-info-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
            margin-bottom: 60px;
        }
        .gedung-info-box h3 {
            font-size: 26px;
            color: #111827;
            margin-bottom: 15px;
        }
        .gedung-info-box p {
            color: #111827 !important;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        /* Galeri Grid */
        .galeri-title {
            text-align: center;
            font-size: 32px;
            color: #111827;
            margin-bottom: 40px;
        }
        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .galeri-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
            transition: .4s;
        }
        .galeri-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,.15);
        }
        .galeri-card img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
        }
        .galeri-desc {
            padding: 20px;
        }
        .galeri-desc h4 {
            font-size: 18px;
            color: #111827;
            margin-bottom: 8px;
        }
        .galeri-desc p {
            color: #111827 !important;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        @media(max-width: 992px) {
            .galeri-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media(max-width: 768px) {
            .galeri-grid {
                grid-template-columns: 1fr;
            }
            .gedung-detail-header h2 {
                font-size: 32px;
            }
        }
    </style>
@endpush

@section('content')
<!-- GEDUNG MI SECTION -->
    <section class="gedung-detail-section">
        <div class="gedung-detail-header" data-aos="fade-up">
            <span class="section-badge">FASILITAS GEDUNG PENDIDIKAN</span>
            <h2>Gedung MI Ma'arif Bumirestu</h2>
            <p>Pusat pendidikan tingkat dasar yang memadukan kurikulum nasional dengan pembentukan karakter Islami dalam lingkungan sekolah yang representatif dan nyaman[cite: 3].</p>
        </div>

        <!-- Kotak Informasi Detail -->
        <div class="gedung-info-box" data-aos="fade-up">
            <h3>Infrastruktur Pendidikan Dasar yang Representatif</h3>
            <p>Gedung MI Ma'arif Bumirestu dirancang secara khusus untuk mendukung kegiatan belajar mengajar tingkat sekolah dasar. Setiap ruang kelas dilengkapi dengan fasilitas penunjang belajar yang memadai, pencahayaan alami, serta ventilasi udara yang optimal guna menciptakan suasana kelas yang kondusif.</p>
            <p>Selain ruang kelas reguler, kompleks gedung ini juga dilengkapi dengan halaman upacara/lapangan olahraga, ruang guru, unit kesehatan, serta fasilitas pendukung lainnya untuk mengoptimalkan potensi akademik maupun non-akademik peserta didik.</p>
        </div>

        <h3 class="galeri-title" data-aos="fade-up">Dokumentasi & Galeri Gedung MI</h3>

        <!-- Galeri Foto (Tampak Depan, Samping, Dalam, dll) -->
        <div class="galeri-grid">
            
            <!-- Foto 1 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/pprm.jpg') }}" alt="Tampak Depan Gedung MI">
                <div class="galeri-desc">
                    <h4>Tampak Depan Gedung MI</h4>
                    <p>Fasad utama gedung MI Ma'arif Bumirestu yang kokoh, rapi, dan dikelilingi lingkungan belajar yang asri.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/pprm.jpg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/pprs.jpg') }}" alt="Tampak Samping & Koridor Kelas">
                <div class="galeri-desc">
                    <h4>Tampak Samping & Koridor</h4>
                    <p>Area koridor penghubung antar kelas yang bersih, luas, serta nyaman digunakan lalu-lalang siswa.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/pprs.jpg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero1.jpeg') }}" alt="Ruang Kelas Belajar (Dalam)">
                <div class="galeri-desc">
                    <h4>Ruang Kelas Belajar (Dalam)</h4>
                    <p>Ruangan kelas yang tertata rapi lengkap dengan meja, kursi, papan tulis, serta media pembelajaran interaktif.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/hero1.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 4 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/hero2.jpeg') }}" alt="Halaman & Lapangan Sekolah">
                <div class="galeri-desc">
                    <h4>Halaman & Lapangan Upacara</h4>
                    <p>Area halaman terbuka yang luas di depan gedung untuk kegiatan apel pagi, upacara bendera, dan kegiatan ekstrakurikuler.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/hero2.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 5 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/hero3.jpeg') }}" alt="Kantor Guru & Administrasi">
                <div class="galeri-desc">
                    <h4>Ruang Guru & Staf Administrasi</h4>
                    <p>Pusat koordinasi dewan guru dan pelayanan administrasi kependidikan MI Ma'arif Bumirestu.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/hero3.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 6 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero4.jpeg') }}" alt="Fasilitas Pendukung Siswa">
                <div class="galeri-desc">
                    <h4>Fasilitas Penunjang Siswa</h4>
                    <p>Fasilitas penunjang kebersihan, tempat ibadah pendukung, serta sarana cuci tangan yang higienis di lingkungan sekolah.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/hero4.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================
         MODAL POP-UP (GAMBAR BESAR)
    ========================= -->
    <div id="imageModal">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div id="modalImgContainer">
            <img id="modalImage" src="" alt="Preview Gedung MI">
        </div>
        <div class="modal-controls">
            <button onclick="zoomOut()" title="Zoom Out"><i class="fas fa-search-minus"></i></button>
            <button onclick="resetZoom()" title="Reset Size"><i class="fas fa-sync-alt"></i></button>
            <button onclick="zoomIn()" title="Zoom In"><i class="fas fa-search-plus"></i></button>
        </div>
    </div>
    </section>

    <!-- FOOTER -->

<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
@endsection

@push('scripts')
<script src="{{ asset('assets/js/detail.js') }}"></script>
@endpush
