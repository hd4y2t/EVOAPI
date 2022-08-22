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
        'kredit',
        'flag_dari_atas'
    ];
      public function coa(){
        return $this->belongsTo(COA::class,'coa_id','id_coa');
    }
      public function jurnal(){
        return $this->belongsTo(Jurnal::class,'jurnal_id','id_jurnal');
    }
}
