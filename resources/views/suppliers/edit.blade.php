@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Edit Supplier</h1>

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_nama_supplier" class="form-label">Kode Supplier:</label>
            <input type="text" id="kode_nama_supplier" name="kode_nama_supplier" class="form-control" value="{{ $supplier->kode_nama_supplier }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier:</label>
            <input type="text" id="nama_supplier" name="nama_supplier" class="form-control" value="{{ $supplier->nama_supplier }}" required>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-save">Update</button>
        </div>
    </form>
</div>
@endsection
