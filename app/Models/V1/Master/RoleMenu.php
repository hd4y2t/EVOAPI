<?php

namespace App\Models\V1\Master;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;
    protected $table = 'role_menu';

    protected $fillable = [
        'user_id',
        'menu_id'
     ];

     
     public function user(){
        return $this->hasMany(User::class,'user_id', 'id_user');
    }

     public function menu(){
        return $this->hasMany(Menu::class,'menu_id', 'id_menu');
    }
}
