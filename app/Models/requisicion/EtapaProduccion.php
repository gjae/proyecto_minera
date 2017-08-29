<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;

class EtapaProduccion extends Model
{
    protected $table = 'etapas_produccion';
    protected $fillable = [
    	'nombre_etapa', 'codigo_etapa'
    ];


    public function requisiciones(){
    	return $this->hasMany('App\Models\requisicion\Requisicion', 'etapa_produccion_id');
    }

    public function egresos_materiales(){
    	return $this->hasMany('App\Models\inventario\EgresoMaterial', 'etapa_produccion_id', 'id');
    }

    public function ingresos_materiales(){
    	return $this->hasMany('App\Models\inventario\IngresoMaterial', 'etapa_produccion_id', 'id');
    }
}
