<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class Nomina extends Model
{
	protected $table = 'nominas';
	protected $fillable = [
		'codigo_nomina', 'periodo_nomina', 'estado_nomina', 'total_nomina', 'total_deducciones'
	];

	protected $casts = [
		'periodo_nomina' => 'date'
	];


	public function detalles(){
		return $this->hasMany('App\Models\personal\DetalleNomina');
	}
}