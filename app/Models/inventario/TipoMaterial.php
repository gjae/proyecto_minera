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
}
