<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use PDF;

// MODELOS
// 
use App\Models\compras\SolicitudCotizacion;
use App\Models\compras\Proveedor;
use App\Models\requisicion\Requisicion;

class Invitaciones extends Controller
{
    public function index($req){ 

    	return view('modulos.compras.solicitudes', [
    			'codigo' => $this->getCodigoSolicitud()
    		]);

    }

    private function getCodigoSolicitud(){
    	$codigo = SolicitudCotizacion::max('codigo') + 1;
    	$len = 8 - strlen($codigo);

    	for ($i=0; $i < $len ; $i++) { 
    		$codigo =  '0'.$codigo;
    	}
    	return $codigo;
    }

    public function buscarProveedores($req){
    	$proveedores = Proveedor::all();
    	$vista = \View::make('modulos.compras.formularios.listado_proveedores', [
    			'proveedores' => $proveedores
    		])->render();

    	$data = [
    		'error' => ( count($proveedores) <= 0 ) ? true : false,
    		'mensaje' => ( count($proveedores) <= 0 ) ? 'NO HAY PROVEEDORES REGISTRADOS' : 'PROVEEDORES ENCONTRADOS',
    		'formulario' => $vista,
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');
    }

    public function buscarRequisiciones($req){
    	$requisiciones = Requisicion::where('estado_requisicion', 'EMITIDA')->get();

    	$vista = \View::make('modulos.compras.formularios.listado_requisiciones', [
    			'requisiciones' => $requisiciones
    		])->render();
    	$data = [
    		'error' => ( count($requisiciones) <= 0 ) ? true : false,
    		'mensaje' => ( count($requisiciones) <= 0 ) ? 'NO HAY REQUISICIONES PARA PROCESAR' : 'REQUISICIONES ENCONTRADAS',
    		'formulario' => $vista,
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');
    }

    /**
     * FUNCION PARA GUARDAR LAS SOLICITUDES A COTIZAR
     * HACE UN RECORRIDO POR EL TOTAL DE LOS PROVEEDORES PARA INSERTARLE 
     * LA INVITACION A TODAS LAS REQUISICIONES A LAS CUAL SE LE ESTA INVITANDO
     * A PERTICIPAR
     */
    public function guardarInvitacion($req){
    	DB::beginTransaction();
    	try {
    		$solicitud = null;
    		for ($i=0; $i < count($req->proveedores) ; $i++) { 
    			for ($j=0; $j < count($req->requisiciones) ; $j++) { 
    				$solicitud = new SolicitudCotizacion([
    						'proveedor_id' => $req->proveedores[$i],
    						'requisicion_id' => $req->requisiciones[$j],
    						'concepto_solicitud' => $req->concepto_solicitud,
    						'codigo' => $req->codigo
    					]);
    				$r = Requisicion::find($req->requisiciones[$j]);
    				if(! $solicitud->save()){
    					throw new \Exception("HA OCURRIDO UN ERROR AL GUARDAR LA INVITACION, MODULO : compras ARCHIVO: Invitaciones.php CERCA DE LA LINEA # 79", 1);
    					
    				}
    				if(! $r->update(['estado_requisicion' => 'PROCESADA'])){
    					throw new \Exception("HA OCURRIDO UN ERROR AL GUARDAR LA INVITACION, MODULO : compras ARCHIVO: Invitaciones.php CERCA DE LA LINEA # 79", 1);
    				}
    				
    			}
    		}
    		DB::commit();
    		return response(['error' => false, 'mensaje' => 'LAS INVITACIONES A COTIZAR HAN SIDO GUARDADAS CORRECTAMENTE'], 200)
    				->header('Content-Type', 'application/json');
    		
    	} catch (\Exception $e) {
    		DB::rollback();
    		return response(['error' => true, 'mensaje' => $e->getMessage()], 200)
    				->header('Content-Type', 'application/json');
    	}
    }

    public function printInvitacion($req){
    	$solicitud = SolicitudCotizacion::where('codigo', '00000002')->get();

    	$vista = \View::make('modulos.compras.reportes.invitacion_cotizacion', [
    			'solicitudes' => $solicitud
    		])->render();
    	$pdf = PDF::loadHtml($vista);

    	return $pdf->stream('invoice', ['attachment' => 0]);
    }
}
