<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Yayasan Pendidikan Pondok Pesantren Roudlotussolihin
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/informasi', [WebController::class, 'informasi'])->name('informasi');
Route::get('/pengumuman', [WebController::class, 'pengumuman'])->name('pengumuman');
Route::get('/unit-industri', [WebController::class, 'unitIndustri'])->name('unit-industri');

// Halaman Tentang
Route::prefix('tentang')->name('tentang.')->group(function () {
    Route::get('/{page}', [WebController::class, 'tentang'])->name('show');
});

// Halaman Fasilitas
Route::prefix('fasilitas')->name('fasilitas.')->group(function () {
    Route::get('/{slug}', [WebController::class, 'fasilitas'])->name('show');
});

// Halaman Unit Pendidikan (Akademik)
Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('/formal/{slug}', [WebController::class, 'akademikFormal'])->name('formal');
    Route::get('/non-formal/{slug}', [WebController::class, 'akademikNonFormal'])->name('non-formal');
});

// Halaman Kelembagaan
Route::prefix('kelembagaan')->name('kelembagaan.')->group(function () {
    Route::get('/{slug}', [WebController::class, 'kelembagaan'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Backward Compatibility Redirects (for old .html links)
|--------------------------------------------------------------------------
*/
Route::redirect('/index.html', '/');
Route::redirect('/informasi.html', '/informasi');
Route::redirect('/pengumuman.html', '/pengumuman');
Route::redirect('/unit-industri.html', '/unit-industri');

Route::get('/tentang/{page}.html', function ($page) {
    return redirect("/tentang/{$page}");
});

Route::get('/fasilitas/{slug}.html', function ($slug) {
    return redirect("/fasilitas/{$slug}");
});

Route::get('/assets/akademik/formal/{slug}.html', function ($slug) {
    return redirect("/akademik/formal/{slug}");
});

Route::get('/assets/akademik/non formal/{slug}.html', function ($slug) {
    return redirect("/akademik/non-formal/{slug}");
});

Route::get('/assets/akademik/non-formal/{slug}.html', function ($slug) {
    return redirect("/akademik/non-formal/{slug}");
});

Route::redirect('/assets/kelembagaan/iktsaro.html', '/kelembagaan/iktsaro');
