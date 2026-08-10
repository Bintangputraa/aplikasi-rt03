<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KegiatanController; // Tambahan baru
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua rute di dalam grup ini wajib login
Route::middleware('auth')->group(function () {

    // 1. Rute Profil Bawaan Breeze (Wajib ada agar navigasi tidak error)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Rute untuk mengelola Berita / Lelayu RT 03
    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/admin/berita/tambah', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/admin/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/api/album', [AlbumController::class, 'index'])
    Route::get('/api/kegiatan', [KegiatanController::class, 'index'])

    // Rute Kegiatan
    Route::get('/admin/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/admin/kegiatan/tambah', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/admin/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');

    Route::get('/admin/album', [AlbumController::class, 'index'])->name('admin.album');
    Route::get('/admin/album/tambah', [AlbumController::class, 'create'])->name('admin.album.create');
    Route::post('/admin/album', [AlbumController::class, 'store'])->name('admin.album.store');

    Route::get('/admin/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
    Route::get('/admin/galeri/tambah', [GaleriController::class, 'create'])->name('admin.galeri.create');
    Route::post('/admin/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');

});

require __DIR__ . '/auth.php';
