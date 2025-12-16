<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <br>
    <a href="{{ route('mahasiswas.index') }}">Daftar Mahasiswa</a>
    <br><br>
    <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" placeholder="Nim Mahasiswa">
        <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" placeholder="Nama Mahasiswa">
        {{-- <input type="text" name="prodi" value="{{ old('prodi', $mahasiswa->prodi) }}" placeholder="Prodi"> --}}
        <select name="prodi_id" class="form_select">
            @foreach($prodis as $prodi)
            <option value="{{ $prodi->id }}"
                {{ old('prodi_id', $mahasiswa->prodi_id) == $prodi->id ? 'select' : ''}}>
                {{ $prodi->nama }}
            </option>
            @endforeach
        </select>
        <select name="mata_kuliahs[]" class="form_select" multiple>
            @foreach($mataKuliahs as $mk)
            <option value="{{ $mk->id }}"
                {{ $mahasiswa->mataKuliahs->contains($mk->id) ? 'select' : ''}}>
                {{ $mk->nama }}
            </option>
            @endforeach
        </select>
        <input type="text" name="tahun_angkatan" value="{{ old('tahun_angkatan', $mahasiswa->tahun_angkatan) }}" placeholder="Tahun Angkatan">
        <button type="submit">Update Mahasiswa</button>
        <button type="reset">Reset Mahasiswa</button>
    </form>
</body>
</html>