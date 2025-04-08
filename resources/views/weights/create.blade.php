@extends('layouts.app')

@section('content')
    <h1>Tambah Bobot</h1>
    <form action="{{ route('weights.store') }}" method="POST">
        @csrf
        <div>
            <label>Kriteria:</label>
            <select name="criteria_id" required>
                @foreach ($criteria as $criterion)
                    <option value="{{ $criterion->id }}">{{ $criterion->nama_kriteria }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Nama Bobot:</label>
            <input type="text" name="nama_bobot" required>
        </div>
        <div>
            <label>Nilai Bobot:</label>
            <input type="number" step="0.01" name="nilai_bobot" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
