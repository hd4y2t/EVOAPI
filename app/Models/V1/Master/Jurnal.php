<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    protected $table = 'jurnal';

    protected $fillable = [
        'kode_voucher',
        'tanggal',
        'jam',
        'user_id',
        'jenis',
        'note'
    ];

    public function User(){
        return $this->belongsTo(User::class,'id', 'user');
    }
}