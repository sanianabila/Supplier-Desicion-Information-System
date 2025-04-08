@extends('layouts.app')

@section('content')
    <h1>Hasil Matriks Normalisasi</h1>

    <p>[Note: B = Benefit, C = Cost]</p>

    <table border="1" style="width: 100%; text-align: center; margin-top: 20px;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Supplier</th>
                @foreach ($criteria as $criterion)
                    <th>{{ $criterion->kode_kriteria }} - {{ $criterion->nama_kriteria }} [{{ $criterion->tipe_kriteria === 'Benefit' ? 'B' : 'C' }}]</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatives->groupBy('supplier_id') as $supplierId => $groupedAlternatives)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $groupedAlternatives->first()->supplier->nama_supplier }}</td>
                    @foreach ($criteria as $criterion)
                        <td>
                            @php
                                $data = $normalizedData[$supplierId][$criterion->id] ?? null;
                            @endphp
                            @if ($data)
                                {{ $data['pembilang'] }}/{{ $data['penyebut'] }} = {{ $data['hasil'] }}
                            @else
                                -
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
