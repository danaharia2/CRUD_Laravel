<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Prodi;
use App\Models\DetailMahasiswa;

class MahasiswaController extends Controller
{
    public function index() {
        // $mahasiswas = Mahasiswa::latest()->paginate(10);
        $mahasiswas = Mahasiswa::with('prodi', 'mataKuliahs', 'detailMahasiswa')->get();

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
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email_pribadi' => 'nullable|email',
            'nama_orang_tua' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:100',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        // Buat detail mahasiswa (one-to-one)
        if ($request->hasAny(['alamat', 'no_hp', 'email_pribadi', 'nama_orang_tua', 'tanggal_lahir', 'tempat_lahir'])) {
            $mahasiswa->detailMahasiswa()->create([
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email_pribadi' => $request->email_pribadi,
                'nama_orang_tua' => $request->nama_orang_tua,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tempat_lahir' => $request->tempat_lahir,
            ]);
        }

        // Attach mata kuliah (many to many)
        $mahasiswa->mataKuliahs()->attach($request->mata_kuliahs);

        return redirect()->route('mahasiswas.index')->with('sukses', 'Mahasiswa berhasil ditambahkan');
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
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email_pribadi' => 'nullable|email',
            'nama_orang_tua' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:100',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'tahun_angkatan' => $request->tahun_angkatan,
        ]);

        $detailData = [
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email_pribadi' => $request->email_pribadi,
            'nama_orang_tua' => $request->nama_orang_tua,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
        ];

        if ($mahasiswa->detailMahasiswa) {
            $mahasiswa->detailMahasiswa()->update($detailData);
        } else {
            $mahasiswa->detailMahasiswa()->create($detailData);
        }

        $mahasiswa->mataKuliahs()->sync($request->mata_kuliahs ?? []);

        return redirect()->route('mahasiswas.index')->with('sukses', 'Mahasiswa berhasil diupdate');
    }

    public function destroy($id) {
        $mahasiswa = Mahasiswa::findOrFail($id);

        //delete
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')->with('sukses', 'Mahasiswa berhasil dihapus');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('prodi', 'mataKuliahs', 'detailMahasiswa')->findOrFail($id);

        return view('mahasiswas.show', compact('mahasiswa'));
    }
}
