<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\compras\AnalisisCotizacion as AC;
use App\Models\compras\Orden;

use DB;
use PDF;
class Ordenes extends Controller
{
    public function emitir($req){
    	return view('modulos.compras.crear_orden', [
    			'analisis' => false
    		]);
    }

    public function ordenes($req){
        return view('modulos.compras.listado_ordenes', [
                'ordenes' => Orden::all(),
            ]);
    }

    public function imprimir($req){
        if( $req->has('orden') && !empty($req->orden)){
            $orden = Orden::find($req->orden);
            $ac = AC::where('codigo', $orden->codigo_analisis)->first();

            $requisicion = $ac->cotizacion->solicitud->requisicion;
            set_time_limit(900);
           
            $vista = \View::make('modulos.compras.reportes.orden_compra',[
                    'orden' => $orden,
                    'requisicion' => $requisicion,
                    'analisis' => $ac,
                    'solicitud' => $ac->cotizacion->solicitud
                ])->render();
            $pdf = PDF::loadHtml($vista);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('reporte_orden', ['attachment' => 0]);
        }
    }

    public function buscarAnalisis($req){
    	$ac = AC::select(['codigo', 'observacion', 'proveedor_id'])
    				->distinct()->get();

    	$vista = \View::make('modulos.compras.formularios.buscar_analisis', [
    			'analisis' => $ac
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];

    	return response($data, 200)->header('Content-Type', 'application/json');
    }

    public function crearOrden($req){
    	$ac_totales = AC::where('codigo', $req->codigo)->get();
    	$codigo = Orden::max('codigo_orden') +1;
    	$sub_total = 0;
    	$iva = 0;

    	for ($i=0; $i < (7 - strlen($codigo)) ; $i++) { 
    		$codigo = '0'.$codigo;
    	}

    	foreach ($ac_totales as $key => $ac_total) {
    		$sub_total += $ac_total->cotizacion->cotizacion * $ac_total->cotizacion->cantidad;
    		$iva += ( ( $ac_total->cotizacion->cotizacion * $ac_total->cotizacion->cantidad ) * $ac_total->cotizacion->porcentaje_impuesto / 100 );
    	}
    	$ac = AC::where('codigo', $req->codigo)->first();

    	$tipo = ( $ac->cotizacion->solicitud->requisicion->tipo_requisicion == 'BIENES' ) ? 'COMPRA' : 'SERVICIOS';
    	return view( 'modulos.compras.crear_orden', [
    			'analisis' => $ac,
    			'sub_total' => $sub_total,
    			'iva' => $iva,
    			'ac_totales' => $ac_totales,
    			'codigo_orden' => $codigo,
    			'tipo' => $tipo
    		] );
    }

    public function guardar($req){
    	DB::beginTransaction();
    	try {
    		
    		$orden = new Orden($req->all());
    		if($orden->save()){
    			DB::commit();
    			return response([
    					'error' => true,
    					'mensaje' => 'SE HA GUARDADO CORRECTAMENTE LA ORDEN'
    				], 200)->header('Content-Type', 'application/json');

    		}

    		throw new \Exception("ERROR AL INTENTAR GUARDAR LOS DATOS DE LA ORDEN", 1);
    		
    	} catch (\Exception $e) {
    		DB::rollback();
    		return response([
    				'error' => true,
    				'mensaje' => $e->getMessage()
    			], 200)->header('Content-Type', 'application/json');
    	}

    	return response($data, 200)->header('Content-Type', 'application/json');
    }

    public function printOrden($req){
    	$orden = Orden::where('codigo_orden', $req->codigo)->first();
    	$analisis = AC::where('codigo', $orden->codigo_analisis)->get();

    	$view = \View::make('modulos.compras.reportes.orden_compra', [
    			'orden' => $orden,
    			'analisis' => $analisis
    		])->render();

    	$pdf = PDF::loadHtml($view);

    	return $pdf->stream('orden', ['attachment' => 1]);
    }

}
