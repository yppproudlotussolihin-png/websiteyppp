@extends('layouts.app')

@section('title', 'Struktur Organisasi - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<style>
        /* Penyesuaian khusus halaman Struktur Organisasi */
        .struktur-page {
            padding: 160px 10% 100px 10%;
            background: #f8fafc;
        }
        .struktur-header {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 60px auto;
        }
        .struktur-header .section-badge {
            display: inline-block;
            padding: 8px 18px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .struktur-header h2 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        .struktur-header p {
            color: #111827 !important;
            font-size: 17px;
            line-height: 1.9;
        }
        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .org-level {
            display: flex;
            justify-content: center;
            gap: 30px;
            width: 100%;
            flex-wrap: wrap;
        }
        .org-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
            text-align: center;
            min-width: 260px;
            border-top: 5px solid #16a34a;
            transition: .3s;
        }
        .org-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,.12);
        }
        .org-card.pimpinan {
            border-top-color: #f97316;
            min-width: 320px;
        }
        .org-card h3 {
            font-size: 18px;
            color: #111827;
            margin-bottom: 8px;
        }
        .org-card p {
            font-size: 15px;
            color: #111827 !important;
            font-weight: 600;
        }
        .org-card span {
            display: inline-block;
            font-size: 13px;
            color: #16a34a;
            font-weight: 600;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        @media(max-width: 768px) {
            .struktur-header h2 {
                font-size: 32px;
            }
            .org-card {
                min-width: 100%;
            }
        }
    </style>
@endpush

@section('content')
<!-- STRUKTUR ORGANISASI SECTION -->
    <section class="struktur-page">
        <div class="struktur-header" data-aos="fade-up">
            <span class="section-badge">MANAJEMEN YAYASAN</span>
            <h2>Struktur Organisasi</h2>
            <p>Bagan kepengurusan dan tata kelola Yayasan Pendidikan Pondok Pesantren Roudlotussolihin dalam mengemban misi pendidikan.</p>
        </div>

        <div class="org-chart" data-aos="fade-up">
            <!-- Pimpinan / Pendiri -->
            <div class="org-level">
                <div class="org-card pimpinan">
                    <span>Pendiri Yayasan</span>
                    <h3>KH.RM. Soleh Bajuri, S.Hi, M.Hi.</h3>
                    <p>Pembina & Pengasuh Utama</p>
                </div>
            </div>

            <!-- Ketua Yayasan -->
            <div class="org-level">
                <div class="org-card">
                    <span>Ketua Yayasan</span>
                    <h3>Ketua Yayasan YPPPRS</h3>
                    <p>Pimpinan Eksekutif Lembaga</p>
                </div>
            </div>

            <!-- Sekretaris & Bendahara -->
            <div class="org-level">
                <div class="org-card">
                    <span>Sekretaris</span>
                    <h3>Sekretariat Yayasan</h3>
                    <p>Administrasi & Kesekretariatan</p>
                </div>
                <div class="org-card">
                    <span>Bendahara</span>
                    <h3>Keuangan Yayasan</h3>
                    <p>Pengelolaan Keuangan & Aset</p>
                </div>
            </div>

            <!-- Bidang / Unit Pendidikan -->
            <div class="org-level">
                <div class="org-card">
                    <span>Pendidikan Formal</span>
                    <h3>Koordinator Formal</h3>
                    <p>RA, MI, MTs, & SMA Ma'arif</p>
                </div>
                <div class="org-card">
                    <span>Pendidikan Non-Formal</span>
                    <span>& Pesantren</span>
                    <h3>Koordinator Non-Formal</h3>
                    <p>Madrasah Diniyah & Tahfidz</p>
                </div>
                <div class="org-card">
                    <span>Sarana & Prasarana</span>
                    <h3>Bidang Sarpras</h3>
                    <p>Fasilitas & Pengembangan Unit</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
@endsection
