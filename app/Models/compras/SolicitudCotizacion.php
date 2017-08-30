<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;

class SolicitudCotizacion extends Model
{
    protected $table = 'solicitudes_cotizacion';
    protected $fillable = [
    	'requisicion_id',
    	'proveedor_id',
    	'concepto_solicitud',
    	'estado_registro',
    	'observacion_anulacion'
    ];

    public function requisicion(){
    	return $this->belongsTo('App\Models\requisicion\Requisicion', 'requisicion_id');
    }

    public function proveedor(){
    	return $this->belongsTo('App\Models\compras\Proveedor');
    }

    public function registros_cotizacion(){
        return $this->hasMany('App\Models\compras\RegistroCotizacion', 'solicitud_cotizacion_id');
    }
}
