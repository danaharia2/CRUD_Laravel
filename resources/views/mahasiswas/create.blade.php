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
        {{-- <input type="text" name="prodi" placeholder="Prodi"> --}}
        <select name="prodi_id" class="form_select">
            @foreach($prodis as $prodi)
            <option value="{{ $prodi->id }}">
                {{ $prodi->nama }}
            </option>
            @endforeach
        </select>
        <input type="text" name="tahun_angkatan" placeholder="Tahun Angkatan">
        <button type="submit">Tambah Mahasiswa</button>
    </form>
</body>
</html>