<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Cargo extends Model
{
	protected $table = 'cargos';
	protected $fillable = [
		'descripcion_cargo', 'codigo_cargo', 'edo_cargo'
	];

	public function personas(){
		return $this->hasMany('App\Models\personal\Persona');
	}
}