<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

class TipoMaterial extends Model
{
    protected $table = 'tipos_material';
    protected $fillable = [
    	'codigo_tipo', 'descripcion_tipo'
    ];

    public function materiales(){
    	return $this->hasMany('App\Models\inventario\Material', 'tipo_material_id');
    }

    public function transportes(){
    	return $this->hasMany('App\Models\transporte\Transporte', 'tipo_material_id');
    }

    public function materiales_minas(){
        return $this->hasMany('App\Models\minas\MaterialMina', 'tipo_material_id');
    }
}
