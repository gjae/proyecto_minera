<?php

namespace App\Models\compras;

use Illuminate\Database\Eloquent\Model;

use DB;

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
    	'banco_id',
        'edo_reg',
        'codigo_proveedor',
        'telefono_representante',
        'email_representante',
        'direccion',
        'tipo_identificacion'
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

    public function analisis(){
        return $this->hasMany('App\Models\compras\AnalisisCotizacion');
    }

    public function ordenes(){
        return $this->hasMany('App\Models\compras\Orden');
    }

    public function setCodigoProveedorAttribute($old){
        $this->attributes['codigo_proveedor'] = Proveedor::getNewCode();
    }

    public function ingresoMaterial(){
        return $this->hasMany('App\Models\inventario\IngresoMaterial');
    }

    public static function getNewCode(){
        $codigo = DB::table('proveedores')->count('codigo_proveedor') + 1;

        $len = (7 - strlen($codigo));
        $completo = '';
        for ($i=0; $i < $len; $i++) { 
            $completo.= '0';
        }

        return $completo.$codigo;
    }
}
