<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        // Validasi: pilih salah satu, wajib ada album_id
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'file_media' => 'nullable|file|mimes:jpeg,png,jpg,mp4|max:5120', // Opsional jika pakai link
            'link_url' => 'nullable|string' // Input teks untuk link Google Drive / Video
        ]);

        $urlMedia = '';

        // Jika admin mengunggah file fisik
        if ($request->hasFile('file_media')) {
            $file = $request->file('file_media');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/galeri_media'), $namaFile);
            $urlMedia = asset('storage/galeri_media/' . $namaFile);
        }
        // Jika admin memasukkan link (Google Drive / YouTube / dll)
        elseif ($request->filled('link_url')) {
            $urlMedia = $request->link_url;
        }

        // Pastikan ada media yang dimasukkan
        if (!empty($urlMedia)) {
            Galeri::create([
                'album_id' => $request->album_id,
                'file_media' => $urlMedia
            ]);
        }

        return redirect()->back()->with('success', 'Media berhasil ditambahkan ke album!');
    }
}
