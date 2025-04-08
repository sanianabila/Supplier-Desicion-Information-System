@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Daftar Bobot</h1>
    <a href="{{ route('weights.create') }}" class="btn btn-add">Tambah Bobot</a>

    <table>
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Nama Bobot</th>
                <th>Nilai Bobot</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weights as $weight)
                <tr>
                    <td>{{ $weight->criteria->nama_kriteria }}</td>
                    <td>{{ $weight->nama_bobot }}</td>
                    <td>{{ $weight->nilai_bobot }}</td>
                    <td>
                        <a href="{{ route('weights.edit', $weight->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('weights.destroy', $weight->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
