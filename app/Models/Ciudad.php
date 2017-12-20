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

	public function requisiciones(){
		return $this->hasMany('App\Models\requisicion\Requisicion');
	}

	public function invitaciones(){
		return $this->hasMany('App\Models\compras\SolicitudCotizacion');
	}	

	public function recibos(){
		return $this->hasMany('App\Models\Recibo');
	}
}
