<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class IngresoMaterial extends Model
{
    protected $table = 'ingresos_material';
    protected $fillable = [
    	'fecha_ingreso', 'material_id', 'cantidad',
        'etapa_produccion_id', 'diciplina_id', 
        'centro_costo_id'
    ];

    protected $casts = [
    	'fecha_ingreso' => 'date'
    ];

    public function material(){
    	return $this->belongsTo('App\Models\inventario\Material');
    }

    public function etapa_produccion(){
        return $this->belongsTo('App\Models\requisicion\EtapaProduccion', 'etapa_produccion_id');
    }

    public function diciplina(){
        return $this->belongsTo('App\Models\requisicion\Diciplina', 'diciplina_id');
    }

    public function centro_costo(){
        return $this->belongsTo('App\Models\requisicion\CentroCosto', 'centro_costo_id');
    }

    public function setCreatedAtAttribute($old){
        $this->attributes['created_at'] = Carbon::now()->format('Y-m-d 00:00:00');
    }
}
