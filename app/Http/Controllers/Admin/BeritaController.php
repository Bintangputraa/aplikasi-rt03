<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

// Tambahkan 3 baris ini untuk memanggil fitur Firebase
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'desc')->get();
        return response()->json($berita);
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'required',
        ]);

        // 1. Simpan berita ke database MySQL
        Berita::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'konten' => $request->konten,
            'user_id' => Auth::id(),
        ]);

        // 2. Kirim Notifikasi Broadcast ke HP Warga via Firebase
        try {
            $messaging = Firebase::messaging();

            // Format penulisan baru untuk Firebase SDK versi 7 ke atas
            $pesan = CloudMessage::fromArray([
                'topic' => 'topik_warga_rt03',
                'notification' => [
                    'title' => $request->kategori . ': ' . $request->judul,
                    'body' => substr($request->konten, 0, 100) . '...'
                ],
            ]);

            $messaging->send($pesan);

        } catch (\Throwable $e) { 
            // Mengubah Exception menjadi Throwable agar SEMUA jenis error bisa ditangkap
            // tanpa memunculkan layar error merah yang menakutkan
            return redirect()->route('berita.create')->with('error', 'Berita tersimpan, tapi notifikasi gagal dikirim: ' . $e->getMessage());
        }

        // 3. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('berita.create')->with('success', 'Berita berhasil disimpan & Notifikasi terkirim ke warga!');
    }
}