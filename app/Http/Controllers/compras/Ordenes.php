<?php

namespace App\Http\Controllers\compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\compras\RegistroCotizacion as RC;
class Ordenes extends Controller
{
    
    public function analisis($req){
    	return view('modulos.compras.generar_analisis',[
    			'solicitud' => false,
    			'requisicion' => false
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
}
