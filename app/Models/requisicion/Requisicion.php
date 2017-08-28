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
    	'fecha_requerida'
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
}
