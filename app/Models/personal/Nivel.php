<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{

    protected $table = 'nivels';
    protected $fillable = [
    	'nombre_nivel', 'descripcion', 'codigo'
    ];
    protected $dates = [ 'deleted_at' ];

}
