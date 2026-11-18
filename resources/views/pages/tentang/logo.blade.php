@extends('layouts.app')

@section('title', 'Logo & Makna - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<style>
        /* Penyesuaian khusus halaman Logo & Makna */
        .logo-section {
            padding: 160px 10% 100px 10%;
            background: #ffffff;
        }
        .logo-header {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 60px auto;
        }
        .logo-header .section-badge {
            display: inline-block;
            padding: 8px 18px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .logo-header h2 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .logo-header p {
            color: #111827 !important;
            font-size: 17px;
            line-height: 1.9;
        }
        
        .logo-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 60px;
            max-width: 1100px;
            margin: 0 auto;
        }
        
        /* Bagian Gambar Logo */
        .logo-showcase {
            flex: 1;
            background: #f8fafc;
            padding: 50px;
            border-radius: 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,.05);
            position: sticky;
            top: 120px;
        }
        .logo-showcase img {
            width: 100%;
            max-width: 300px;
            height: auto;
            object-fit: contain;
            margin-bottom: 20px;
        }
        .logo-showcase h3 {
            color: #111827;
            font-size: 22px;
            margin-top: 15px;
        }

        /* Bagian Makna Logo */
        .makna-content {
            flex: 1.5;
        }
        .makna-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 20px;
            transition: .3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,.02);
        }
        .makna-item:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
            border-color: #16a34a;
            transform: translateX(5px);
        }
        .makna-item h4 {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            color: #111827;
            margin-bottom: 12px;
        }
        .makna-item h4 i {
            color: #16a34a;
            font-size: 24px;
        }
        .makna-item p {
            color: #111827 !important;
            font-size: 16px;
            line-height: 1.8;
            margin: 0;
        }

        @media(max-width: 992px) {
            .logo-wrapper {
                flex-direction: column;
            }
            .logo-showcase {
                position: relative;
                top: 0;
                width: 100%;
            }
            .logo-header h2 {
                font-size: 32px;
            }
        }
    </style>
@endpush

@section('content')
<!-- LOGO & MAKNA SECTION -->
    <section class="logo-section">
        <div class="logo-header" data-aos="fade-up">
            <span class="section-badge">IDENTITAS VISUAL</span>
            <h2>Logo Yayasan & Maknanya</h2>
            <p>Setiap elemen pada logo Yayasan Pendidikan Pondok Pesantren Roudlotussolihin memiliki filosofi dan doa yang mencerminkan visi luhur lembaga.</p>
        </div>

        <div class="logo-wrapper">
            <!-- Box Logo -->
            <div class="logo-showcase" data-aos="fade-right">
                <img src="{{ asset('assets/images/ypp.png') }}" alt="Logo YPPPRS Beserta Makna">
                <h3>Logo Resmi YPPPRS</h3>
                <p style="color: #111827; margin-top: 10px; font-size: 15px;">Identitas resmi yayasan yang digunakan dalam seluruh aktivitas akademik dan administrasi.</p>
            </div>

            <!-- List Makna Logo (Silakan disesuaikan dengan makna aslinya) -->
            <div class="makna-content" data-aos="fade-left">
                
                <div class="makna-item">
                    <h4><i class="fas fa-book-open"></i> Kitab Suci / Al-Qur'an</h4>
                    <p>Melambangkan bahwa Al-Qur'an dan As-Sunnah merupakan sumber utama pedoman hidup dan dasar pijakan ilmu pengetahuan yang diajarkan di lembaga ini.</p>
                </div>

                <div class="makna-item">
                    <h4><i class="fas fa-star"></i> Bintang Bersinar</h4>
                    <p>Menggambarkan cita-cita yang tinggi, harapan yang mulia, serta cahaya ilahi yang senantiasa menerangi perjalanan setiap santri dalam menuntut ilmu.</p>
                </div>

                <div class="makna-item">
                    <h4><i class="fas fa-globe"></i> Lingkaran / Bola Dunia</h4>
                    <p>Mewakili wawasan global dan universalitas ajaran Islam. Mengandung harapan agar lulusan yayasan mampu berkiprah tidak hanya di tingkat lokal, tetapi juga di kancah nasional dan internasional.</p>
                </div>

                <div class="makna-item">
                    <h4><i class="fas fa-palette"></i> Warna Hijau & Putih</h4>
                    <p><strong>Hijau</strong> melambangkan kedamaian, kesuburan, pertumbuhan, serta identitas kuat umat Islam. <strong>Putih</strong> melambangkan niat yang suci, kebersihan hati, dan ketulusan dalam mengabdi kepada umat.</p>
                </div>
                
                <div class="makna-item">
                    <h4><i class="fas fa-text-width"></i> Tulisan Nama Yayasan</h4>
                    <p>Menegaskan identitas lembaga sebagai institusi resmi yang teguh dan kokoh dalam mengemban amanah pendidikan berkarakter Ahlussunnah wal Jamaah.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
@endsection
