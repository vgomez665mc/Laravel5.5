<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Articulo extends Model
{
	use SoftDeletes;

    protected $table="articulos";
    protected $dates = ['deleted_at'];



	protected $fillable = [
        'Nombre_Articulo', 'precio', 'pais_origen','observaciones','seccion'
    ];

	public function cliente(){
        return $this->belongsTo('App\Cliente');
	    
	}





}
