<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    //de 1 para 1
    public function user(){
      return $this->hasOne(User::class,'id','users_id');  
    }

    //de 1 para muitos
    public function faltas(){
        return $this->hasMany(Falta::class);
    }
}
