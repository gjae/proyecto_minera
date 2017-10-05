<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class Valuacion extends Model
{
    protected $table = 'valuaciones';
    protected $fillable = [
    	'codigo_valuacion',
    	'concepto_valuacion',
    	'fecha_inicio',
    	'fecha_tope',
    	'orden_id',
    	'estatus',
        'monto_valuacion'
    ];

    protected $casts = [
    	'fecha_inicio' => 'date',
    	'fecha_tope' => 'date',
    ];

    public function orden(){
    	return $this->belongsTo('App\Models\compras\Orden');
    }

    public static function getANewCode(){
        $val = DB::table('valuaciones')->max('codigo_valuacion');
        $consecutivo =  intval($val) + 1;

        for ($i=0; $i < ( 7 - strlen($consecutivo)  ) ; $i++) { 
            $consecutivo = '0'.$consecutivo;
        }

        return $consecutivo;
    }

    public function getEstatusAttribute($value){
        switch ($value) {
            case 'PE':
                return 'PENDIENTE';
                break;
            case 'PA':
                return 'PAGADO';
                # code...
                break;

            case 'AN':
                return 'ANULADO';
                break;
        }
    }

    public function setFechaInicioAttribute($old){
        $this->attributes['fecha_inicio'] = Carbon::parse($old)->format('Y-m-d');
    }
    public function setFechaTopeAttribute($old){
        $this->attributes['fecha_tope'] = Carbon::parse($old)->format('Y-m-d');
    }
}
