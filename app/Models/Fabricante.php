<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $table = 'fabricantes';
    protected $fillable = [
    	'nombre_fabricante',
    	'codigo_fabricante',
    	'pais_id',
    	'telefono'
    ];

    public function pais(){
    	return $this->belongsTo('App\Models\Pais');
    }

    public function fichas(){
        return $this->hasMany('App\Models\inventario\Ficha');
    }


}
