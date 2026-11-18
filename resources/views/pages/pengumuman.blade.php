@extends('layouts.app')

@section('title', 'Pengumuman - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/style-pengumuman.css') }}">
<style>
        /* Penyesuaian khusus halaman Pengumuman */
        .pengumuman-section {
            padding: 160px 10% 100px 10%;
            background: #f8fafc;
        }
        .pengumuman-header {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 60px auto;
        }
        .pengumuman-header .section-badge {
            display: inline-block;
            padding: 8px 18px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .pengumuman-header h2 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .pengumuman-header p {
            color: #111827 !important;
            font-size: 17px;
            line-height: 1.9;
        }

        /* Kotak Informasi Pengumuman */
        .pengumuman-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
            margin-bottom: 60px;
        }
        .pengumuman-box h3 {
            font-size: 26px;
            color: #111827;
            margin-bottom: 15px;
        }
        .pengumuman-box p {
            color: #111827 !important;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        /* Galeri Grid khusus Foto Pop-up */
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
            aspect-ratio: 4 / 5; /* Mengatur rasio kotak gambar menjadi 4:5 (1080x1350px) */
            height: auto;        /* Tinggi menyesuaikan otomatis */
            object-fit: contain; /* Memastikan seluruh gambar terlihat utuh tanpa terpotong */
            background-color: #f1f5f9; /* Warna latar jika ada sisa ruang */
            display: block;
        }
        .galeri-desc {
            padding: 25px;
        }
        .galeri-desc h4 {
            font-size: 20px;
            color: #111827;
            margin-bottom: 10px;
        }
        .galeri-desc p {
            color: #111827 !important;
            font-size: 15px;
            line-height: 1.7;
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
            .pengumuman-header h2 {
                font-size: 32px;
            }
        }
    </style>
@endpush

@section('content')
<!-- PENGUMUMAN SECTION -->
    <section class="pengumuman-section">
        <div class="pengumuman-header" data-aos="fade-up">
            <span class="section-badge">INFORMASI RESMI</span>
            <h2>Pengumuman Penting Yayasan</h2>
            <p>Kumpulan poster dan informasi penting yang sebelumnya ditampilkan pada beranda website.</p>
        </div>

        <!-- Kotak Informasi Detail Pengumuman -->
        <div class="pengumuman-box" data-aos="fade-up">
            <h3>Pusat Pengumuman & Brosur Informasi</h3>
            <p>Halaman ini secara khusus merangkum seluruh pamflet, brosur penerimaan, dan pengumuman penting yang bersumber dari galeri pop-up utama yayasan.</p>
            <p>Silakan tinjau informasi grafis di bawah ini untuk mengetahui detail program, jadwal kegiatan, serta persyaratan pendaftaran terbaru dari Yayasan Pendidikan Pondok Pesantren Roudlotussolihin.</p>
        </div>

        <h3 class="galeri-title" data-aos="fade-up">Dokumentasi Poster & Brosur Pengumuman</h3>

        <!-- Galeri Foto Khusus Pop-up (hero5.jpeg, pprs.jpg, pprt.jpg / ppram.jpg) -->
        
        <div class="galeri-grid">
            <!-- Foto 1 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/dkv4.jpeg') }}" alt="Informasi Pop-up 1">
                <div class="galeri-desc">
                    <h4>Pengumuman & Kegiatan Utama 1</h4>
                    <p>Informasi visual seputar profil dan dokumentasi kegiatan harian di lingkungan yayasan.</p>
                    <div class="galeri-actions">
                        <button class="btn-action btn-detail" onclick="openModal('assets/images/dkv4.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                        <a href="assets/images/dkv4.jpeg" download class="btn-action btn-download"><i class="fas fa-download"></i> Download</a>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/dkv2.jpeg') }}" alt="Informasi Pop-up 2">
                <div class="galeri-desc">
                    <h4>Brosur & Informasi Akademik 2</h4>
                    <p>Rincian program unggulan serta dokumentasi fasilitas pendidikan formal dan non-formal.</p>
                    <div class="galeri-actions">
                        <button class="btn-action btn-detail" onclick="openModal('assets/images/dkv2.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                        <a href="assets/images/dkv2.jpeg" download class="btn-action btn-download"><i class="fas fa-download"></i> Download</a>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/dkv3.jpeg') }}" alt="Informasi Pop-up 3">
                <div class="galeri-desc">
                    <h4>Pengumuman Pendaftaran & Seleksi 3</h4>
                    <p>Brosur pengumuman penting terkait gelombang pendaftaran siswa dan santri baru.</p>
                    <div class="galeri-actions">
                        <button class="btn-action btn-detail" onclick="openModal('assets/images/dkv3.jpeg')"><i class="fas fa-eye"></i> Detail</button>
                        <a href="assets/images/dkv3.jpeg" download class="btn-action btn-download"><i class="fas fa-download"></i> Download</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================
            MODAL POP-UP (GAMBAR BESAR)
        ========================= -->
        <div id="imageModal">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div id="modalImgContainer">
                <img id="modalImage" src="" alt="Preview Pengumuman">
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
<script src="{{ asset('assets/js/style-pengumuman.js') }}"></script>
@endpush
