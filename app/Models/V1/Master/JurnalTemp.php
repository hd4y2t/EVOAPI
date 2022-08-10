<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalTemp extends Model
{
    use HasFactory;
    protected $table = 'jurnal_temp';

    protected $fillable = [
        'kode_voucher',
        'tanggal',
        'jam',
        'user_id',
        'jenis',
        'note',
        'tanggal_input'
    ];
}