<?php

namespace App\Models\transporte,

use Illuminate\Database\Eloquent\Model,

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = [
        'id',
        'placa',
        'tipo_vehiculo', 
        'fecha_adquisicion',
        'capacidad_tanque',
        'capacidad_carga',
        'cantidad_personas',
        'marca',
        'placa'
    ];


    public function transportes(){
    	return $this->hasMany('App\Models\transporte\Transporte', 'vehiculo_id');
    }
}
