<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'criteria_id', 'weight_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function weight()
    {
        return $this->belongsTo(Weight::class, 'weight_id');
    }

    public function decisionMatrix()
    {
        return $this->hasOne(DecisionMatrix::class, 'alternative_id');
    }
    

}