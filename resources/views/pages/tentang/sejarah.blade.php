@extends('layouts.app')

@section('title', 'Sejarah YPPPRS - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<style>
        /* Penyesuaian khusus halaman Sejarah agar teks hitam pekat & nyaman dibaca */
        .sejarah-page {
            padding: 160px 10% 100px 10%;
            background: #ffffff;
        }
        .sejarah-header {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 60px auto;
        }
        .sejarah-header .section-badge {
            display: inline-block;
            padding: 8px 18px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .sejarah-header h2 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .sejarah-header p {
            color: #111827 !important;
            font-size: 17px;
            line-height: 1.9;
        }
        .sejarah-content-box {
            max-width: 900px;
            margin: 0 auto;
            background: #f8fafc;
            padding: 50px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,.05);
        }
        .sejarah-content-box p {
            color: #111827 !important;
            font-size: 17px;
            line-height: 2;
            margin-bottom: 25px;
        }
        .sejarah-content-box h3 {
            color: #111827;
            font-size: 24px;
            margin-top: 35px;
            margin-bottom: 15px;
        }
        @media(max-width: 768px) {
            .sejarah-content-box {
                padding: 25px;
            }
            .sejarah-header h2 {
                font-size: 32px;
            }
        }
        
        /* CSS Tambahan untuk merapikan list (poin-poin) */
        .sejarah-content-box ol {
            padding-left: 20px; /* Memberikan jarak agar angka tidak keluar jalur/rata kiri */
            margin-bottom: 25px; /* Jarak dengan paragraf di bawahnya */
        }
        
        .sejarah-content-box li {
            color: #111827;
            font-size: 17px;
            line-height: 2;
            margin-bottom: 10px; /* Jarak antar poin agar tidak terlalu rapat */
        }
        
    </style>
@endpush

@section('content')
<!-- SEJARAH SECTION -->
    <section class="sejarah-page">
        <div class="sejarah-header" data-aos="fade-up">
            <span class="section-badge">JEJAK LANGKAH</span>
            <h2>Sejarah Berdirinya Yayasan</h2>
            <p>Perjalanan panjang penuh perjuangan, ketulusan, dan dedikasi dalam membangun pondasi pendidikan Islam dari masa ke masa.</p>
        </div>

        <div class="sejarah-content-box" data-aos="fade-up">
            <p>Pondok Pesantren MUS Roudlotussolihin berdiri pada 18 Mei 1989 di Desa Bumi Restu, Kecamatan Palas, Kabupaten Lampung Selatan, Provinsi Lampung. Pesantren ini berada di bawah naungan Yayasan Pendidikan Pondok Pesantren Roudlotussolihin yang didirikan oleh KH. RM. Soleh Bajuri, putra daerah Desa Cikarag, Kecamatan Cimanggu, Kabupaten Cilacap, Jawa Tengah, yang lahir pada 24 April 1957.</p>
            
            <p>Awal mula syiar Islam beliau di Lampung Selatan berawal dari undangan seorang takmir Masjid Al-Muhajirin Desa Bumi Restu, yaitu Mbah Kiai Daud, untuk mengajar dan membina masyarakat melalui kegiatan keagamaan di masjid tersebut.</p>
            
            <p>Sebelum kedatangan beliau ke Lampung, Mbah Kiai Daud bersilaturahim kepada ulama kharismatik sekaligus Pengasuh Pondok Pesantren Miftahul Huda Cigaru Cibeunying Majenang, KH. Djarir Sufyan, dengan memohon izin agar salah satu menantunya dapat berdakwah di Desa Bumi Restu, Kecamatan Palas, Kabupaten Lampung Selatan.</p>
            
            <p>Sekitar satu tahun setelah menetap di Lampung, KH. RM. Soleh Bajuri mendirikan Yayasan Pendidikan Pondok Pesantren Roudlotussolihin sebagai pusat pendidikan, dakwah, dan pembinaan umat. Hingga saat ini, yayasan dan pesantren masih berada di bawah kepemimpinan serta naungan beliau sebagai pendiri.</p>

            <h3>Perkembangan dan Perluasan Lembaga</h3>
            <p>Seiring perkembangan zaman, Pondok Pesantren Roudlotussolihin terus mengembangkan pendidikan yang memadukan nilai-nilai keislaman dengan pendidikan formal dan nonformal.</p>

            <p>Program pendidikan nonformal yang diselenggarakan meliputi Madrasah Diniyah, Majelis Ta’lim Bapak-Bapak, dan Majelis Ta’lim Ibu-Ibu. Adapun unit pendidikan formal yang berada di bawah naungan yayasan adalah:</p>
            <ol>
                <li>MTs Ma’arif Bumirestu — berdiri tahun 1989</li>
                <li>MI Ma’arif Bumirestu — berdiri tahun 1990</li>
                <li>SMA Ma’arif Bumirestu — berdiri tahun 2004</li>
                <li>RA Al-Qur’an Roudlotussolihin — berdiri tahun 2024</li>
            </ol>
                
            <p>Hingga kini, Pondok Pesantren Roudlotussolihin terus berkomitmen mencetak generasi yang berakhlakul karimah, berilmu, dan mampu memberikan manfaat bagi agama, bangsa, dan masyarakat.</p>

            <h3>Komitmen di Era Modern</h3>
            <p>Kini, dengan pengalaman pengabdian lebih dari 37 tahun, Yayasan Pendidikan Pondok Pesantren Roudlotussolihin terus berbenah mengikuti perkembangan zaman. Peningkatan mutu fasilitas, pembaruan kurikulum berbasis teknologi, serta penguatan karakter menjadi fokus utama agar lembaga ini senantiasa relevan dan mampu melahirkan generasi penerus bangsa yang unggul, mandiri, dan berakhlakul karimah.</p>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
@endsection
