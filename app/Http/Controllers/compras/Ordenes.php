<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\compras\AnalisisCotizacion as AC;
use App\Models\compras\Orden;
use App\Models\compras\Archivo;
use Carbon\Carbon;
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

    public function adjuntar($req){

        return view('modulos.compras.formularios.adjuntar_archivos',[
                'orden' => Orden::find($req->orden_id)
            ]);
    }

    public function guardar_archivos($req){
        try {
            
            if($req->hasFile('archivos')){
                $nombre = '';
                foreach($req->file('archivos') as $key => $archivo)
                {
                    $nombre = md5(Carbon::now()->format('Y-m-d h:i:s A'));
                    $data = [
                        'extension' => $archivo->getClientOriginalExtension(),
                        'nombre_original' => $archivo->getClientOriginalName(),
                        'nombre_archivo' => $nombre,
                        'ruta' => 'uploads/',
                        'tamano' => $archivo->getClientSize(),
                        'orden_id' => $req->orden_id,
                        'tipo_archivo' => $archivo->getClientMimeType(),
                        'comentario' =>(  is_null($req->comentarios[$key]) )? '' : $req->comentarios[$key],
                    ];
                    $guardar_archivo = new Archivo($data);

                    if($guardar_archivo->save()){
                        if(!( $archivo->move('uploads', $guardar_archivo->nombre_archivo.'.'.$guardar_archivo->extension) )){
                            throw new \Exception("ERROR AL PROCESAR EL ARCHIVO", 1);
                                        
                        }
                    }
                }
                return redirect()
                    ->to( url('dashboard/compras/ordenes/ordenes') )
                    ->with('correcto','LOS ARCHIVOS HAN SIDO CARGADOS CORRECTAMENTE');
            }            
        } catch (\Exception $e) {
            return redirect()
                    ->to( url('dashboard/compras/ordenes/ordenes') )
                    ->with('error', 'ERROR AL PROCESAR UNO DE LOS ARCHIVOS: '.$e->getMessage());
        }
    }

    public function archivos($req) {
        $orden = Orden::find($req->orden_id);
        return view('modulos.compras.archivos', [
                'orden' => $orden
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

    public function imprimir2($req){
        if( $req->has('orden') && !empty($req->orden)){
            $orden = Orden::find($req->orden);
            $ac = AC::where('codigo', $orden->codigo_analisis)->first();

            $requisicion = $ac->cotizacion->solicitud->requisicion;
            set_time_limit(900);
           
            $vista = \View::make('modulos.compras.reportes.orden_compra2',[
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

    public function formato_almacen($req){
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        $ruta = public_path('uploads/FORMATO_ALMACEN.xlsx');
        return response()->download($ruta, 'FORMATO_ALMACEN.xlsx', $headers);
    }

    public function imprimir_ley($req){
        $vista = \View::make('modulos.compras.reportes.carta_orden', ['tipo' => $req->tipo])->render();
        ini_set('memory_limit', '512M');
        
        $pdf = PDF::loadHtml($vista);
       // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('reporte_orden', ['attachment' => 0]);
    }

    public function descargar($req){
        $post = Orden::find($req->orden);
      //  return dd($post);
        if($post){
            $archivo = $post->archivos()->where('id', $req->archivo_id)->first();
            $headers = [
                'Content-Type' => $archivo->tipo_archivo,
            ];

            $ruta = public_path('uploads/'.$archivo->nombre_archivo.'.'.$archivo->extension);
            return response()->download($ruta, $archivo->nombre_original, $headers);
        }
        return redirect()
                ->to( url('dashboard/compras/ordenes/ordenes') )
                ->with('error','EL ARCHIVO QUE INTENTA DESCARGAR NO EXISTE, O EL POST HA SIDO RETIRADO');
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
