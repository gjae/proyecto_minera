<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Requisicion extends Model
{
    protected $table = 'requisiciones';
    protected $fillable = [
    	'codigo_requisicion', 'concepto_requisicion', 'user_id',
    	'tipo_requisicion', 'estado_requisicion', 'total_requisicion', 'total_impuestos',
    	'fecha_requerida', 'centro_costo_id', 'etapa_produccion_id', 'diciplina_id'
    ];

    protected $casts = [
    	'fecha_requerida' => 'date'
    ];


    public function detalles(){
    	return $this->hasMany('App\Models\requisicion\DetalleRequisicion');
    }

    public function setFechaRequeridaAttribute($old){
        $this->attributes['fecha_requerida'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function centro_costo(){
        return $this->belongsTo('App\Models\requisicion\CentroCosto', 'centro_costo_id');
    }

    public function diciplina(){
        return $this->belongsTo('App\Models\requisicion\Diciplina');
    }

    public function etapa_produccion(){
        return $this->belongsTo('App\Models\requisicion\EtapaProduccion', 'etapa_produccion_id');
    }

    public function solicitudes_cotizaciones(){
        return $this->hasMany('App\Models\compras\SolicitudCotizacion', 'requisicion_id');
    }
    public function getTipoRequisicionAttribute($old){
        return "COMPRAS";
    }
}
