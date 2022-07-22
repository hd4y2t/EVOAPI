<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';

    protected $fillable = [
        'id_lokasi',
        'nama',
        'alamat',
        'hp',
        'inisial_faktur',
    ];

}
