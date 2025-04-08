<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();
        return view('criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'nilai_kriteria' => 'required|integer',
            'tipe_kriteria' => 'required',
        ]);

        Criteria::create($request->all());
        return redirect()->route('criteria.index')->with('success', 'Criteria created successfully.');
    }

    public function edit(Criteria $criterion)
    {
        return view('criteria.edit', compact('criterion'));
    }

    public function update(Request $request, Criteria $criterion)
    {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'nilai_kriteria' => 'required|integer',
            'tipe_kriteria' => 'required',
        ]);

        $criterion->update($request->all());
        return redirect()->route('criteria.index')->with('success', 'Criteria updated successfully.');
    }

    public function destroy(Criteria $criterion)
    {
        $criterion->delete();
        return redirect()->route('criteria.index')->with('success', 'Criteria deleted successfully.');
    }
}
