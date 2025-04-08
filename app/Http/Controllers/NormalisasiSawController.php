<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;

class NormalisasiSawController extends Controller
{
    public function normalisasi()
    {
        // Ambil semua kriteria
        $criteria = Criteria::all();

        // Ambil semua alternatif
        $alternatives = Alternative::with(['supplier', 'weight'])->get();

        // Hitung nilai normalisasi untuk setiap alternatif berdasarkan tipe kriteria
        $normalizedData = [];
        foreach ($criteria as $criterion) {
            // Ambil nilai bobot berdasarkan kriteria
            $values = $alternatives->where('criteria_id', $criterion->id)->pluck('weight.nilai_bobot');

            // Hitung Max atau Min sesuai tipe kriteria
            $extremeValue = $criterion->tipe_kriteria === 'Benefit' ? $values->max() : $values->min();

            foreach ($alternatives as $alternative) {
                if ($alternative->criteria_id == $criterion->id) {
                    // Ambil nilai asli (pembilang)
                    $originalValue = $alternative->weight->nilai_bobot;

                    // Hitung normalisasi
                    $normalizedValue = $criterion->tipe_kriteria === 'Benefit'
                        ? $originalValue / $extremeValue  // Untuk 'Benefit', nilai alternatif dibagi nilai max
                        : $extremeValue / $originalValue; // Untuk 'Cost', nilai min dibagi nilai alternatif

                    // Simpan data pembilang, penyebut, dan hasil
                    $normalizedData[$alternative->supplier_id][$criterion->id] = [
                        'pembilang' => $criterion->tipe_kriteria === 'Benefit' ? $originalValue : $extremeValue, // Benefit pembilangnya adalah nilai alternatif
                        'penyebut' => $criterion->tipe_kriteria === 'Benefit' ? $extremeValue : $originalValue, // Benefit penyebutnya adalah nilai max
                        'hasil' => round($normalizedValue, 2),
                    ];
                }
            }
        }

        // Kirim data ke view
        return view('hitungsaw.normalisasi', compact('criteria', 'alternatives', 'normalizedData'));
    }
}
