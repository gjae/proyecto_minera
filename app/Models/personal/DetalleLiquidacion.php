<?php

namespace App\Models\personal;

use Illuminate\Database\Eloquent\Model;

class DetalleLiquidacion extends Model
{
    protected $table = 'detalles_liquidacion';
    protected $fillable = [
    	'liquidacion_id',
    	'ajuste_persona_id',
    	'total_ajuste'
    ];


    public function ajuste_persona(){
    	return $this->belongsTo('App\Models\personal\AjustePersona', 'ajuste_persona_id', 'id');
    }

    public function liquidacion(){
    	return $this->belongsTo('App\Models\personal\Liquidacion');
    }
}
