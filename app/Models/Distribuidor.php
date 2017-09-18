<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    protected $table = 'distribuidores';
    protected $fillable = [
    	'nombre_distribuidor', 
    	'direccion',
    	'telefono',
    	'ciudad_id'
    ];

    public function ciudad(){
    	return $this->belongsTo('App\Models\Ciudad');
    }

    public function fichas(){
        return $this->hasMany('App\Models\inventario\Ficha');
    }
}
