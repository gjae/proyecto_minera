<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
* 
*/
class Nomina extends Model
{
	protected $table = 'nominas';
	protected $fillable = [
		'codigo_nomina', 'periodo_nomina', 'estado_nomina', 'total_nomina', 'total_deducciones', 'nombre_nomina', 'tipo_nomina', 
	];

	protected $casts = [
		'periodo_nomina' => 'date'
	];


	public function detalles(){
		return $this->hasMany('App\Models\personal\DetalleNomina');
	}

	public function setPeriodoNominaAttribute($old){
		$this->attributes['periodo_nomina'] = Carbon::parse($old)->format('Y-m-d');
	}
}