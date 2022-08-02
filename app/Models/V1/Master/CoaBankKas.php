<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoaBankKas extends Model
{
    use HasFactory;
  protected $table = 'coa_bank_kas';

    protected $fillable = [
        'coa_id',
        'nama',
        'jenis',
        'inisial',
    ];

}
