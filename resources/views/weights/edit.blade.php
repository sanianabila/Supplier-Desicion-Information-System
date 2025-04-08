@extends('layouts.app')

@section('content')
    <h1>Edit Bobot</h1>
    <form action="{{ route('weights.update', $weight->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Kriteria:</label>
            <select name="criteria_id" required>
                @foreach ($criteria as $criterion)
                    <option value="{{ $criterion->id }}" {{ $weight->criteria_id == $criterion->id ? 'selected' : '' }}>
                        {{ $criterion->nama_kriteria }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Nama Bobot:</label>
            <input type="text" name="nama_bobot" value="{{ $weight->nama_bobot }}" required>
        </div>
        <div>
            <label>Nilai Bobot:</label>
            <input type="number" step="0.01" name="nilai_bobot" value="{{ $weight->nilai_bobot }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
