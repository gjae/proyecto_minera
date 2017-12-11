<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class IngresoMaterial extends Model
{
    protected $table = 'ingresos_material';
    protected $fillable = [
    	'fecha_ingreso', 'material_id', 'cantidad',
        'etapa_produccion_id', 'diciplina_id', 
        'centro_costo_id', 'monto', 'proveedor_id', 'factura', 'precio',
		'total', 'total_iva', 'created_at'
    ];

    protected $casts = [
    	'fecha_ingreso' => 'date'
    ];

    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }

	public function setFechaIngresoAttribute($old){
		$this->attributes['fecha_ingreso'] = Carbon::parse($old)->format('Y-m-d');
	}

    public function etapa_produccion(){
        return $this->belongsTo('App\Models\requisicion\EtapaProduccion', 'etapa_produccion_id');
    }

    public function diciplina(){
        return $this->belongsTo('App\Models\requisicion\Diciplina', 'diciplina_id');
    }

    public function centro_costo(){
        return $this->belongsTo('App\Models\requisicion\CentroCosto', 'centro_costo_id');
    }

	public function proveedor(){
		return $this->belongsTo('App\Models\compras\Proveedor');
	}

	public function setCreatedAtAttribute($old){
		$this->attributes['created_at'] = Carbon::parse($old)->format('Y-m-d H:i:s');
	}

}
