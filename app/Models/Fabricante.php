<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Fabricante extends Model
{
    protected $table = 'fabricantes';
    protected $fillable = [
    	'nombre_fabricante',
    	'codigo_fabricante',
    	'pais_id',
    	'telefono',
        'edo_reg'
    ];

    public function pais(){
    	return $this->belongsTo('App\Models\Pais');
    }

    public function fichas(){
        return $this->hasMany('App\Models\inventario\Ficha');
    }

    public static function getNewCode(){
        $codigo = DB::table('bancos')->count('codigo_banco') + 1;

        $len = (4 - strlen($codigo));
        $completo = '';
        for ($i=0; $i < $len; $i++) { 
            $completo.= '0';
        }

        return $completo.$codigo;
    }

}
