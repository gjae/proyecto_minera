<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class DetalleNomina extends Model
{
    protected $table = 'detalle_nomina';
    protected $fillable = [
        'persona_id', 'nomina_id', 'ajuste_persona_id'
    ];


    public function nomina(){
        return $this->belongsTo('App\Models\personal\Nomina');
    }

    public function persona(){
    	return $this->belongsTo('App\Models\personal\Persona');
    }

    public function ajuste(){
    	return $this->belongsTo('App\Models\personal\DetalleNomina', 'ajuste_persona_id');
    }
}