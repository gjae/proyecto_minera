<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

class EgresoMaterial extends Model
{
    protected $table = 'egresos_materiales';
    protected $fillable = [
    	'material_id', 'cantidad_salida', 
    	'etapa_produccion_id', 'diciplina_id', 
    	'centro_costo_id', 'persona_id'
    ];


    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }

    public function etapa_produccion(){
    	return $this->belongsTo('App\Models\requisicion\EtapaProduccion', 'etapa_produccion_id');
    }

    public function diciplina(){
    	return $this->belongsTo('App\Models\requisicion\Diciplina', 'diciplina_id');
    }

    public function centro_costo(){
    	return $this->belongsTo('App\Models\requisicion\CentroCosto', 'centro_costo_id');
    }

    public function persona_solicitante(){
    	return $this->belongsTo('App\Models\personal\Persona');
    }
}
