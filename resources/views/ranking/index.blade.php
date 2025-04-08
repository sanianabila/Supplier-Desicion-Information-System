@extends('layouts.app')

@section('content')
    <h1>Perangkingan</h1>

    <table border="1" style="width: 100%; text-align: center; margin-top: 20px;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th>Hasil Nilai Normalisasi Bobot</th>
                <th>Peringkat</th>
            </tr>
        </thead>
        <tbody>
            @php $rank = 1; @endphp
            @foreach ($totalScores as $supplierId => $score)
                @php
                    // Ambil data supplier
                    $supplier = \App\Models\Supplier::find($supplierId);
                @endphp
                <tr>
                    <td>{{ $rank }}</td>
                    <td>{{ $supplier->kode_nama_supplier }}</td>
                    <td>{{ $supplier->nama_supplier }}</td>
                    <td>{{ round($score, 3) }}</td>
                    <td>{{ $rank++ }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
