@extends('layouts.app')

@section('content')
    <h1>Tambah Supplier</h1>
    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div>
            <label>Kode Supplier:</label>
            <input type="text" name="kode_nama_supplier" required>
        </div>
        <div>
            <label>Nama Supplier:</label>
            <input type="text" name="nama_supplier" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection
