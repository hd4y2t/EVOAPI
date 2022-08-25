<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalTempEdit extends Model
{
    use HasFactory;
    protected $table = 'jurnal_temp_edit';

    protected $fillable = [
        'kode_voucher',
        'tanggal',
        'jenis',
        'note',
        'id_coa_atas'
    ];
}