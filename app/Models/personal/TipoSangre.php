<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class TipoSangre extends Model
{
    protected $table = 'tipos_sangre';
    protected $fillable = [
        'descripcion_tipo', 'abreviatura_tipo'
    ];


    public function personas(){
        return $this->hasMany('App\Models\personal\Persona', 'tipo_sangre_id', 'id');
    }
}