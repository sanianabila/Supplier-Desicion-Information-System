@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">Daftar Alternatif</h1>
    <a href="{{ route('alternatives.create') }}" class="btn btn-add">Tambah Alternatif</a>

    @if ($suppliers->isEmpty())
        <p class="no-data-message">Belum ada data alternatif. Silakan tambahkan data melalui tombol <b>Tambah Alternatif</b>.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nama Supplier</th>
                    @foreach ($criteria as $criterion)
                        <th>{{ $criterion->nama_kriteria }}</th>
                    @endforeach
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->nama_supplier }}</td>
                        @foreach ($criteria as $criterion)
                            @php
                                $alternative = $supplier->alternatives->firstWhere('criteria_id', $criterion->id);
                            @endphp
                            <td>
                                @if ($alternative)
                                    {{ $alternative->weight->nama_bobot }} ({{ $alternative->weight->nilai_bobot }})
                                @else
                                    -
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <a href="{{ route('alternatives.edit', $supplier->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('alternatives.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus semua data alternatif untuk supplier ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
