<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';
    protected $fillable = [
    	'nombre_ubicacion', 'codigo', 'direccion_ubicacion'
    ];
}
