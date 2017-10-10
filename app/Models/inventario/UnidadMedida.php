<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'unidades_medida';
    protected $fillable = [
    	'descripcion_unidad', 'codigo_unidad', 'edo_reg'
    ];


    public function materiales(){
    	return $this->hasMany('App\Models\inventario\Material', 'unidad_medida_id');
    }

    public function materiales_de_minas(){
    	return $this->hasMany('App\Models\minas\MaterialMina', 'unidad_medida_id');
    }
}
