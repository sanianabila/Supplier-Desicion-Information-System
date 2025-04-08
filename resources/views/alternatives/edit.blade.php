@extends('layouts.app')

@section('content')
    <h1>Edit Alternatif untuk Supplier: {{ $supplier->nama_supplier }}</h1>
    <form action="{{ route('alternatives.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h3>Pilih Nama Bobot untuk Setiap Kriteria:</h3>
        @foreach ($criteria as $criterion)
            @php
                $alternative = $supplier->alternatives->firstWhere('criteria_id', $criterion->id);
            @endphp
            <div>
                <label>{{ $criterion->nama_kriteria }}:</label>
                <input type="hidden" name="criteria[{{ $loop->index }}][id]" value="{{ $criterion->id }}">
                <select name="criteria[{{ $loop->index }}][weight_id]" required>
                    <option value="" disabled selected>Pilih Bobot</option>
                    @foreach ($criterion->weights as $weight)
                        <option value="{{ $weight->id }}" 
                                {{ $alternative && $alternative->weight_id == $weight->id ? 'selected' : '' }}>
                            {{ $weight->nama_bobot }} - Nilai: {{ $weight->nilai_bobot }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <button type="submit">Update</button>
    </form>
@endsection
