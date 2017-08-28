<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;

class CentroCosto extends Model
{
    protected $table = 'centros_costos';
    protected $fillable = [
    	'nombre_centro', 'codigo_centro'
    ];

    public function requisiciones(){
    	return $this->hasMany('App\models\requisicion\Requisicion', 'centro_costo_id');
    }
}
