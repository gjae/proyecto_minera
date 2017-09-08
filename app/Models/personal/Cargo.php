<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

use DB;
class Cargo extends Model
{
	protected $table = 'cargos';
	protected $fillable = [
		'descripcion_cargo', 'codigo_cargo', 'edo_cargo'
	];

	public function personas(){
		return $this->hasMany('App\Models\personal\Persona');
	}

	public static function getNewCode(){
		$codigo = DB::table('cargos')->count('codigo_cargo') + 1;

		$len = (4 - strlen($codigo));
		$completo = '';
		for ($i=0; $i < $len; $i++) { 
			$completo.= '0';
		}

		return $completo.$codigo;
	}
}