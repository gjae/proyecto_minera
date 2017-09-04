<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Ajuste extends Model
{
    protected $table = 'ajustes';
    protected $fillable = [
        'nombre_ajuste', 
        'codigo_ajuste',
        'porcentaje_ajuste',
        'cantidad_ajuste', 
        'fecha_activdad_desde', 
        'fecha_activdad_hasta', 
        'tipo_ajuste',
        'ajuste_global', 
        'ajuste_permanente', 
        'aportador'
    ];

    protected $casts= [
    	'fecha_activdad_desde' => 'date',
    	'fecha_activdad_hasta' => 'date'
    ];

    public function personas(){
        return $this->hasMany('App\Models\personal\AjustePersona', 'ajuste_id', 'id');
    }

    public function setFechaActivdadDesdeAttribute($old){
        $this->attributes['fecha_activdad_desde'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaActivdadHastaAttribute($old){
        $this->attributes['fecha_activdad_hasta'] = Carbon::parse($old)->format('Y-m-d');
    }

}
