<?php

namespace App\Models\minas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientosMinas extends Model
{
	use SoftDeletes;
    protected $table = 'movimientos_materiales';
    protected $fillable = [
        'cantidad_ingreso',
        'cantidad_salida',
        'monto_tonelada',
        'total_movimiento',
        'fecha_ingreso',
        'fecha_salida',
        'observacion',
        'peso_en',
        /**
         * PERSONA (MINERO) RESPONSABLE
         */
        'persona_id',

        'material_mina_id',

        'mina_id',
    ];

    protected $dates = ['deleted_at', 'fecha_salida', 'fecha_ingreso'];
    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_salida' => 'date'
    ];
    
    public function persona(){
    	return $this->belongsTo('App\Models\personal\Persona');
    }

    public function material(){
    	return $this->belongsTo('App\Models\minas\MaterialMina', 'material_mina_id');
    }

    public function mina(){
    	return $this->belongsTo('App\Models\Mina');
    }
}
