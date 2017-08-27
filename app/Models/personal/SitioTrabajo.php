<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class SitioTrabajo extends Model
{
	protected $table = 'sitios_trabajo';
	protected $fillable = [
		'nombre_sitio', 'codigo_sitio', 'direccion_sitio', 'ciudad_id', 'edo_sitio'
	];


	public function personas(){
		return $this->hasMany('App\Models\personal\Persona', 'sitio_trabajo_id', 'id');
	}
}