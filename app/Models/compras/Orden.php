<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Orden extends Model
{
    protected  $table = 'ordenes';
    protected $fillable = [
        'proyecto',
    	'proveedor_id',
        'tipo_orden',
        'estado_orden', 
        'monto_anticipo',
        'codigo_analisis', 
        'concepto',
        'codigo_orden', 
        'total_iva',
        'total_sin_descuento',
        'descuento',
        'subtotal',
        'retefuente',
        'total',
        'anticipo',
        'mes_anticipo', 
        'tiempo_pago',
        'fecha_inicio',
        'fecha_fin',
        'contte_nombre',
        'contte_nit_cc',
        'contte_telefono',
        'contte_rep_legal',     
        'contte_cc', 
        'contte_resp',
        'contte_resp_cc', 
        'contte_resp_email', 
        'contte_resp_cargo',
        'contte_rep_telf',
        'contta_nit_cc',
        'contta_dir',
        'contta_resp',
        'contta_resp_legal',
        'contta_resp_cc',
        'contta_resp_email',
        'contta_resp_cargo',
        'contta_rep_telf', 
    ];
    

    public function setFechaInicioAttribute($old){
    	$this->attributes['fecha_inicio'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaFinAttribute($old){
    	$this->attributes['fecha_fin'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function proveedor(){
    	return $this->belongsTo('App\Models\compras\Proveedor');
    }

    public function valuaciones(){
        return $this->hasMany('App\Models\compras\Valuacion');
    }

}