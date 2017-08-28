<?php

namespace App\Models\requisicion;

use Illuminate\Database\Eloquent\Model;

class Diciplina extends Model
{
    protected $table = 'diciplinas';
    protected $fillable = [
    	'nombre_diciplina', 'codigo_diciplina'
    ];


    public function requisiciones(){
    	return $this->hasMany('App\Models\requisicion\Requisicion');
    }
}
