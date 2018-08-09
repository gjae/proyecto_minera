<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frente extends Model
{

    protected $table = 'frentes';
    protected $fillable = [
    	'nombre_frente', 'descripcion', 'codigo'
    ];
    protected $dates = [ 'deleted_at' ];

}
