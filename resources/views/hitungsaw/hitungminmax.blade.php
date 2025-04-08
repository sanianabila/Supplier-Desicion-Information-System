@extends('layouts.app')

@section('content')
    <h1>Nilai Min/Max</h1>

    <table border="1" style="width: 100%; text-align: center; margin-top: 20px;">
        <thead>
            <tr>
                <th>Keterangan</th>
                @foreach ($results as $result)
                    <th>{{ $result['kode_kriteria'] }} - {{ $result['nama_kriteria'] }} [{{ $result['tipe_kriteria'] === 'Benefit' ? 'B' : 'C' }}]</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nilai Max / Min Kriteria</td>
                @foreach ($results as $result)
                    <td>{{ $result['nilai'] }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
@endsection
