<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;

class CentroCosto extends Model
{
    protected $table = 'centros_costos';
    protected $fillable = [
    	'nombre_centro', 'codigo_centro', 'edo_reg'
    ];

    public function requisiciones(){
    	return $this->hasMany('App\models\requisicion\Requisicion', 'centro_costo_id');
    }

    public function egresos_materiales(){
    	return $this->hasMany('App\Models\inventario\EgresoMaterial', 'centro_costo_id');
    }

    public function ingresos_materiales(){
    	return $this->hasMany('App\Models\inventario\IngresoMaterial', 'centro_costo_id');
    }
}
