<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;

class AnalisisCotizacion extends Model
{
    protected $table = 'analisis_cotizacion';
    protected $fillable = [
    	'registro_cotizacion_id',
    	'proveedor_id',
    	'observacion',
    	'codigo',
    	'estado_analisis',	
    ];


    public function proveedor(){
    	return $this->belongsTo('App\Models\compras\Proveedor');
    }

    public function cotizacion(){
    	return $this->belongsTo('App\Models\compras\RegistroCotizacion', 'registro_cotizacion_id');
    }
}
