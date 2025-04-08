<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Criteria;

class DashboardController extends Controller
{
    public function index()
    {
        $supplierCount = Supplier::count();
        $criteriaCount = Criteria::count();
        $recentSuppliers = Supplier::withCount('criteria')->latest()->take(5)->get();

        return view('dashboard.index', compact('supplierCount', 'criteriaCount', 'recentSuppliers'));
    }
}
