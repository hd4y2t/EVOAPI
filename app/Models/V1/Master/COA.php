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
        'id_lokasi',
        'aktif',
        'pakai_budget',
        'lama_budget_harian',
        'lama_budget_bulan',
        'budget_harian',
        'budget_bulanan',
        'flag_khusus',
        'id_kategori_coa',
    ];
    
}
