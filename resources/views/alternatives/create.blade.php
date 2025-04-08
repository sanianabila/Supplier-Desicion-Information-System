@extends('layouts.app')

@section('content')
    <h1>Tambah Alternatif</h1>
    <form action="{{ route('alternatives.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Supplier:</label>
            <select name="supplier_id" required>
                <option value="" disabled selected>Pilih Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                @endforeach
            </select>
        </div>

        <h3>Pilih Nama Bobot untuk Setiap Kriteria:</h3>
        @foreach ($criteria as $criterion)
            <div>
                <label>{{ $criterion->nama_kriteria }}:</label>
                <input type="hidden" name="criteria[{{ $loop->index }}][id]" value="{{ $criterion->id }}">
                <select name="criteria[{{ $loop->index }}][weight_id]" required>
                    <option value="" disabled selected>Pilih Bobot</option>
                    @foreach ($criterion->weights as $weight)
                        <option value="{{ $weight->id }}">{{ $weight->nama_bobot }} - Nilai: {{ $weight->nilai_bobot }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <button type="submit">Simpan</button>
    </form>
@endsection
