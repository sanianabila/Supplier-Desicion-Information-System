@extends('layouts.app')

@section('content')
    <h1>Tambah Kriteria</h1>
    <form action="{{ route('criteria.store') }}" method="POST">
        @csrf
        <div>
            <label>Kode Kriteria:</label>
            <input type="text" name="kode_kriteria" required>
        </div>
        <div>
            <label>Nama Kriteria:</label>
            <input type="text" name="nama_kriteria" required>
        </div>
        <div>
            <label>Nilai Kriteria:</label>
            <input type="number" name="nilai_kriteria" required>
        </div>
        <div>
            <label>Tipe Kriteria:</label>
            <select name="tipe_kriteria" required>
                <option value="Benefit">Benefit</option>
                <option value="Cost">Cost</option>
            </select>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
