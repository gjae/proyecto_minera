<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;

class DetalleRequisicion extends Model
{
    protected $table = 'detalles_requisicion';
    protected $fillable = [
    	'material_id', 'requisicion_id', 'servicio_id', 'precio_estimado',
    	'porcentaje_impuesto', 'cantidad_pedida', 'cantidad_aprobada', 'total_material',
        'diciplina_id' ,
        'etapa_produccion_id',
        'centro_costo_id',
    ];

    public function requisicion(){
    	return $this->belongsTo('App\Models\requisicion\Requisicion');
    }

    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }

    public function centro_costos(){
        return $this->belongsTo('App\Models\requisicion\CentroCosto', 'centro_costo_id');
    }

    public function etapa_produccion(){
        return $this->belongsTo('App\Models\requisicion\EtapaProduccion','etapa_produccion_id');
    }

    public function disciplina(){
        return $this->belongsTo('App\Models\requisicion\Diciplina', 'diciplina_id');
    }
}
