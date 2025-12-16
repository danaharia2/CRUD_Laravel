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
    <form action="{{ route('mahasiswas.store') }}" method="POST">
        @csrf
        <input type="text" name="nim" placeholder="Nim Mahasiswa">
        <input type="text" name="nama" placeholder="Nama Mahasiswa">
        <input type="text" name="alamat" value="{{ old('alamat', $mahasiswa->detailMahasiswa->alamat ?? '') }}" placeholder="alamat">
        <input type="number" name="no_hp" value="{{ old('no_hp', $mahasiswa->detailMahasiswa->no_hp ?? '') }}" placeholder="nomor hp">
        <input type="email" name="email_pribadi" value="{{ old('email_pribadi', $mahasiswa->detailMahasiswa->email_pribadi ?? '') }}" placeholder="email@gmail">
        <input type="text" name="nama_orang_tua" value="{{ old('nama_orant_tua', $mahasiswa->detailMahasiswa->nama_orant_tua ?? '') }}" placeholder="nama orangtua">
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->detailMahasiswa->tanggal_lahir ?? '') }}" placeholder="tanggal lahir">
        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->detailMahasiswa->tempat_lahir ?? '') }}" placeholder="tempat lahir">
        {{-- <input type="text" name="prodi" placeholder="Prodi"> --}}
        <select name="prodi_id" class="form_select">
            @foreach($prodis as $prodi)
            <option value="{{ $prodi->id }}">
                {{ $prodi->nama }}
            </option>
            @endforeach
        </select>
        <select name="mata_kuliahs[]" class="form_select">
            @foreach($mataKuliahs as $mk)
            <option value="{{ $mk->id }}">
                {{ $mk->nama }}
            </option>
            @endforeach
        </select>
        <input type="text" name="tahun_angkatan" placeholder="Tahun Angkatan">
        <button type="submit">Tambah Mahasiswa</button>
    </form>
</body>
</html>