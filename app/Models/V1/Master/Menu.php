<?php

namespace App\Models\V1\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{    
    use HasFactory;
    protected $table = 'menu';

    protected $fillable = [
        'nama',
        'route'
     ];
}
