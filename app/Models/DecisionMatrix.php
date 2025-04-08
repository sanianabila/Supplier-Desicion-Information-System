<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionMatrix extends Model
{
    use HasFactory;

    protected $table = 'decision_matrix'; // Nama tabel di database
    protected $fillable = ['alternative_id']; // Kolom yang bisa diisi secara massal

    public function alternative()
    {
        return $this->belongsTo(Alternative::class, 'alternative_id');
    }
    
}
