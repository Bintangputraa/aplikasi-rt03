<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Galeri;

class PublicController extends Controller
{
    public function index()
    {
        // Ambil 3 berita terbaru
        $berita = Berita::orderBy('created_at', 'desc')->take(3)->get();
        
        // Ambil 3 kegiatan terdekat yang waktu pelaksanaannya hari ini atau ke depan
        $kegiatan = Kegiatan::where('waktu_pelaksanaan', '>=', now())
                            ->orderBy('waktu_pelaksanaan', 'asc')
                            ->take(3)->get();
        
        // Ambil 4 galeri terbaru
        $galeri = Galeri::orderBy('created_at', 'desc')->take(4)->get();

        return view('welcome', compact('berita', 'kegiatan', 'galeri'));
    }
}