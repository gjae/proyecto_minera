<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mina extends Model
{
    protected $table = 'minas';
    protected $fillable = [
    	'nombre_mina',
    	'codigo_mina'
    ];

    protected $casts = [ 
    	'codigo_mina' => 'string'
    ];

    public function personas(){
    	return $this->hasMany('App\Models\personal\Persona');
    }
}
