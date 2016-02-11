<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;

class Diciplina extends Model
{
    protected $table = 'diciplinas';
    protected $fillable = [
    	'nombre_diciplina', 'codigo_diciplina', 'edo_reg'
    ];


    public function requisiciones(){
    	return $this->hasMany('App\Models\requisicion\Requisicion');
    }

    public function egresos_materiales(){
    	return $this->hasMany('App\Models\inventario\EgresoMaterial', 'diciplina_id');
    }

    public function ingresos_materiales(){
    	return $this->hasMany('App\Models\inventario\IngresoMaterial', 'diciplina_id');
    }

    public function items(){
        return $this->hasMany('App\Models\requisicion\DetalleRequisicion');
    }
}
