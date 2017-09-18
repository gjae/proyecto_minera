<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class Accesorio extends Model
{
    protected $table = 'accesorios';
    protected $fillable = [
    	'nombre_accesorio',
    	'tipo_accesorio',
    	'material_accesorio',
    	'modelo',
    	'serie',
    	'marca',
    	'fecha_compra',
    	'material_id'
    ];

    protected $casts = [
    	'fecha_compra' => 'date'
    ];

    public function setFechaCompraAttribute($old){
    	$this->attributes['fecha_compra'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }
}
