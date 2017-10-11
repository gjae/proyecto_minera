<?php

namespace App\Models\transporte;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Transporte extends Model
{
    protected $table = 'transporte';
    protected $fillable = [
        /**
        * LLAVES FORANEAS
        */
        'persona_id',
        'remision_cli',
        'nit_cliente',
        'vehiculo_id',
        'tipo_material_id',
        'mina_id',
        /**
        * DATOS DE TIPO DATE REFERENTES AL VIAJE
        */
        'fecha_salida',
        'fecha_llegada',
        /**
        * MONTOS A CALCULAR
        */
        'precio_combustible',
        'kilo_viajes',
        'precio_kilo',
        'combustible_viaje',
        'precio_x_lts_combustible',
        'total_kilo_material',
        'total_kilo_viaje_material',
        'total_factura',
        'procedencia',
        'destino', 
        'recibo',
        'nro_factura', 
        'concepto_viaje',
        /**
        * DATOS DEL CLIENTE
        */
        'razon_social_cliente',
        'ident_cliente',
        'telefono_cliente',
        'email_cliente',
		'estado_registro',
        'total_km_viaje',
        'distancia_recorrida',
    ];
    protected $casts = [
    	'fecha_llegada' => 'date',
    	'fecha_salida' => 'date'
    ];

    public function conductor(){
    	return $this->belongsTo('App\Models\personal\Persona', 'persona_id');
    }

    public function tipo_material_transportado(){
    	return $this->belongsTo('App\Models\inventario\TipoMaterial', 'tipo_material_id');
    }

    public function vehiculo(){
    	return $this->belongsTo('App\Models\transporte\Vehiculo', 'vehiculo_id');
    }

    public function setFechaSalidaAttribute($old){
        $this->attributes['fecha_salida'] = Carbon::parse($old)->format('Y-m-d');
    }

    public function setFechaLlegadaAttribute($old){
        $this->attributes['fecha_llegada'] = Carbon::parse($old)->format('Y-m-d');
    }

    public static function getNewCode(){
        $codigo = DB::table('transporte')->count('nro_factura') + 1;
        $long = (7 - strlen($codigo));
        $nuevo = '';
        for ($i=0; $i < $long; $i++) { 
            $nuevo.= '0';
        }

        return $nuevo.$codigo;
    }
}
