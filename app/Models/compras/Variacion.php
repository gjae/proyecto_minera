<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;

use DB;

class Variacion extends Model
{
    protected $table = 'variaciones';
    protected $fillable = [
    	'consecutivo',
    	'concepto',
    	'monto_variacion',
    	'cantidad_dias_variacion',
    	'fecha_suspencion',
    	'fecha_reinicio',
    	'orden_id'
    ];

    protected $casts = [
    	'fecha_reinicio' => 'date',
    	'fecha_suspencion' => 'date',
    ];

    public function orden(){
    	return $this->belongsTo('App\Models\compras\Orden');
    }


    public static function getConsecutivo(){
    	$consecutivo = DB::table('variaciones')->max('consecutivo') + 1;

    	$len = (  7 - strlen($consecutivo));
    	$codigo = $consecutivo;
    	for ($i=0; $i < $len ; $i++) { 
    		$codigo = '0'.$codigo;
    	}

    	return $codigo.$consecutivo;
    }
}
