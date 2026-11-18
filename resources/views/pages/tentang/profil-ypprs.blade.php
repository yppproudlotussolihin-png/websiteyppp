@extends('layouts.app')

@section('title', 'Profil YPPPRS - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin')

@push('styles')
<style>
        /* Tambahan style khusus untuk teks profil agar hitam pekat */
        .profil-content p {
            color: #111827 !important;
            margin-bottom: 20px;
            line-height: 1.9;
        }
    </style>
@endpush

@section('content')
<!-- PROFIL YPPPRS SECTION -->
    <section class="tentang-yayasan" style="padding-top: 160px;">
        <div class="container">
            <div class="tentang-header" data-aos="fade-up">
                <span class="section-badge">PROFIL YPPPRS</span>
                <h2>Mengenal Lebih Dekat Yayasan Pendidikan Pondok Pesantren Roudlotussolihin</h2>
                <p>Pusat pengembangan ilmu keislaman, pembentukan karakter, dan pencetak generasi unggul yang berdaya saing global.</p>
            </div>
            <div class="tentang-wrapper">
                <div class="tentang-image" data-aos="fade-right">
                    <img src="{{ asset('assets/images/hero5.jpeg') }}" alt="Profil Yayasan">
                </div>
                <div class="tentang-content profil-content" data-aos="fade-left">
                    <span class="mini-title">Profil Lembaga</span>
                    <h3 style="color: #111827;">Integritas, Inovasi, & Kepedulian Umat</h3>
                    <p>Yayasan Pendidikan Pondok Pesantren Roudlotussolihin (YPPPRS) merupakan lembaga yang bergerak secara konsisten di bidang pendidikan, keagamaan, serta sosial kemasyarakatan. Berdiri sejak tahun 1989, yayasan ini terus beradaptasi dengan perkembangan zaman tanpa meninggalkan akar nilai-nilai tradisi Ahlussunnah wal Jamaah.</p>
                    <p>Dalam menjalankan operasionalnya, YPPPRS menaungi berbagai lembaga pendidikan formal mulai dari jenjang RA, MI, MTs, hingga SMA, serta lembaga pendidikan non-formal berupa Madrasah Diniyah dan Pondok Pesantren Tahfidzul Qur'an.</p>
                    <div class="tentang-list">
                        <div class="list-item" style="color: #111827;"><i class="fas fa-check-circle"></i> Legalitas Resmi & Terakreditasi</div>
                        <div class="list-item" style="color: #111827;"><i class="fas fa-check-circle"></i> Lingkungan Asri & Islami</div>
                        <div class="list-item" style="color: #111827;"><i class="fas fa-check-circle"></i> Tenaga Pendidik Berkompeten</div>
                        <div class="list-item" style="color: #111827;"><i class="fas fa-check-circle"></i> Pengembangan Bakat & Minat</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->

<!-- Library Scripts -->
    
    
    <!-- Script Utama Bawaan Web -->
@endsection
