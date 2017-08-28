<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

class EgresoMaterial extends Model
{
    protected $table = 'egresos_materiales';
    protected $fillable = [
    	'material_id', 'cantidad_salida'
    ];


    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }
}
