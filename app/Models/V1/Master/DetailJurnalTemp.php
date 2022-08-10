<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJurnalTemp extends Model
{
    use HasFactory;
     protected $table = 'detail_jurnal_temp';

    protected $fillable = [
        'jurnal_id',
        'coa_id',
        'keterangan',
        'debit',
        'kredit',
    ];
}
