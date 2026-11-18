@extends('layouts.app')

@section('title', 'Gedung MTs Ma\'arif - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/detail.css') }}">
<style>
        /* Penyesuaian khusus halaman Gedung MTs */
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
<!-- GEDUNG MTS SECTION -->
    <section class="gedung-detail-section">
        <div class="gedung-detail-header" data-aos="fade-up">
            <span class="section-badge">FASILITAS GEDUNG PENDIDIKAN</span>
            <h2>Gedung MTs Ma'arif Bumirestu</h2>
            <p>Pusat pendidikan tingkat menengah pertama yang mempersiapkan generasi berprestasi dengan wawasan ilmu pengetahuan umum dan agama yang seimbang[cite: 3].</p>
        </div>

        <!-- Kotak Informasi Detail -->
        <div class="gedung-info-box" data-aos="fade-up">
            <h3>Infrastruktur Menengah Pertama yang Modern & Kondusif</h3>
            <p>Gedung MTs Ma'arif Bumirestu dirancang untuk memenuhi standar kebutuhan belajar remaja usia SMP/MTs. Setiap ruang kelas dilengkapi dengan fasilitas penunjang pembelajaran modern, tata cahaya yang baik, serta ventilasi maksimal untuk menciptakan lingkungan belajar yang interaktif dan nyaman.</p>
            <p>Kompleks gedung ini juga terintegrasi langsung dengan laboratorium pendukung, lapangan olahraga multiguna, ruang guru, serta fasilitas ekstrakurikuler guna menunjang pengembangan bakat, minat, serta prestasi akademik maupun non-akademik peserta didik.</p>
        </div>

        <h3 class="galeri-title" data-aos="fade-up">Dokumentasi & Galeri Gedung MTs</h3>

        <!-- Galeri Foto (Tampak Depan, Samping, Dalam, dll) -->
        <div class="galeri-grid">
            
            <!-- Foto 1 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/pprm.jpg') }}" alt="Tampak Depan Gedung MTs">
                <div class="galeri-desc">
                    <h4>Tampak Depan Gedung MTs</h4>
                    <p>Fasad gedung utama MTs Ma'arif Bumirestu yang berdiri megah, bersih, dan berwibawa di lingkungan yayasan.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/pprm.jpg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/pprs.jpg') }}" alt="Tampak Samping & Koridor Gedung">
                <div class="galeri-desc">
                    <h4>Tampak Samping & Koridor</h4>
                    <p>Area koridor luas dan bertingkat yang menghubungkan antar ruang kelas serta ruang kegiatan siswa.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/pprs.jpg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero1.jpeg') }}" alt="Ruang Kelas Pembelajaran">
                <div class="galeri-desc">
                    <h4>Ruang Kelas Pembelajaran (Dalam)</h4>
                    <p>Ruangan kelas representatif yang dilengkapi kursi meja belajar ergonomis, papan tulis besar, dan media ajar.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/hero1.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 4 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/hero2.jpeg') }}" alt="Laboratorium & Ruang Komputer">
                <div class="galeri-desc">
                    <h4>Laboratorium & Sarana Praktik</h4>
                    <p>Fasilitas penunjang praktik sains dan komputer untuk membekali siswa dengan keterampilan teknologi masa kini.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/hero2.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 5 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/hero3.jpeg') }}" alt="Lapangan Olahraga & Kegiatan">
                <div class="galeri-desc">
                    <h4>Lapangan Olahraga & Upacara</h4>
                    <p>Area lapangan terbuka multifungsi untuk kegiatan olahraga (futsal, basket, voli) serta kegiatan apel dan upacara.</p>
                    <div class="galeri-actions">
                        <button class="btn-detail" onclick="openModal('assets/images/hero3.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 6 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero4.jpeg') }}" alt="Ruang Guru & Tata Usaha">
                <div class="galeri-desc">
                    <h4>Ruang Guru & Tata Usaha</h4>
                    <p>Pusat koordinasi dewan guru pengajar serta pelayanan administrasi kependidikan siswa tingkat MTs.</p>
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
            <img id="modalImage" src="" alt="Preview Gedung MTs">
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
