<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mata_kuliahs')->insert([
            ['kode' => 'MK001', 'nama' => 'Metode Penelitian Ilmiah'],
            ['kode' => 'MK002', 'nama' => 'Kecerdasan Buatan'],
            ['kode' => 'MK003', 'nama' => 'Jaringan Komputer'],
            ['kode' => 'MK004', 'nama' => 'Manajemen Proyek Perangkat Lunak'],
            ['kode' => 'MK005', 'nama' => 'Pemrograman Mobile'],
            ['kode' => 'MK006', 'nama' => 'Enteprise Resource Planning'],
            ['kode' => 'MK007', 'nama' => 'Sistem Operasi'],
            ['kode' => 'MK008', 'nama' => 'Analisis dan Perancangan Sistem'],
            ['kode' => 'MK009', 'nama' => 'Pemrograman Berbasis Kerangka Kerja'],
            ['kode' => 'MK010', 'nama' => 'Etika Profesi IT'],
        ]);
    }
}
