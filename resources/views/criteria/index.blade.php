@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Daftar Kriteria</h1>
    
    <a href="{{ route('criteria.create') }}" class="btn btn-add">Tambah Kriteria</a>
    
    <table>
        <thead>
            <tr>
                <th>Kode Kriteria</th>
                <th>Nama Kriteria</th>
                <th>Nilai Kriteria</th>
                <th>Tipe Kriteria</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($criteria as $criterion)
                <tr>
                    <td>{{ $criterion->kode_kriteria }}</td>
                    <td>{{ $criterion->nama_kriteria }}</td>
                    <td>{{ $criterion->nilai_kriteria }}</td>
                    <td>{{ $criterion->tipe_kriteria }}</td>
                    <td>
                        <a href="{{ route('criteria.edit', $criterion->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('criteria.destroy', $criterion->id) }}" method="POST" style="display:inline-block;">
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
