<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'nilai_kriteria',
        'tipe_kriteria',
    ];

    protected $table = 'criteria'; // Nama tabel disesuaikan dengan nama tabel di database

    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class, 'criteria_id');
    }

}
