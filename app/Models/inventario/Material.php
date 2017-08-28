<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';
    protected $fillable = [
    	'codigo_material', 'existencia_minima', 'uniad_medida_id',
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
}
