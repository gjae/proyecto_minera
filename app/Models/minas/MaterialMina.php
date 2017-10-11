<?php

namespace App\Models\minas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialMina extends Model
{
	use SoftDeletes;
    protected $table = 'materiales_minas';

    protected $fillable = [
		'descripcion',
		'unidad_medida_id',
		'tipo_material_id',
    ];

    protected $dates = ['deleted_at'];

    public function unidad_medida(){
    	return $this->belongsTo('App\Models\inventario\UnidadMedida', 'unidad_medida_id');
    }

    public function movimientos(){
    	return $this->hasMany('App\Models\minas\MovimientosMinas', 'material_mina_id');
    }

    public function tipo(){
        return $this->belongsTo('App\Models\inventario\TipoMaterial', 'tipo_material_id');
    }

}
