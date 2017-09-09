<?php

namespace App\Models\transporte,

use Illuminate\Database\Eloquent\Model,

class Transporte extends Model
{
    protected $table = 'transporte';
    protected $fillable = [
        /**
        * LLAVES FORANEAS
        */
        'persona_id',
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
}
