@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Matriks Keputusan</h1>

    <!-- Form Tambah Matriks -->
    @include('matriks.add')

    <!-- Tabel Matriks Keputusan -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Kode Supplier</th>
                @foreach ($criteria as $criterion)
                    <th>{{ $criterion->kode_kriteria }} ({{ $criterion->nama_kriteria }})</th>
                @endforeach
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($decisionMatrix as $matrix)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $matrix->alternative->supplier->nama_supplier }}</td>
                    <td>{{ $matrix->alternative->supplier->kode_nama_supplier }}</td>
                    @foreach ($criteria as $criterion)
                        <td>{{ $alternativesData[$matrix->id][$criterion->id] ?? '-' }}</td>
                    @endforeach
                    <td>
                        <a href="{{ route('matriks.edit', $matrix->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('matriks.destroy', $matrix->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Hapus matriks keputusan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
