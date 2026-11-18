@extends('layouts.app')

@section('title', 'Masjid - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/detail.css') }}">
<style>
        /* Penyesuaian khusus halaman Masjid */
        .masjid-section {
            padding: 160px 10% 100px 10%;
            background: #f8fafc;
        }
        .masjid-header {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 60px auto;
        }
        .masjid-header .section-badge {
            display: inline-block;
            padding: 8px 18px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .masjid-header h2 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .masjid-header p {
            color: #111827 !important;
            font-size: 17px;
            line-height: 1.9;
        }

        /* Deskripsi Utama */
        .masjid-info-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
            margin-bottom: 60px;
        }
        .masjid-info-box h3 {
            font-size: 26px;
            color: #111827;
            margin-bottom: 15px;
        }
        .masjid-info-box p {
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
            .masjid-header h2 {
                font-size: 32px;
            }
        }
    </style>
@endpush

@section('content')
<!-- MASJID SECTION -->
    <section class="masjid-section">
        <div class="masjid-header" data-aos="fade-up">
            <span class="section-badge">FASILITAS IBADAH</span>
            <h2>Masjid Lingkungan Yayasan</h2>
            <p>Pusat kegiatan ibadah, pembinaan keagamaan, serta tempat pembentukan akhlak spiritual santri dan masyarakat sekitar.</p>
        </div>

        <!-- Kotak Informasi Detail -->
        <div class="masjid-info-box" data-aos="fade-up">
            <h3>Pusat Spiritual & Pembinaan Karakter Santri</h3>
            <p>Masjid di lingkungan Yayasan Pendidikan Pondok Pesantren Roudlotussolihin bukan hanya sekadar tempat pelaksanaan shalat berjamaah lima waktu, tetapi juga menjadi jantung dari seluruh aktivitas keislaman, pengajian kitab, hafalan Al-Qur'an, serta pembinaan akhlak santri sehari-hari.</p>
            <p>Dengan arsitektur yang megah, bersih, serta area serambi yang luas, masjid ini mampu menampung ratusan jamaah baik dari kalangan siswa, santri, dewan guru, maupun masyarakat umum sekitar pondok dengan suasana yang khusyuk dan sejuk.</p>
        </div>

        <h3 class="galeri-title" data-aos="fade-up">Dokumentasi & Galeri Masjid</h3>

        <!-- Galeri Foto (Tampak Depan, Samping, Dalam, Tempat Wudhu, dll) -->
        <div class="galeri-grid">
            
            <!-- Foto 1 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/hero1.jpeg') }}" alt="Tampak Depan Masjid">
                <div class="galeri-desc">
                    <h4>Tampak Depan Masjid</h4>
                    <p>Fasad megah halaman utama masjid yang dilengkapi arsitektur islami serta pelataran yang luas dan asri.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero1.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/hero2.jpeg') }}" alt="Tampak Samping & Serambi">
                <div class="galeri-desc">
                    <h4>Tampak Samping & Serambi</h4>
                    <p>Area serambi samping yang terbuka dan sejuk, biasa digunakan santri untuk beristirahat atau tadarus Al-Qur'an.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero2.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero3.jpeg') }}" alt="Ruang Utama Shalat (Interior)">
                <div class="galeri-desc">
                    <h4>Ruang Utama Shalat (Interior)</h4>
                    <p>Bagian dalam ruang shalat yang dilengkapi karpet bersih, pencahayaan optimal, serta mihrab yang tertata rapi.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero3.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 4 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/hero4.jpeg') }}" alt="Tempat Wudhu & Sanitasi">
                <div class="galeri-desc">
                    <h4>Tempat Wudhu & Sanitasi</h4>
                    <p>Fasilitas tempat wudhu terpisah (putra dan putri) dengan pasokan air bersih yang memadai serta higienis.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero4.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 5 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/hero5.jpeg') }}" alt="Kegiatan Pengajian Santri">
                <div class="galeri-desc">
                    <h4>Kegiatan Pengajian & Tadarus</h4>
                    <p>Suasana kebersamaan para santri saat melaksanakan kegiatan kajian rutin dan setoran hafalan di dalam masjid.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero5.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 6 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/pprs.jpg') }}" alt="Kubah & Menara Masjid">
                <div class="galeri-desc">
                    <h4>Kubah & Menara Masjid</h4>
                    <p>Detail arsitektur kubah dan menara tinggi yang menjadi salah satu ikon kebanggaan di lingkungan yayasan.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/pprs.jpg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- MODAL POP-UP -->
    <div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.85); z-index: 9999999; justify-content: center; align-items: center; flex-direction: column; backdrop-filter: blur(5px);">
        <span class="modal-close" onclick="closeModal()" style="position: absolute; top: 20px; right: 30px; color: white; font-size: 40px; cursor: pointer; z-index: 10;">&times;</span>
        <div id="modalImgContainer" style="position: relative; width: 90%; height: 80vh; display: flex; justify-content: center; align-items: center; overflow: auto;">
            <img id="modalImage" src="" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.3s ease; transform-origin: center center;">
        </div>
        <div class="modal-controls" style="position: absolute; bottom: 30px; display: flex; gap: 20px; background: rgba(255, 255, 255, 0.15); padding: 12px 25px; border-radius: 50px; backdrop-filter: blur(10px);">
            <button onclick="zoomOut()" title="Zoom Out" style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;"><i class="fas fa-search-minus"></i></button>
            <button onclick="resetZoom()" title="Reset Size" style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;"><i class="fas fa-sync-alt"></i></button>
            <button onclick="zoomIn()" title="Zoom In" style="background: none; border: none; color: white; font-size: 22px; cursor: pointer;"><i class="fas fa-search-plus"></i></button>
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
