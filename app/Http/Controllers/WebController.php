<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class WebController extends Controller
{
    /**
     * Halaman Utama (Beranda)
     */
    public function home(): View
    {
        return view('pages.home');
    }

    /**
     * Halaman Informasi / Pendaftaran PPDB
     */
    public function informasi(): View
    {
        return view('pages.informasi');
    }

    /**
     * Halaman Pengumuman
     */
    public function pengumuman(): View
    {
        return view('pages.pengumuman');
    }

    /**
     * Halaman Unit Industri
     */
    public function unitIndustri(): View
    {
        return view('pages.unit-industri');
    }

    /**
     * Halaman Tentang Yayasan
     */
    public function tentang(string $page): View
    {
        $view = 'pages.tentang.' . strtolower(str_replace('.html', '', $page));

        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }

    /**
     * Halaman Fasilitas
     */
    public function fasilitas(string $slug): View
    {
        $view = 'pages.fasilitas.' . strtolower(str_replace('.html', '', $slug));

        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }

    /**
     * Halaman Akademik Formal
     */
    public function akademikFormal(string $slug): View
    {
        $view = 'pages.akademik.formal.' . strtolower(str_replace('.html', '', $slug));

        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }

    /**
     * Halaman Akademik Non Formal
     */
    public function akademikNonFormal(string $slug): View
    {
        $view = 'pages.akademik.non-formal.' . strtolower(str_replace('.html', '', $slug));

        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }

    /**
     * Halaman Kelembagaan
     */
    public function kelembagaan(string $slug): View
    {
        $view = 'pages.kelembagaan.' . strtolower(str_replace('.html', '', $slug));

        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }
}

