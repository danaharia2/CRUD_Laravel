<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Prodi;

class MahasiswaController extends Controller
{
    public function index() {
        // $mahasiswas = Mahasiswa::latest()->paginate(10);
        $mahasiswas = Mahasiswa::with('prodi', 'mataKuliahs')->get();

        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create() {
        $prodis = Prodi::orderBy('nama')->get();
        $mataKuliahs = MataKuliah::orderBy('nama')->get();

        return view('mahasiswas.create', compact('prodis', 'mataKuliahs'));
    }

    public function store(Request $request) {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            // 'prodi' => 'required',
            'prodi_id' => 'required',
            'tahun_angkatan' => 'required',
            'mata_kuliahs' => 'array',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        $mahasiswa->mataKuliahs()->attach($request->mata_kuliahs);

        return redirect()->route('mahasiswas.index');
    }

    public function edit(string $id) {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodis = Prodi::orderBy('nama')->get();
        $mataKuliahs = MataKuliah::orderBy('nama')->get();

        return view('mahasiswas.edit', compact('mahasiswa', 'prodis', 'mataKuliahs'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            // 'prodi' => 'required',
            'prodi_id' => 'required',
            'tahun_angkatan' => 'required',
            'mata_kuliahs' => 'array',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        $mahasiswa->mataKuliahs()->sync($request->mata_kuliahs);

        return redirect()->route('mahasiswas.index');
    }

    public function destroy($id) {
        $mahasiswa = Mahasiswa::findOrFail($id);

        //delete
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index');
    }
}
