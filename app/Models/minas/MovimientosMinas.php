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
        'persona_id',
        'material_mina_id',
        'etapa_produccion_id',
        'centro_costo_id',
        'diciplina_id',
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

    public function etapa_produccion(){
        return $this->belongsTo('App\Models\requisicion\EtapaProduccion', 'etapa_produccion_id');
    }

    public function centro_costos(){
        return $this->belongsTo('App\Models\requisicion\CentroCosto', 'centro_costo_id');
    }

    public function disciplina(){
        return $this->belongsTo('App\Models\requisicion\Diciplina', 'diciplina_id');
    }
}
