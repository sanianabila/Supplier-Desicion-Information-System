@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Selamat Datang</h2>
    <p>
        Sistem ini menggunakan metode SAW (Simple Additive Weighting) untuk membantu pemilihan supplier terbaik.
    </p>
</div>

<div class="card">
    <h3>Statistik</h3>
    <div style="display: flex; gap: 20px;">
        <div class="card" style="flex: 1; text-align: center; background: #007bff; color: #fff;">
            <h4>Supplier</h4>
            <p>{{ $supplierCount }}</p>
        </div>
        <div class="card" style="flex: 1; text-align: center; background: #28a745; color: #fff;">
            <h4>Kriteria</h4>
            <p>{{ $criteriaCount }}</p>
        </div>
    </div>
</div>

<div class="card">
    <h3>Penjelasan Metode SAW</h3>
    <p>
        Metode SAW (Simple Additive Weighting) digunakan untuk mencari total skor alternatif terbaik dengan menjumlahkan hasil perkalian rating kinerja dan bobot kriteria yang telah dinormalisasi. Langkah penyelesaiannya:
    </p>
    <ol>
        <li>Menentukan kriteria dan bobot (Wi) sebagai acuan keputusan.</li>
        <li>Menentukan rating kecocokan alternatif terhadap setiap kriteria.</li>
        <li>Melakukan normalisasi matriks sesuai jenis atribut (benefit atau cost).</li>
        <li>Menghitung nilai preferensi (Vi) dengan menjumlahkan hasil kali matriks normalisasi dan bobot kriteria.</li>
        <li>Alternatif dengan nilai preferensi terbesar menjadi pilihan terbaik.</li>
    </ol>
</div>
@endsection
