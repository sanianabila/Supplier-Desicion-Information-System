<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use App\Models\Criteria;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index()
    {
        $weights = Weight::with('criteria')->get();
        return view('weights.index', compact('weights'));
    }

    public function create()
    {
        $criteria = Criteria::all();
        return view('weights.create', compact('criteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria_id' => 'required',
            'nama_bobot' => 'required',
            'nilai_bobot' => 'required|numeric',
        ]);

        Weight::create($request->all());
        return redirect()->route('weights.index')->with('success', 'Weight created successfully.');
    }

    public function edit(Weight $weight)
    {
        $criteria = Criteria::all();
        return view('weights.edit', compact('weight', 'criteria'));
    }

    public function update(Request $request, Weight $weight)
    {
        $request->validate([
            'criteria_id' => 'required',
            'nama_bobot' => 'required',
            'nilai_bobot' => 'required|numeric',
        ]);

        $weight->update($request->all());
        return redirect()->route('weights.index')->with('success', 'Weight updated successfully.');
    }

    public function destroy(Weight $weight)
    {
        $weight->delete();
        return redirect()->route('weights.index')->with('success', 'Weight deleted successfully.');
    }
}
