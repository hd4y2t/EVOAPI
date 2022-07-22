<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriCOA extends Model
{
    use HasFactory;

    protected $table = 'kategori_coa';
    protected $fillable = [
        'nama',
    ];
}
