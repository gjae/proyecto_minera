<?php
namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

class AjustePersona extends Model
{
    protected $table = "ajuste_personas";
    protected $fillable = [
        'persona_id', 'ajuste_id'
    ];


    public function persona(){
        return $this->belongsTo('App\Models\personal\Persona');
    }

    public function ajuste(){
        return $this->belongsTo('App\Models\personal\Ajuste');
    }

    public function nominas(){
        return $this->hasMany('App\Models\personal\DetalleNomina');
    }
}
