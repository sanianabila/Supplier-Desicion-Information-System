<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;

class HitungSawController extends Controller
{
    public function hitungMinMax()
    {
        // Ambil semua kriteria
        $criteria = Criteria::all();

        // Menyimpan hasil min/max untuk setiap kriteria
        $results = $criteria->map(function ($criterion) {
            // Ambil nilai bobot berdasarkan tipe kriteria
            $values = Alternative::where('criteria_id', $criterion->id)
                ->with('weight')
                ->get()
                ->pluck('weight.nilai_bobot');

            if ($criterion->tipe_kriteria === 'Benefit') {
                $value = $values->max(); // Jika Benefit, ambil nilai max
            } else {
                $value = $values->min(); // Jika Cost, ambil nilai min
            }

            return [
                'kode_kriteria' => $criterion->kode_kriteria,
                'nama_kriteria' => $criterion->nama_kriteria,
                'tipe_kriteria' => $criterion->tipe_kriteria,
                'nilai' => $value,
            ];
        });

        return view('hitungsaw.hitungminmax', compact('results'));
    }
}
