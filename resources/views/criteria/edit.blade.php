@extends('layouts.app')

@section('content')
    <h1>Edit Kriteria</h1>
    <form action="{{ route('criteria.update', $criterion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Kode Kriteria:</label>
            <input type="text" name="kode_kriteria" value="{{ $criterion->kode_kriteria }}" required>
        </div>
        <div>
            <label>Nama Kriteria:</label>
            <input type="text" name="nama_kriteria" value="{{ $criterion->nama_kriteria }}" required>
        </div>
        <div>
            <label>Nilai Kriteria:</label>
            <input type="number" name="nilai_kriteria" value="{{ $criterion->nilai_kriteria }}" required>
        </div>
        <div>
            <label>Tipe Kriteria:</label>
            <select name="tipe_kriteria" required>
                <option value="Benefit" {{ $criterion->tipe_kriteria == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                <option value="Cost" {{ $criterion->tipe_kriteria == 'Cost' ? 'selected' : '' }}>Cost</option>
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
