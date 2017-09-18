<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Ciudad extends Model
{
	protected $table = 'ciudades';
	protected $fillable = [
		'nombre_ciudad', 'codigo_ciudad', 'edo_ciudad'
	];	

	public function personas(){
		return $this->hasMany('App\Models\personal\Persona');
	}

	public function distribuidores(){
		return $this->hasMany('App\Models\Distribuidor');
	}
}