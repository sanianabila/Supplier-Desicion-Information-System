<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_nama_supplier',
        'nama_supplier',
    ];

    public function alternatives()
    {
        return $this->hasMany(Alternative::class, 'supplier_id', 'id');
    }
    // Relasi melalui alternatives ke criteria
    public function criteria()
    {
        return $this->hasManyThrough(Criteria::class, Alternative::class, 'supplier_id', 'id', 'id', 'criteria_id');
    }
}
