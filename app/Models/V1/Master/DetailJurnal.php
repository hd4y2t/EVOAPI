<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJurnal extends Model
{
    use HasFactory;
    protected $table = 'detail_jurnal';

    protected $fillable = [
        'jurnal_id',
        'coa_id',
        'user_id',
        'keterangan',
        'debit',
        'kredit'
    ];
}
