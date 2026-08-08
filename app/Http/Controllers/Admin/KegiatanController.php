<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        // Mengambil semua data kegiatan, diurutkan dari yang paling dekat
        $kegiatan = Kegiatan::orderBy('waktu_pelaksanaan', 'asc')->get();
        
        return response()->json($kegiatan);
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'waktu_pelaksanaan' => 'required|date',
            'lokasi' => 'required',
        ]);

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kegiatan.create')->with('success', 'Jadwal Kegiatan berhasil ditambahkan!');
    }
}