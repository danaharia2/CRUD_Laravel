<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class MataKuliah extends Model
{
    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_mata_kuliah')
            ->withPivot('semester', 'tahun', 'nilai_-uts', 'nilai_uas', 'nilai_akhir')
            ->withTimestamps();
    }
}
