<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = [
    	'tipo_identificacion', 
    	'retenedor', 
    	'regimen_tributario',
    	'tipo_cuenta',
    	'telefono',
    	'fax',
    	'email',
    	'cuenta_bancaria',
    	'razon_social',
    	'representante_legal',
    	'cedula',
    	'nro_identificacion',
    	'ciudad_id',
    	'banco_id'
    ];


   public function banco(){
   		return $this->belongsTo('App\Models\administracion\Banco');
   }

    public function solicitudes_cotizaciones(){
        return $this->hasMany('App\Models\compra\SolicitudCotizacion');
    }

    public function registros_cotizacion(){
        return $this->hasMany('App\Models\compras\RegistroCotizacion');
    }

}
