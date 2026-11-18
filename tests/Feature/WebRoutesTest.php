<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebRoutesTest extends TestCase
{
    public function test_home_page_returns_success(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Yayasan Pendidikan Pondok Pesantren Roudlotussolihin');
    }

    public function test_informasi_page_returns_success(): void
    {
        $response = $this->get('/informasi');
        $response->assertStatus(200);
        $response->assertSee('Formulir Pendaftaran');
    }

    public function test_pengumuman_page_returns_success(): void
    {
        $response = $this->get('/pengumuman');
        $response->assertStatus(200);
    }

    public function test_unit_industri_page_returns_success(): void
    {
        $response = $this->get('/unit-industri');
        $response->assertStatus(200);
    }

    public function test_tentang_page_returns_success(): void
    {
        $response = $this->get('/tentang/sejarah');
        $response->assertStatus(200);
    }

    public function test_fasilitas_page_returns_success(): void
    {
        $response = $this->get('/fasilitas/masjid');
        $response->assertStatus(200);
    }

    public function test_akademik_page_returns_success(): void
    {
        $response = $this->get('/akademik/formal/sma-maarif');
        $response->assertStatus(200);
    }

    public function test_kelembagaan_page_returns_success(): void
    {
        $response = $this->get('/kelembagaan/iktsaro');
        $response->assertStatus(200);
    }

    public function test_legacy_html_redirect(): void
    {
        $response = $this->get('/index.html');
        $response->assertRedirect('/');
    }
}

