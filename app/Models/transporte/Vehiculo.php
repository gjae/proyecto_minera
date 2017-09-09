<?php

namespace App\Models\transporte;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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
        'placa',
        'edo_reg',
        'modelo'
    ];

    protected $casts = [
        'fecha_adquisicion' => 'date'
    ];  

    public function transportes(){
    	return $this->hasMany('App\Models\transporte\Transporte', 'vehiculo_id');
    }

    public function setFechaAdquisicionAttribute($old){
        $this->attributes['fecha_adquisicion'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setMarcaAttribute($old){
        $this->attributes['marca'] = trim(strtoupper($old));
    }

    public function setModeloAttribute($old){
        $this->attributes['modelo'] = trim(strtoupper($old));
    }


}
