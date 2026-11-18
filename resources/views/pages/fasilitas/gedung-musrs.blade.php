@extends('layouts.app')

@section('title', 'Gedung MUS Roudlotussolihin - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/detail.css') }}">
<style>
        /* Penyesuaian khusus halaman Gedung MUS Roudlotussolihin */
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
<!-- GEDUNG MUS RS SECTION -->
    <section class="gedung-detail-section">
        <div class="gedung-detail-header" data-aos="fade-up">
            <span class="section-badge">FASILITAS PENDIDIKAN NON-FORMAL</span>
            <h2>Gedung MUS Roudlotussolihin</h2>
            <p>Pusat pendidikan keagamaan non-formal yang berfokus pada pendalaman ilmu agama (Diniyah) dan pembentukan karakter santri[cite: 3].</p>
        </div>

        <!-- Kotak Informasi Detail -->
        <div class="gedung-info-box" data-aos="fade-up">
            <h3>Pusat Kajian Kitab Kuning & Diniyah Santri</h3>
            <p>Gedung Madrasah Diniyah Ula/Wustha (MUS) Roudlotussolihin dirancang untuk mendukung kegiatan pengajaran ilmu-ilmu keislaman klasik maupun kontemporer. Ruang kelas dirancang luas dan fleksibel agar nyaman digunakan para santri dalam menyimak sorogan, bandongan, serta musyawarah kitab.</p>
            <p>Kompleks gedung ini terintegrasi langsung dengan asrama santri dan lingkungan pondok pesantren, menciptakan ekosistem pendidikan religius yang kondusif selama 24 jam penuh dalam membina akhlak dan kedalaman ilmu agama santri.</p>
        </div>

        <h3 class="galeri-title" data-aos="fade-up">Dokumentasi & Galeri Gedung MUS Roudlotussolihin</h3>

        <!-- Galeri Foto (Tampak Depan, Samping, Dalam, dll) -->
        <div class="galeri-grid">
            
            <!-- Foto 1 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/pprs.jpg') }}" alt="Tampak Depan Gedung MUS RS">
                <div class="galeri-desc">
                    <h4>Tampak Depan Kompleks MUS</h4>
                    <p>Fasad gedung madrasah diniyah yang menjadi pusat kegiatan pengajian harian para santri di lingkungan pondok.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/pprs.jpg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/pprm.jpg') }}" alt="Tampak Samping & Lingkungan Asrama">
                <div class="galeri-desc">
                    <h4>Tampak Samping & Area Asrama</h4>
                    <p>Lingkungan sekitar gedung yang terhubung langsung dengan kompleks asrama dan pondok pesantren santri.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/pprm.jpg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero1.jpeg') }}" alt="Ruang Kelas Pengajian Kitab">
                <div class="galeri-desc">
                    <h4>Ruang Kelas Pengajian (Dalam)</h4>
                    <p>Ruangan luas beralaskan karpet bersih tempat para santri duduk bersila mendengarkan kajian kitab kuning dari asatidz.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero1.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 4 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/hero2.jpeg') }}" alt="Aula Kegiatan Santri">
                <div class="galeri-desc">
                    <h4>Aula Pertemuan & Musyawarah</h4>
                    <p>Ruang serbaguna untuk kegiatan bahtsul masail, musyawarah santri, serta acara peringatan hari besar Islam (PHBI).</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero2.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 5 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/hero3.jpeg') }}" alt="Kantor Pengurus & Dewan Asatidz">
                <div class="galeri-desc">
                    <h4>Kantor Pengurus & Dewan Asatidz</h4>
                    <p>Pusat administrasi madrasah diniyah serta ruang koordinasi para dewan guru dan pengurus pondok pesantren.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero3.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 6 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero4.jpeg') }}" alt="Sarana Pendukung Pesantren">
                <div class="galeri-desc">
                    <h4>Fasilitas Pendukung Santri</h4>
                    <p>Sarana pendukung kenyamanan santri sehari-hari dalam menuntut ilmu di lingkungan pondok pesantren.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero4.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =========================
         MODAL POP-UP (GAMBAR BESAR)
    ========================= -->
    <div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.85); z-index: 9999999; justify-content: center; align-items: center; flex-direction: column; backdrop-filter: blur(5px);">
        <span class="modal-close" onclick="closeModal()" style="position: absolute; top: 20px; right: 30px; color: white; font-size: 40px; cursor: pointer; z-index: 10;">&times;</span>
        <div id="modalImgContainer" style="position: relative; width: 90%; height: 80vh; display: flex; justify-content: center; align-items: center; overflow: auto;">
            <img id="modalImage" src="" alt="Preview Gedung MUS RS" style="max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.3s ease; transform-origin: center center;">
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
