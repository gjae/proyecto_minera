<?php

namespace App\Models\administracion;

use Illuminate\Database\Eloquent\Model;
use DB;
class Banco extends Model
{
    protected $table = 'bancos';
    protected $fillable = [
    	'nombre_banco', 'codigo_banco', 'edo_reg'
    ];

    public function proveedores(){
    	return $this->hasMany('App\Models\compras\Proveedor');
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
