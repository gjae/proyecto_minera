<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Material extends Model
{
    protected $table = 'materiales';
    protected $fillable = [
    	'codigo_material', 'existencia_minima', 'unidad_medida_id',
    	'tipo_material_id', 'fecha_ingreso_material', 'nombre_material'
    ];

    protected $casts = [
    	'fecha_ingreso_material' => 'date'
    ];

    public function requisicion(){
    	return $this->hasMany('App\Models\inventario\DetalleRequisicion');
    }

    public function unidad_medida(){
    	return $this->belongsTo('App\Models\inventario\UnidadMedida', 'unidad_medida_id');
    }

    public function tipo(){
    	return $this->belongsTo('App\Models\inventario\TipoMaterial', 'tipo_material_id');
    }

    public function egresos(){
        return $this->hasMany('App\Models\inventario\EgresoMaterial');
    }

    public function ingresos(){
        return $this->hasMany('App\Models\inventario\IngresoMaterial');
    }

    public function  setFechaIngresoMaterialAttribute($old){
        $this->attributes['fecha_ingreso_material'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function registroes_cotizacion(){
        return $this->hasMany('App\Models\compras\RegistroCotizacion');
    }
}
