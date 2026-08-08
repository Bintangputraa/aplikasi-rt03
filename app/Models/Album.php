<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    // Cukup gunakan fillable saja untuk mendefinisikan kolom yang boleh diisi
    protected $fillable = [
        'judul',
        'cover_foto',
        'folder_id' // Tambahkan ini
    ];

    // Menyambungkan Album dengan Galeri
    public function galeris()
    {
        return $this->hasMany(Galeri::class);
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}