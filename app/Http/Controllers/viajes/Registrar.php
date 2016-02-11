<?php

namespace App\Http\Controllers\viajes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\transporte\Vehiculo;
use App\Models\transporte\Transporte;

class Registrar extends Controller
{
    public function index($req){
    	return view('modulos.transporte.crear', [
    			'vehiculo' => false
    		]);
    }

    public function buscar_vehiculos($req){
    	$formulario = \View::make('modulos.transporte.formularios.listado_vehiculos', [
    			'vehiculos' => Vehiculo::where('edo_reg', 1)->get(),
    		])->render();
    	return response([
    			'error' => false,
    			'formulario' => $formulario
    		],200)->header('Content-Type', 'application/json');
    }

    public function cargar_vehiculo($req){

    	if($req->has('id') && !empty($req->id)){
    		return view('modulos.transporte.crear', [
    				'vehiculo' => Vehiculo::find($req->id)
    			]);
    	}
    	return redirect()->to( url('dashboard/viajes/registrar') );
    }

    public function buscar_personas($req){
    	$formulario = \View::make('modulos.transporte.formularios.listado_personas', [
    			'vehiculos' => Vehiculo::where('edo_reg', 1)->get(),
    		])->render();
    	return response([
    			'error' => false,
    			'formulario' => $formulario
    		],200)->header('Content-Type', 'application/json');
    }

    public function guardar($req){
    	if( $req->method('post') ){
    		$t = new Transporte($req->all());
    		if($t->save()){
    			return redirect()->to( url('dashboard/viajes/registrar') )->with('correcto', 'LOS DATOS HAN SIDO ALMACENADOS DE MANERA CORRECTA');
    		}
    		else{
    			return redirect()->to( url('dashboard/viajes/registrar') )->with('error', 'HA OCURRIDO UN ERROR INESPERADO AL INTENTAR ALMACENAR LOS DATOS');
    		}
    	}
    	return redirect()->to( url('dashboard') );
    }
}
