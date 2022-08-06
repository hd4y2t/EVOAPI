<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COA extends Model
{
    use HasFactory;

    protected $table = 'coa';

    protected $fillable = [
        'kode_account',
        'nama',
        'posisi',
        'letak',
        'jns',
        'lokasi_id',
        'aktif',
        'pakai_budget',
        'lama_budget_harian',
        'lama_budget_bulanan',
        'budget_harian',
        'budget_bulanan',
        'flag_khusus',
        'kategori_id',
    ];

     public function kategori_coa(){
        return $this->belongsTo(KategoriCOA::class,'kategori_id','id_kategori_coa');
    }
}
