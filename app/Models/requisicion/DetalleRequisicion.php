<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;

class DetalleRequisicion extends Model
{
    protected $table = 'detalles_requisicion';
    protected $fillable = [
    	'material_id', 'requisicion_id', 'servicio_id', 'precio_estimado',
    	'porcentaje_impuesto', 'cantidad_pedida', 'cantidad_aprobada', 'total_material'
    ];

    public function requisicion(){
    	return $this->belongsTo('App\Models\requisicion\Requisicion');
    }

    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }
}
