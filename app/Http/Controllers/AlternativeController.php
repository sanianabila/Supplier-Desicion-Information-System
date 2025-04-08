<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Supplier;
use App\Models\Criteria;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::whereHas('alternatives')->get(); // Hanya tampilkan supplier dengan alternatif
        $criteria = Criteria::all(); // Semua kriteria
        return view('alternatives.index', compact('suppliers', 'criteria'));
    }

    public function create()
    {
        $suppliers = Supplier::doesntHave('alternatives')->get(); // Supplier tanpa alternatif
        $criteria = Criteria::with('weights')->get(); // Kriteria dan bobot
        return view('alternatives.create', compact('suppliers', 'criteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'criteria.*.id' => 'required|exists:criteria,id',
            'criteria.*.weight_id' => 'required|exists:weights,id',
        ]);

        foreach ($request->criteria as $criterion) {
            Alternative::updateOrCreate(
                [
                    'supplier_id' => $request->supplier_id,
                    'criteria_id' => $criterion['id'],
                ],
                [
                    'weight_id' => $criterion['weight_id'],
                ]
            );
        }

        return redirect()->route('alternatives.index')->with('success', 'Data alternatif berhasil disimpan.');
    }

    public function edit($supplier_id)
    {
        $supplier = Supplier::findOrFail($supplier_id);
        $criteria = Criteria::with('weights')->get(); // Kriteria dan bobot
        return view('alternatives.edit', compact('supplier', 'criteria'));
    }

    public function update(Request $request, $supplier_id)
    {
        $request->validate([
            'criteria.*.id' => 'required|exists:criteria,id',
            'criteria.*.weight_id' => 'required|exists:weights,id',
        ]);

        $supplier = Supplier::findOrFail($supplier_id);

        foreach ($request->criteria as $criterion) {
            Alternative::updateOrCreate(
                [
                    'supplier_id' => $supplier_id,
                    'criteria_id' => $criterion['id'],
                ],
                [
                    'weight_id' => $criterion['weight_id'],
                ]
            );
        }

        return redirect()->route('alternatives.index')->with('success', 'Data alternatif berhasil diperbarui.');
    }

    public function destroy($supplier_id)
    {
        $supplier = Supplier::findOrFail($supplier_id);
        $supplier->alternatives()->delete(); // Hapus semua alternatif terkait supplier

        return redirect()->route('alternatives.index')->with('success', 'Semua data alternatif untuk supplier ini telah dihapus.');
    }
}
