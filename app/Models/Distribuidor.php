<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Distribuidor extends Model
{
    protected $table = 'distribuidores';
    protected $fillable = [
    	'nombre_distribuidor', 
    	'direccion',
    	'telefono',
    	'ciudad_id',
        'codigo_distribuidor',
        'edo_reg'
    ];

    public function ciudad(){
    	return $this->belongsTo('App\Models\Ciudad');
    }

    public function fichas(){
        return $this->hasMany('App\Models\inventario\Ficha');
    }

    public static function getNewCode(){
        $codigo = DB::table('distribuidores')->count('codigo_distribuidor') + 1;

        $len = (4 - strlen($codigo));
        $completo = '';
        for ($i=0; $i < $len; $i++) { 
            $completo.= '0';
        }

        return $completo.$codigo;
    }

}
