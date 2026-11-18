@extends('layouts.app')

@section('title', 'Visi & Misi - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<style>
        /* Penyesuaian khusus halaman Visi Misi agar teks hitam pekat */
        .visi-misi-page {
            padding: 160px 10% 100px 10%;
        }
        .visi-misi-page h2 {
            text-align: center;
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
        }
        .visi-misi-page .section-desc {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 60px auto;
            color: #111827 !important;
            font-size: 17px;
            line-height: 1.8;
        }
        .container-visi {
            display: flex;
            gap: 30px;
            justify-content: center;
        }
        .container-visi .card {
            flex: 1;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.1);
            background: rgb(255, 170, 0); 
            color: white;
            opacity: 0;
            transform: perspective(1000px) translateY(100px) scale(.7) rotateX(15deg);
            transition: all 1s ease;
        }
        .container-visi .card.show {
            opacity: 1;
            transform: perspective(1000px) translateY(0) scale(1) rotateX(0deg);
        }
        .container-visi .card h3 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffffff;
        }
        .container-visi .card p,
        .container-visi .card li {
            font-size: 16px;
            line-height: 1.8;
            color: #ffffff;
        }
        .container-visi .card ul {
            padding-left: 20px;
        }
        @media(max-width: 768px) {
            .container-visi {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
<!-- VISI & MISI SECTION -->
    <section class="visi-misi-page">
        <div data-aos="fade-up">
            <div style="text-align: center;">
                <span class="section-badge" style="display:inline-block; padding:8px 18px; background:#dcfce7; color:#15803d; border-radius:50px; font-size:14px; font-weight:600; margin-bottom:20px;">ARAH & TUJUAN</span>
            </div>
            <h2>Visi & Misi Yayasan</h2>
            <p class="section-desc">Landasan dan pedoman utama dalam mengarahkan seluruh proses pendidikan untuk mewujudkan generasi yang berkualitas, religius, serta berdaya saing.</p>
        </div>
        
        <div class="container-visi">
            <div class="card" data-aos="fade-right">
                <h3>Visi</h3>
                <p>Mengawal dan mencetak generasi bangsa yang beriman, berakhlakul karimah, cerdas dan berbudaya</p>
            </div>
            <div class="card" data-aos="fade-left">
                <h3>Misi</h3>
                <ul>
                    <li>Melahirkan generasi penerus yang beriman dan berkualitas</li>
                    <li>Mewujudkan keunggulan dalam pengembangan keislaman</li>
                    <li>Meningkatkan sumberdaya pendidik dan kependidikan yang professional</li>
                    <li>Mewujudkan proses belajar mengajar yang berbasis keagamaan berkemajuan</li>
                    <li>Mewujudkan lingkungan pendidikan yang kreatif, edukatif, religious dan akuntabel</li>
                    <li>Mengembangkan seni budaya yang relevan dengan ciri khas pesantren menuju kebudayaan local, nasional dan internasional</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
@endsection
