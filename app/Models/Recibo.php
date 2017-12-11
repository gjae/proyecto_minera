<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Recibo extends Model
{
    protected $table = 'recibos';
	protected $fillable = [
		'id', 
		'vehiculo_id',
		 'persona_id',
		 'nro_factura', 
		 'tipo_material_id', 
			'recibo', 
		'procedencia', 
		'destino', 
		'remision_cli',
		'ciudad_id',
	];

	public function persona(){
		return $this->belongsTo('App\Models\personal\Persona');
	}

	public function vehiculo(){
		return $this->belongsTo('App\Models\transporte\Vehiculo');
	}

    public function tipo_material_transportado(){
    	return $this->belongsTo('App\Models\inventario\TipoMaterial', 'tipo_material_id');
    }

	public function ciudad(){
		return $this->belongsTo('App\Models\Ciudad');
	}
    public static function getNewCode(){
        $codigo = DB::table('recibos')->count('nro_factura') + 1;
        $long = (7 - strlen($codigo));
        $nuevo = '';
        for ($i=0; $i < $long; $i++) { 
            $nuevo.= '0';
        }

        return $nuevo.$codigo;
    }
}
