<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mahasiswa</title>
</head>
<body>
    <br>
    <a href="{{ route('mahasiswas.create') }}">Tambah Mahasiswa</a>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>Nim</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Tahun Angkatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswas as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->nim }}</td>
                <td>{{ $mahasiswa->nama }}</td>
                {{-- <td>{{ $mahasiswa->prodi }}</td> --}}
                <td>{{ $mahasiswa->prodi->nama }}</td>
                <td>{{ $mahasiswa->tahun_angkatan }}</td>
                <td>
                    <form onsubmit="return confirm('Apakah Anda Yakin Dihapus ?');" action="{{ route('mahasiswas.destroy', $mahasiswa->id) }}" method="POST">
                        <a href="{{ route('mahasiswas.edit', $mahasiswa->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty 
            <div>
                Data tidak tersedia!
            </div>
            @endforelse
        </tbody>
    </table>
</body>
</html>