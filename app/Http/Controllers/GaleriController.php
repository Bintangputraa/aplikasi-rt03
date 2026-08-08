<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    // Untuk API Android (Menampilkan foto berdasarkan ID Album)
    public function getMediaByAlbum($id)
    {
        $media = Galeri::where('album_id', $id)->get();
        return response()->json($media);
    }

    // --- TAMBAHKAN INI UNTUK ADMIN WEB ---
    public function store(Request $request)
    {
        // 1. Validasi input (Wajib memilih album dan mengunggah file)
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'file_media' => 'required|image|mimes:jpeg,png,jpg,mp4|max:5120' // Bisa foto atau video
        ]);

        // 2. Proses upload file media
        if ($request->hasFile('file_media')) {
            $file = $request->file('file_media');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/galeri_media'), $namaFile);
            $urlMedia = asset('storage/galeri_media/' . $namaFile);

            // 3. Simpan ke tabel galeris dengan menyertakan album_id
            Galeri::create([
                'album_id' => $request->album_id,
                'file_media' => $urlMedia
            ]);
        }

        return redirect()->back()->with('success', 'Foto/Video berhasil ditambahkan ke album!');
    }
}