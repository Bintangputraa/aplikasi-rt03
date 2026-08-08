<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::orderBy('created_at', 'desc')->get();
        return response()->json($albums);
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'cover_foto' => 'required|image|mimes:jpeg,png,jpg',
            'link_folder' => 'required|string'
        ]);

        // 1. Ekstrak / Ambil ID Folder dari Link panjang Google Drive
        $link = $request->link_folder;
        $folderId = '';
        
        // Logika pemotong link drive
        if (preg_match('/folders\/([a-zA-Z0-9_-]+)/', $link, $matches)) {
            $folderId = $matches[1];
        } elseif (preg_match('/id=([a-zA-Z0-9_-]+)/', $link, $matches)) {
            $folderId = $matches[1];
        } else {
            return redirect()->back()->with('error', 'Link Folder Google Drive tidak valid!');
        }

        // 2. Upload Cover
        if ($request->hasFile('cover_foto')) {
            $file = $request->file('cover_foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/album_covers'), $namaFile);
            $urlCover = asset('storage/album_covers/' . $namaFile);

            // 3. Simpan Judul, Cover, dan ID Folder ke Database
            Album::create([
                'judul' => $request->judul,
                'cover_foto' => $urlCover,
                'folder_id' => $folderId
            ]);
        }

        return redirect()->route('admin.album.create')->with('success', 'Album berhasil dibuat dan ditautkan ke Google Drive!');
    }
}