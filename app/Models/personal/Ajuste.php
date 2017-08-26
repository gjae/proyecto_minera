<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;
class Ajuste extends Model
{
    protected $table = 'ajustes';
    protected $fillable = [
        'nombre_ajuste', 'codigo_ajuste','porcentaje_ajuste',
        'cantidad_ajuste', 'fecha_actividad_desde', 'fecha_actividad_hasta', 'tipo_ajuste',
        'ajuste_global', 'ajuste_permanente', 'aportador'
    ];


    public function personas(){
        return $this->hasMany('App\Models\personal\AjustePersona', 'ajuste_id', 'id');
    }
}
