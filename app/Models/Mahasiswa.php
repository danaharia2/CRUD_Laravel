<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodi;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'tahun_angkatan',
        'prodi_id',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
