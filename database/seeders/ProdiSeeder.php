<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodis')->insert([
            ['kode' => 'IF', 'nama' => 'Informatika'],
            ['kode' => 'BD', 'nama' => 'Bisnis Digital'],
            ['kode' => 'TL', 'nama' => 'Teknik Logistik'],
        ]);
    }
}
