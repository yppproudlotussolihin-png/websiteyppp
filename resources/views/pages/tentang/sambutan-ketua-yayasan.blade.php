@extends('layouts.app')

@section('title', 'Sambutan Ketua Yayasan - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<style>
        /* Penyesuaian khusus halaman Sambutan Ketua Yayasan */
        .ketua-section {
            padding: 160px 0 100px 0;
            background: #f8fafc;
        }
        .ketua-header {
            width: 100%;
            max-width: 850px;
            margin: 0 auto 70px;
            text-align: center;
        }
        .ketua-header .section-badge {
            display: inline-block;
            padding: 8px 18px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .ketua-header h2 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .ketua-header p {
            color: #111827 !important;
            line-height: 1.9;
            font-size: 17px;
        }
        .ketua-wrapper {
            display: flex;
            align-items: center;
            gap: 70px;
        }
        .ketua-image {
            flex: 1;
            position: relative;
        }
        .ketua-image img {
            width: 100%;
            display: block;
            border-radius: 25px;
        }
        .ketua-content {
            flex: 1;
        }
        .ketua-content .jabatan {
            display: inline-block;
            padding: 6px 16px;
            background: #e2e8f0;
            color: #0f172a;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .ketua-content h3 {
            font-size: 36px;
            color: #111827;
            margin-bottom: 20px;
        }
        .ketua-content p {
            color: #111827 !important;
            line-height: 1.9;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .ketua-content blockquote {
            margin-top: 25px;
            padding: 25px;
            background: white;
            border-left: 5px solid #16a34a;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,.05);
            color: #111827 !important;
            font-style: italic;
            font-weight: 500;
        }
        @media(max-width: 992px) {
            .ketua-wrapper {
                flex-direction: column;
            }
            .ketua-content {
                text-align: center;
            }
            .ketua-header h2 {
                font-size: 32px;
            }
        }
    </style>
@endpush

@section('content')
<!-- SAMBUTAN KETUA YAYASAN SECTION -->
    <section class="ketua-section">
        <div class="container">
            <div class="ketua-header" data-aos="fade-up">
                <span class="section-badge">SAMBUTAN PIMPINAN</span>
                <h2>Sambutan Ketua Yayasan</h2>
                <p>Komitmen kepemimpinan dalam mengawal mutu pendidikan, inovasi, serta pelayanan prima bagi para peserta didik dan masyarakat.</p>
            </div>
            <div class="ketua-wrapper">
                <div class="ketua-image" data-aos="fade-right">
                    <img src="{{ asset('assets/images/abahyusuf01.png') }}" alt="Ketua Yayasan">
                </div>
                <div class="ketua-content" data-aos="fade-left">
                    <span class="jabatan">Ketua Yayasan</span>
                    <h3>Ust. M. Yusuf Zakaria</h3>
                    <p>Assalamu’alaikum Warahmatullahi Wabarakatuh,</p>
                    <p>Puji syukur senantiasa kita panjatkan ke hadirat Allah SWT atas segala nikmat dan karunia-Nya sehingga website resmi Yayasan Pendidikan Pondok Pesantren Roudlotussolihin ini dapat terus hadir sebagai sarana informasi dan komunikasi yang efektif bagi masyarakat luas.</p>
                    <p>Di tengah era perkembangan teknologi dan dinamika global yang begitu cepat, lembaga kami berkomitmen untuk terus meningkatkan kualitas penyelenggaraan pendidikan—baik formal maupun non-formal—agar mampu menghasilkan lulusan yang tidak hanya unggul dalam bidang ilmu pengetahuan, tetapi juga memiliki keteguhan iman dan akhlakul karimah.</p>
                    <p>Kami mengucapkan terima kasih yang sebesar-besarnya kepada seluruh orang tua/wali santri serta masyarakat yang telah mempercayakan pendidikan putra-putrinya kepada lembaga kami. Mari bersama-sama kita wujudkan generasi masa depan yang cerdas, berkarakter, dan berdaya saing.</p>
                    <blockquote>"Bersama membangun mutu pendidikan yang berlandaskan nilai-nilai Islam demi masa depan generasi bangsa yang gemilang."</blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
@endsection
