<?php

namespace App\Models\administracion;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';
    protected $fillable = [
    	'nombre_banco', 'codigo_banco'
    ];

    public function proveedores(){
    	return $this->hasMany('App\Models\compras\Proveedor');
    }
}
