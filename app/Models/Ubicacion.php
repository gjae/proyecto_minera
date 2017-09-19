<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    protected $fillable = [
    	'nombre_ubicacion', 'codigo', 'direccion_ubicacion'
    ];

    public function fichas(){
    	return $this->hasMany('App\Models\inventario\Ficha');
    }

	public static function getNewCode(){
		$codigo = DB::table('ubicaciones')->count('codigo') + 1;

		$len = (4 - strlen($codigo));
		$completo = '';
		for ($i=0; $i < $len; $i++) { 
			$completo.= '0';
		}

		return $completo.$codigo;
	}
}
