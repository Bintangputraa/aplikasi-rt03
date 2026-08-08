<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi input dari Android
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // 3. Cek apakah user ada dan passwordnya cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'pesan' => 'Email atau Password salah!'
            ], 401); // 401 artinya Unauthorized (Ditolak)
        }

        // 4. Jika sukses, buatkan Token Sanctum
        $token = $user->createToken('TokenAndroidRT03')->plainTextToken;

        // 5. Kirim Token dan Data User kembali ke Android
        return response()->json([
            'pesan' => 'Login Berhasil',
            'token' => $token,
            'user' => [
                'nama' => $user->name,
                'email' => $user->email
            ]
        ]);
    }

    public function logout(Request $request)
    {
        // Menghapus token yang sedang digunakan saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'pesan' => 'Logout berhasil'
        ]);
    }
}
