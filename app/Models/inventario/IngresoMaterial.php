<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

class IngresoMaterial extends Model
{
    protected $table = 'ingresos_material';
    protected $fillable = [
    	'fecha_ingreso', 'material_id', 'cantidad'
    ];

    protected $casts = [
    	'fecha_ingreso' => 'date'
    ];

    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }
}
