<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Supplier;
use App\Models\DecisionMatrix;
use Illuminate\Http\Request;

class MatrixController extends Controller
{
    public function index()
{
    // Ambil data matriks keputusan yang sudah ada
    $decisionMatrix = DecisionMatrix::with('alternative.supplier')->get();

    // Ambil data kriteria
    $criteria = Criteria::all();

    // Ambil alternatif yang belum dimasukkan ke matriks
    $availableAlternatives = Alternative::whereDoesntHave('decisionMatrix')
        ->selectRaw('MIN(id) as id, supplier_id') // Pilih alternatif pertama per supplier_id
        ->groupBy('supplier_id')
        ->with('supplier') // Ambil relasi supplier
        ->get();

    // Ambil data alternatif berdasarkan matriks dan kriteria
    $alternativesData = [];
    foreach ($decisionMatrix as $matrix) {
        foreach ($criteria as $criterion) {
            $alternative = Alternative::where('supplier_id', $matrix->alternative->supplier_id)
                ->where('criteria_id', $criterion->id)
                ->first();

            $alternativesData[$matrix->id][$criterion->id] = $alternative ? $alternative->weight->nilai_bobot : '-';
        }
    }

    return view('matriks.index', compact('decisionMatrix', 'criteria', 'availableAlternatives', 'alternativesData'));
}

    

    public function store(Request $request)
    {
        $request->validate([
            'alternative_id' => 'required|exists:alternatives,id|unique:decision_matrix,alternative_id',
        ]);

        DecisionMatrix::create(['alternative_id' => $request->alternative_id]);

        return redirect()->route('matriks.index')->with('success', 'Matriks Keputusan berhasil ditambahkan.');
    }

    public function edit($id)
{
    $decisionMatrix = DecisionMatrix::findOrFail($id);

    // Ambil alternatif yang belum dimasukkan ke matriks
    $availableAlternatives = Alternative::whereDoesntHave('decisionMatrix')
        ->selectRaw('MIN(id) as id, supplier_id') // Pilih alternatif pertama per supplier_id
        ->groupBy('supplier_id')
        ->with('supplier') // Ambil relasi supplier
        ->get();

    return view('matriks.edit', compact('decisionMatrix', 'availableAlternatives'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'alternative_id' => 'required|exists:alternatives,id',
        ]);

        $decisionMatrix = DecisionMatrix::findOrFail($id);
        $decisionMatrix->update(['alternative_id' => $request->alternative_id]);

        return redirect()->route('matriks.index')->with('success', 'Matriks Keputusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $decisionMatrix = DecisionMatrix::findOrFail($id);
        $decisionMatrix->delete();

        return redirect()->route('matriks.index')->with('success', 'Matriks Keputusan berhasil dihapus.');
    }
}
