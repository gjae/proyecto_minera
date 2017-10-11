<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\compras\Invitaciones;


use App\Models\compras\SolicitudCotizacion as SC;
use App\Models\compras\RegistroCotizacion as RC;
use DB;
class Cotizaciones extends Controller
{
    public function registrar($req){
    	return view('modulos.compras.cotizaciones', [
    			'requisicion' => false,
    			'solicitud' => false
    		]);
    }

    public function buscarProveedores($req){
    	$formulario = new Invitaciones;
    	return $formulario->buscarProveedores($req);
    }

    public function buscarInvitacion($req){
    	$solicitudes = SC::where('proveedor_id', $req->proveedor_id)
    						->where('estado_registro', 'ACTIVA')->get();

    	$vista = \View::make('modulos.compras.formularios.invitaciones', [
    			'invitaciones' => $solicitudes
    		])->render();
    	return response(['error' => false, 'formulario' => $vista], 200)
    			->header('Content-Type', 'application/json');
    }

    public function agregarRequisicion($req){
    	$solicitud = SC::find($req->invitacion);
    	return view('modulos.compras.cotizaciones', [
    			'requisicion' => $solicitud->requisicion,
    		]);
    }

    public function detalles($req){
    	$solicitud = SC::where('codigo', $req->solicitud)
    					->where('proveedor_id', $req->proveedor_id)
    					->first();

    	return view('modulos.compras.cotizaciones', [
    			'requisicion' => $solicitud->requisicion,
    			'solicitud' => $solicitud
    		]);
    }

    public function guardarRegistro($req){
    	$solicitud = SC::find($req->solicitud_cotizacion_id);
    	$data = [
    		'error' => true,
    		'mensaje' => "LLEGO! -> ".$solicitud->codigo
    	];

    	//return response($data, 200)->header('Content-Type', 'application/json');
    	DB::beginTransaction();
    	try {
    		$cantidad = count($req->cantidades);

    		for ($i=0; $i < $cantidad; $i++) { 
    			$insert = [
    				'solicitud_cotizacion_id' => $solicitud->id,
    				'material_id' => $req->material[$i],
    				'proveedor_id' => $req->proveedor_id,
    				'plazo_entrega' => $req->pazo_entrega,
    				'observacion' => $req->observacion,
    				'forma_pago' => $req->forma_pago,
    				'terminos_entrega' => $req->terminos_entrega,
    				'cotizacion' => $req->cotizaciones[$i],
    				'porcentaje_impuesto' => $req->porcentajes[$i],
    				'cantidad' => $req->cantidades[$i],
    				'total_cotizacion' => $req->totales[$i],
                    'marca' => $req->marcas[$i]
    			];

    			$rc = new RC($insert);
    			if(! $rc->save()){
    				throw new \Exception("ERROR AL INTENTAR PROCESAR LA INSERSION DEL REGISTRO DE COTIZACION CERCA DE LA LINEA 84 DEL ARCHIVO Cotizaciones.php", 1);
    				
    			}
    		}
    		$solicitud->estado_registro = 'ANULADA';
    		if(! $solicitud->save()){
    			throw new \Exception("ERROR AL INTENTAR ACTUALIZAR EL ESTADO DE LA SOLICITUD EN EL ARCHIVO Cotizaciones.php CERCA DE LA LINEA 89", 1);
    			
    		}
    		DB::commit();
    		return response(['error' => false, 'mensaje' => 'SE HA GUARDADO EL REGISTRO CORRECTAMENTE'], 200)->header('Content-Type', 'application/json');
    	} catch (\Exception $e) {
    		DB::rollback();
    		return response(['error' => true, 'mensaje' => $e->getMessage()])->header('Content-Type', 'application/json');
    	}
    }
}
