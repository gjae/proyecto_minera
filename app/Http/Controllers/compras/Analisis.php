<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\compras\RegistroCotizacion as RC;
use App\Models\compras\SolicitudCotizacion as SC;
use App\Models\compras\AnalisisCotizacion as AC;
use App\Http\Controllers\utilidades\Utilidades;

use DB;
use PDF;
class Analisis extends Controller
{
    
    public function analisis($req){
    	return view('modulos.compras.generar_analisis',[
    			'solicitud' => false,
    		]);
    }

    public function buscarCotizaciones($req){
    	$rc = RC::where('estado_registro', 'REGISTRO')->get();
    	$vista = \View::make('modulos.compras.formularios.buscar_registro_cotizacion', [
    			'registros' => $rc
    		])->render();

    	$data = [
    		'error' => false,
    		'formulario' => $vista
    	];
    	return response($data, 200)->header('Content-Type', 'application/json');
    }

    public function cargarRegistro($req){

        $sc = SC::where('codigo', $req->codigo)->get();
        $analisis = AC::max('codigo') + 1;
        $codigo = '';
        for ($i=0; $i < (8 - strlen($analisis)) ; $i++) { 
            $codigo .= '0';
        }
        //return dd($sc);
        return view('modulos.compras.generar_analisis',[
                'solicitud' => $sc,
                'codigo' => $codigo.$analisis
            ]);

    }

    public function recomendaciones($req){
        
        $toView= [];
        if($req->has('codigo')){
            $sc = SC::where('codigo', $req->codigo)->get();
            $ut = Utilidades::analisis($sc);

            $toView = [
                'ganador' => $ut['cuantitativo'],
                'concursantes' => $sc,
            ];
        }

        $vista = \View::make('modulos.compras.formularios.recomendaciones', $toView)
                    ->render();
        return response([
                'error' => false, 
                'formulario' => $vista
                ], 200)->header('Content-Type', 'application/json');
    }

    public function guardarAnalisis($req){
        $sc = SC::where('codigo', $req->codigo_solicitud)
                    ->where('proveedor_id', $req->proveedor_id)->first();

        DB::beginTransaction();
        try {
            
            foreach ($sc->registros_cotizacion as $registro) {
                 $insert = [
                    'registro_cotizacion_id' => $registro->id,
                    'proveedor_id' => $req->proveedor_id,
                    'observacion' => $req->observacion,
                    'codigo' => $req->codigo,
                    'material_id' => $registro->material_id
                ];

                $ac = new AC($insert);
                if( !$ac->save() )
                    throw new \Exception("ERROR AL INTENTAR PROCESAR EL ANALISIS - MODULO: COMPRAS ARCHIVO: Analisis.php CERCA DE LA LINEA 88", 1);
            }

            if( $sc->registros_cotizacion()->update(['estado_registro' => 'PROCESADO']) )
            {
                DB::commit();
                return response([
                        'error' => false,
                        'mensaje' => 'DATOS GUARDADOS CORRECTAMENTE',
                        'codigo' => $req->codigo
                    ], 200)->header('Content-Type', 'application/json');
            }
            throw new \Exception("ERROR AL INTENTAR PROCESAR EL ANALISIS ACTUALIZANDO EL REGISTRO - MODULO: COMPRAS ARCHIVO: Analisis.php CERCA DE LA LINEA 96", 1);
            
            

        } catch (\Exception $e) {
            DB::rollback();
            return response([
                    'error' => true,
                    'mensaje' => $e->getMessage()
                ], 200);
        }
        return response($resp, 200)->header('Content-Type', 'application/json');
    }

    public function printAnalisis($req){
        $vista = \View::make('modulos.compras.formularios.mejor_oferta')->render();

        $pdf = PDF::loadHtml($vista);

        return $pdf->stream('invoice', ['attachment' => 0]);
    }

}
