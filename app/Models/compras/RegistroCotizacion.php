<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;

class RegistroCotizacion extends Model
{
    protected $table = 'registro_cotizacion';
    protected $fillable = [
    	'solicitud_cotizacion_id',
    	'material_id',
    	'proveedor_id',
    	'plazo_entrega',
    	'observacion',
    	'estado_registro',
    	'observacion_anulacion',
    	'forma_pago',
    	'terminos_entrega',
    	'cotizacion',
    	'porcentaje_impuesto',
    	'cantidad',
    	'total_cotizacion'
    ];

    public function solicitud(){
    	return $this->belongsTo('App\Models\compras\SolicitudCotizacion', 'solicitud_cotizacion_id');
    }

    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }

    public function proveedor(){
    	return $this->belongsTo('App\Models\compras\Proveedor');
    }
}
