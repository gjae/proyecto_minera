<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ficha extends Model
{
    protected $table = 'fichas';

    protected $fillable = [
            'servicio', 
            'cedula_representante',
            'valor',
            'ubicacion_id',
            'marca', 
            'modelo', 
            'serie', 
            'representante', 
            'ciudad_representante',
            'telefono_representante', 
            'anio_fabricacion',
            'fecha_compra',
            'fecha_instalacion',
            'fecha_inicio_operaciones',
            'material_id',
            'tipo_adquisicion',
            'tipo_mantenimiento',
            'fuente_energia',
            'tipo_uso', 
            'equipo', 
            'mantenimiento',
            'calif_biomedica',
            'tecn_predeterminada', 
            'tipo_riesgo',
            'voltaje',
            'amperaje',
            'potencia',
            'frecuencia',
            'capacidad',  
            'presion',
            'vel',
            'temperatura',
            'peso',
            'vida_util',
            'frecuencia_mantenimiento',
            'manuales_componentes', 
            'manuales_servicio',
            'manuales_usuario',
            'manuales_despiece',
            'distribuidor_id',
            'fabricante_id',
            'tipo_depreciacion',
            'tiempo_depreciacion',
            'monto_depreciacion',
            'total_depreciacion'
    ];

    protected $casts = [
    	'fecha_instalacion' => 'date',
    	'fecha_compra' => 'date',
    	'fecha_inicio_operaciones' => 'date',

    ];


    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }


    public function distribuidor(){
    	return $this->belongsTo('App\Models\Distribuidor');
    }

    public function fabricante(){
    	return $this->belongsTo('App\Models\Fabricante');
    }

    public function ubicacion(){
        return $this->belongsTo('App\Models\Ubicacion');
    }


    public function setFechaCompraAttribute($old){
    	$this->attributes['fecha_compra'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaInstalacionAttribute($old){
    	return $this->attributes['fecha_instalacion'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaInicioOperacionesAttribute($old){
    	$this->attributes['fecha_inicio_operaciones'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function getTipoRiesgoAttribute($value){
        switch ($value) {
            case 'III':
                return 'MUY ALTO RIESGO III';
                break;
            
            case 'IIB':
                return 'ALTO RIESGO II b';
                break;

            case 'IIA':
                return 'RIESGO MODERADO II a';
                break;
            case 'I':
                return 'BAJO RIESGO I';
                break;
            case '-':
                return 'NINGUNO';
                break;
        }
    }

    public function getTipoDepreciacionAttribute($valor){
        switch ($valor) {
            case 'M':
               return 'MENSUAL';
                break;
            
            case 'A':
                return 'ANUAL';
                break;

            case 'S':
                return 'SEMANAL';
                break;

            case 'D':
                return 'DIARIA';
                break;
        }
    }
}
