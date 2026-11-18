@extends('layouts.app')

@section('title', 'Gedung MUS Roudlotussolihin Tahfidz - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<link rel="stylesheet"
          href="{{ asset('assets/css/detail.css') }}">
<style>
        /* Penyesuaian khusus halaman Gedung MUS Roudlotussolihin Tahfidz */
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
<!-- GEDUNG MUS TAHFIDZ SECTION -->
    <section class="gedung-detail-section">
        <div class="gedung-detail-header" data-aos="fade-up">
            <span class="section-badge">Fasilitas Khusus Tahfidz</span>
            <h2>Gedung MUS Roudlotussolihin Tahfidz</h2>
            <p>Pusat khusus untuk program menghafal Al-Qur'an dengan metode intensif dan pembinaan karakter qur'ani bagi para santri.</p>
        </div>

        <!-- Kotak Informasi Detail -->
        <div class="gedung-info-box" data-aos="fade-up">
            <h3>Pusat Karantina & Pembinaan Hafalan Al-Qur'an</h3>
            <p>Gedung MUS Roudlotussolihin Tahfidz dirancang dan dikondisikan secara khusus untuk menciptakan suasana yang tenang, hening, serta sangat mendukung proses konsentrasi para santri dalam menghafal ayat-ayat suci Al-Qur'an secara intensif.</p>
            <p>Fasilitas gedung ini dilengkapi dengan ruang halaqah tahfidz yang nyaman, bilik setoran hafalan yang kondusif, serta pengawasan langsung oleh para dewan asatidz dan hafizh berpengalaman guna memastikan kualitas serta kelancaran hafalan santri tercapai secara optimal.</p>
        </div>

        <h3 class="galeri-title" data-aos="fade-up">Dokumentasi & Galeri Gedung Tahfidz</h3>

        <!-- Galeri Foto (Tampak Depan, Samping, Dalam, dll) -->
        <div class="galeri-grid">
            
            <!-- Foto 1 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/pprs.jpg') }}" alt="Tampak Depan Gedung Tahfidz">
                <div class="galeri-desc">
                    <h4>Tampak Depan Gedung Tahfidz</h4>
                    <p>Fasad bangunan khusus program tahfidz yang tenang, bersih, serta dikelilingi suasana lingkungan pesantren yang sejuk.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/pprs.jpg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/pprm.jpg') }}" alt="Tampak Samping & Area Sekitar">
                <div class="galeri-desc">
                    <h4>Tampak Samping & Lingkungan</h4>
                    <p>Area luar gedung yang asri dan jauh dari kebisingan, dirancang khusus untuk menjaga kekhusyukan santri menghafal.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/pprm.jpg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero1.jpeg') }}" alt="Ruang Halaqah Tahfidz (Dalam)">
                <div class="galeri-desc">
                    <h4>Ruang Halaqah Tahfidz (Dalam)</h4>
                    <p>Ruangan luas berkarpet rapi tempat santri melangsungkan kegiatan setoran hafalan (ziyadah dan muroja'ah) secara rutin.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero1.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 4 -->
            <div class="galeri-card" data-aos="fade-up">
                <img src="{{ asset('assets/images/hero2.jpeg') }}" alt="Bilik Setoran & Evaluasi Hafalan">
                <div class="galeri-desc">
                    <h4>Bilik Setoran & Bimbingan Khusus</h4>
                    <p>Ruang privat atau semi-privat yang digunakan santri untuk menyetorkan hafalan secara bergantian kepada muhaffizh/muhaffizhah.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero2.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 5 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/images/hero3.jpeg') }}" alt="Kantor Pembina & Muhaffizh">
                <div class="galeri-desc">
                    <h4>Kantor Dewan Pembina Tahfidz</h4>
                    <p>Pusat evaluasi target hafalan harian, mingguan, dan bulanan santri serta koordinasi para guru pembimbing Al-Qur'an.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero3.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
                    </div>
                </div>
            </div>

            <!-- Foto 6 -->
            <div class="galeri-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/images/hero4.jpeg') }}" alt="Fasilitas Pendukung Karantina">
                <div class="galeri-desc">
                    <h4>Fasilitas Penunjang Karantina</h4>
                    <p>Sarana pendukung kenyamanan santri selama berada di asrama karantina tahfidz untuk fokus mengkhatamkan Al-Qur'an.</p>
                    <div class="galeri-actions" style="margin-top: 15px;">
                        <button class="btn-detail" onclick="openModal('assets/images/hero4.jpeg')" style="width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; background: #eff6ff; color: #2563eb; transition: .3s;"><i class="fas fa-eye"></i> Detail</button>
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
