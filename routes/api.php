<?php

use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Rute khusus untuk melayani permintaan dari aplikasi Android Warga
Route::get('/berita', function () {
    // Mengambil data berita, diurutkan dari yang terbaru, dan dikirim sebagai Array murni
    return \App\Models\Berita::orderBy('created_at', 'desc')->get();
});
Route::get('/kegiatan', [AdminKegiatanController::class, 'index']);
Route::get('/album', [AlbumController::class, 'index']);
Route::get('/album/{id}/media', [GaleriController::class, 'getMediaByAlbum']);
Route::get('/profil', [ApiController::class, 'getProfil']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);