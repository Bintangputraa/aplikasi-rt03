<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Panggil semua Model yang sudah kita buat
use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Galeri;
use App\Models\Profil;

class ApiController extends Controller
{
    // API untuk mengambil daftar berita & lelayu
    public function getBerita()
    {
        // Ambil berita dari yang paling baru (descending)
        $data = Berita::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'pesan' => 'Data berita berhasil diambil',
            'data' => $data
        ]);
    }

    // API untuk mengambil jadwal kegiatan
    public function getKegiatan()
    {
        // Ambil kegiatan diurutkan berdasarkan waktu pelaksanaan terdekat
        $data = Kegiatan::orderBy('waktu_pelaksanaan', 'asc')->get();
        
        return response()->json([
            'status' => 'success',
            'pesan' => 'Data kegiatan berhasil diambil',
            'data' => $data
        ]);
    }

    // API untuk mengambil galeri foto & video
    public function getGaleri()
    {
        $data = Galeri::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'pesan' => 'Data galeri berhasil diambil',
            'data' => $data
        ]);
    }

    // API untuk mengambil profil dan struktur RT
    public function getProfil()
    {
        $data = Profil::all();
        
        return response()->json([
            'status' => 'success',
            'pesan' => 'Data profil berhasil diambil',
            'data' => $data
        ]);
    }
}