<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index() {
        $mahasiswas = Mahasiswa::latest()->paginate(10);

        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create() {
        return view('mahasiswas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'tahun_angkatan' => 'required',
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        return redirect()->route('mahasiswas.index');
    }

    public function edit(string $id) {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'tahun_angkatan' => 'required',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        return redirect()->route('mahasiswas.index');
    }

    public function destroy($id) {
        $mahasiswa = Mahasiswa::findOrFail($id);

        //delete
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index');
    }
}
