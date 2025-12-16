<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Prodi extends Model
{
    protected $fillable = ['kode', 'nama'];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
