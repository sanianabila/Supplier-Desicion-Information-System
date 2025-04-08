<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\MatrixController;
use App\Http\Controllers\HitungSawController;
use App\Http\Controllers\NormalisasiSawController;
use App\Http\Controllers\HitungNormalisasiBobotController;
use App\Http\Controllers\RankingController;

// Route untuk dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('suppliers', SupplierController::class);
Route::resource('criteria', CriteriaController::class);
Route::resource('weights', WeightController::class);
Route::resource('alternatives', AlternativeController::class);
Route::resource('matriks', MatrixController::class);

Route::get('/hitung-min-max', [HitungSawController::class, 'hitungMinMax'])->name('hitung.minmax');
Route::get('/normalisasi-saw', [NormalisasiSawController::class, 'normalisasi'])->name('normalisasi.saw');
Route::get('/normalisasi-bobot', [HitungNormalisasiBobotController::class, 'normalisasiBobot'])->name('normalisasi.bobot');
Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
