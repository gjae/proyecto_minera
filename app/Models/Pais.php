<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';
    protected $fillable = [
    	'nombre_pais',
    	'codigo_pais',
    	'cod_telefonico'
    ];


    public function fabricantes(){
    	return $this->hasMany('App\Models\Fabricante');
    }
}
