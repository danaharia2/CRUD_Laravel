<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodi;
use App\Models\Matakuliah;
use App\Models\DetailMahasiswa;

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

    public function mataKuliahs()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_mata_kuliah')
            ->withPivot('semester')
            ->withTimestamps();
    }

    public function detailMahasiswa()
    {
        return $this->hasOne(DetailMahasiswa::class);
    }
    
}
