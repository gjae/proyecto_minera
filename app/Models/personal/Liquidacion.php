<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Liquidacion extends Model
{
    protected $table = 'liquidaciones';
    protected $fillable = [
    	'persona_id',
    	'dias_trabajados',
    	'fecha_retiro',
    	'porcentaje_intereses',
    	'total_cesantias',
    	'total_vacaciones',
    	'total_liquidacion',
    	'razon_retiro',
        'dias_liquidacion',
        'total_prima'
    ];

    protected $casts = [
    	'fecha_retiro' => 'date'
    ];

    public function persona(){
    	return $this->belongsTo('App\Models\personal\Persona');
    }

    public function setFechaRetiroAttribute($old){
        $this->attributes['fecha_retiro'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function detalles(){
        return $this->hasMany('App\Models\personal\DetalleLiquidacion', 'liquidacion_id');
    }

}
