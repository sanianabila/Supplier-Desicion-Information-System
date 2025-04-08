<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\Supplier;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        // Ambil semua kriteria
        $criteria = Criteria::all();

        // Ambil semua alternatif
        $alternatives = Alternative::with(['supplier', 'weight'])->get();

        // Hitung nilai normalisasi bobot dan total skor
        $totalScores = []; // Menyimpan total nilai untuk setiap alternatif

        foreach ($criteria as $criterion) {
            // Ambil nilai bobot berdasarkan kriteria
            $values = $alternatives->where('criteria_id', $criterion->id)->pluck('weight.nilai_bobot');

            // Hitung Max atau Min sesuai tipe kriteria
            $extremeValue = $criterion->tipe_kriteria === 'Benefit' ? $values->max() : $values->min();

            foreach ($alternatives as $alternative) {
                if ($alternative->criteria_id == $criterion->id) {
                    // Hitung normalisasi dan bulatkan ke dua desimal
                    $normalizedValue = $criterion->tipe_kriteria === 'Benefit'
                        ? round($alternative->weight->nilai_bobot / $extremeValue, 2)
                        : round($extremeValue / $alternative->weight->nilai_bobot, 2);

                    // Hitung normalisasi bobot (menggunakan nilai bulat normalisasi)
                    $normalizedWeight = $normalizedValue * $criterion->nilai_kriteria;

                    // Tambahkan ke total score alternatif
                    if (!isset($totalScores[$alternative->supplier_id])) {
                        $totalScores[$alternative->supplier_id] = 0;
                    }
                    $totalScores[$alternative->supplier_id] += $normalizedWeight;
                }
            }
        }

        // Urutkan hasil total score secara descending untuk menentukan ranking
        arsort($totalScores);

        // Kirim data ke view
        return view('ranking.index', compact('totalScores'));
    }
}
