<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proceso extends Model
{
    use SoftDeletes;
    protected $table = 'procesos';
    protected $fillable = [
    	'nombre_proceso', 'descripcion', 'codigo'
    ];
    protected $dates = [ 'deleted_at' ];
}
