<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mahasiswa</title>
    <style>
        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 0. 75rem;
            font-weight: 600;
            border-radius: 4px;
            margin: 2px;
            color: white;
        }
        .bg-primary {
            background-color: #0d6efd;
        }
    </style>
</head>
<body>
    <br>
    <a href="{{ route('mahasiswas.create') }}">Tambah Mahasiswa</a>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nim</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Mata Kuliah</th>
                <th>Tahun Angkatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswas as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->id }}</td>
                <td>{{ $mahasiswa->nim }}</td>
                <td>{{ $mahasiswa->nama }}</td>
                {{-- <td>{{ $mahasiswa->prodi }}</td> --}}
                <td>{{ $mahasiswa->prodi->nama }}</td>
                <td>
                    @foreach($mahasiswa->mataKuliahs as $mk)
                    <span class="badge bg-primary">{{ $mk->nama }}</span>
                    @endforeach
                </td>
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