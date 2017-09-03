<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\compras\RegistroCotizacion as RC;
use App\Models\compras\SolicitudCotizacion as SC;
use App\Http\Controllers\utilidades\Utilidades;
class Ordenes extends Controller
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

        $sc = SC::where('codigo', $req->codigo)->first();
        //return dd($sc);

        return view('modulos.compras.generar_analisis',[
                'solicitud' => $sc
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

}
