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
        'inisial',
    ];

     public function coa(){
        return $this->belongsTo(COA::class,'coa_id','id_coa');
    }
}
