<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function articulo(){
    	return $this->hasOne('App\Articulo');
    }
}
